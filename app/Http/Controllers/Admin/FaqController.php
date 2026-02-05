<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MstFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = MstFaq::orderBy('created_at', 'desc')->paginate(2);
        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
        ]);

        MstFaq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'created_by' => Auth::user()->name,
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
        ]);

        $faq = MstFaq::findOrFail($id);
        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'updated_by' => Auth::user()->name,
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage (permanent delete).
     */
    public function destroy($id)
    {
        $faq = MstFaq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MstKi;
use App\Models\TrxUsulanKi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KiController extends Controller
{
    public function index()
    {
        $jenisKi = MstKi::all();
        return view('ki.index', compact('jenisKi'));
    }

    public function create($id)
    {
        $ki = MstKi::with('syarat')->findOrFail($id);
        return view('ki.create', compact('ki'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mst_ki_id' => 'required|exists:mst_ki,id',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        $usulan = TrxUsulanKi::create([
            'user_id' => Auth::id(),
            'mst_ki_id' => $request->mst_ki_id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
        ]);

        return redirect()->route('ki.my-submissions')->with('success', 'Usulan KI berhasil diajukan');
    }

    public function mySubmissions()
    {
        $usulan = TrxUsulanKi::with('mstKi')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('ki.my-submissions', compact('usulan'));
    }

    public function destroy($id)
    {
        $usulan = TrxUsulanKi::findOrFail($id);
        
        if ($usulan->user_id !== Auth::id()) {
            return redirect()->route('ki.my-submissions')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus permohonan ini');
        }
        
        if ($usulan->status !== 'pending') {
            return redirect()->route('ki.my-submissions')
                ->with('error', 'Hanya permohonan dengan status pending yang dapat dihapus');
        }
        
        $usulan->delete();
        
        return redirect()->route('ki.my-submissions')
            ->with('success', 'Permohonan berhasil dihapus');
    }


    public function edit($id)
    {
        $usulan = TrxUsulanKi::with('mstKi.syarat')->findOrFail($id);
        
        if ($usulan->user_id !== Auth::id()) {
            return redirect()->route('ki.my-submissions')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit permohonan ini');
        }
        
        if ($usulan->status !== 'pending') {
            return redirect()->route('ki.my-submissions')
                ->with('error', 'Hanya permohonan dengan status pending yang dapat diedit');
        }
        
        $ki = $usulan->mstKi;
        return view('ki.edit', compact('usulan', 'ki'));
    }

    public function update(Request $request, $id)
    {
        $usulan = TrxUsulanKi::findOrFail($id);
        
        if ($usulan->user_id !== Auth::id()) {
            return redirect()->route('ki.my-submissions')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit permohonan ini');
        }
        
        if ($usulan->status !== 'pending') {
            return redirect()->route('ki.my-submissions')
                ->with('error', 'Hanya permohonan dengan status pending yang dapat diedit');
        }
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        $usulan->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('ki.my-submissions')
            ->with('success', 'Permohonan berhasil diperbarui');
    }

}

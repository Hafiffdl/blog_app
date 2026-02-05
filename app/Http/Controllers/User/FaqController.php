<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MstFaq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = MstFaq::orderBy('created_at', 'desc')->get();
        return view('user.faq.index', compact('faqs'));
    }
}

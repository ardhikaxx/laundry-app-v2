<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Layanan;

class HomeController extends Controller
{
    public function index()
    {
        $layanans = Layanan::aktif()->with('kategori')->limit(6)->get();
        return view('public.home', compact('layanans'));
    }
}

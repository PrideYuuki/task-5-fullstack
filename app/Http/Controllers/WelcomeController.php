<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $articles = Articles::with('category')->get();
        return view('welcome', compact('articles'));
    }
}

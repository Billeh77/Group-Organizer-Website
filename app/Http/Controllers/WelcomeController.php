<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purpose;

class WelcomeController extends Controller
{
    public function index() {
        $purposes = Purpose::all();

        return view('welcome', compact('purposes'));
    }
}

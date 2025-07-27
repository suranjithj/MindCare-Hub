<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PageController extends Controller
{
    public function packages()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }

    public function about() {
        return view('pages.about');
    }
}

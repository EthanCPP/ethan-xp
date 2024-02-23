<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BootController extends Controller
{
    public function boot()
    {
        return Inertia::render('Application');
    }
}

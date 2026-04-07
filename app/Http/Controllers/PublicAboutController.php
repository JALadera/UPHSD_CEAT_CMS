<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicAboutController extends Controller
{
    /**
     * Display the about page with college history.
     */
    public function index(): View
    {
        return view('public.about.index');
    }
}

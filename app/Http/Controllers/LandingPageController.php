<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function __invoke(): View
    {
        $menuPreview = MenuItem::available()
            ->orderBy('menu_name')
            ->take(6)
            ->get();

        return view('landing', compact('menuPreview'));
    }
}


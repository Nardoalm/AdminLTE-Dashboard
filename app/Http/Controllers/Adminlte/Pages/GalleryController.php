<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.gallery');
    }
}

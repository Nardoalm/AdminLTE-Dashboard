<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class Examples500Controller extends Controller
{
    public function __invoke(): View
    {
        return view('admin.examples.500');
    }
}

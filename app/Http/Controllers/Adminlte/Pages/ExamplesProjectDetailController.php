<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ExamplesProjectDetailController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.examples.project-detail');
    }
}

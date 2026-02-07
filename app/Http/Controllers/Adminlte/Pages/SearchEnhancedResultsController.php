<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SearchEnhancedResultsController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.search.enhanced-results');
    }
}

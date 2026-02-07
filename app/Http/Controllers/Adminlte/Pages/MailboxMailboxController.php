<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MailboxMailboxController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.mailbox.mailbox');
    }
}

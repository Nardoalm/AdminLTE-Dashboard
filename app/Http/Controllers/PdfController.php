<?php

namespace App\Http\Controllers;

use App\Models\User;
use PDF;

class PdfController extends Controller
{
    public function generatePDF(User $user)
    {
        $expenses = $user->expenses();

        $incomes = $user->incomes();


        $data = [
            'user' => $user,

            'expenses' => $expenses,

            'incomes' => $incomes,

            'totalExpenses' => $expenses->sum('amount'),

            'totalIncomes' => $incomes->sum('amount')
        ];


        $pdf = PDF::loadView('pdf.financial-report', $data);


        return $pdf->download('financial-report.pdf');
    }
}

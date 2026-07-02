<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{

    public function index(){
        $categoryColors = [
            'health' => '#FF6B6B',
            'food' => '#4ECDC4',
            'transport' => '#FFE66D',
            'bills' => '#FFE66D',
        ];

        $typeColors = [
            'expense' => '#FF4757',
            'income' => '#2ED573'
        ];

        $chartData = auth()->user()->expenses()
            ->where('type', 'expense')
            ->select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->get();

        $labels = $chartData->pluck('category');
        $values = $chartData->pluck('total');

        $transactions = auth()->user()->expenses()
            ->orderByDesc('date')
            ->get();

        $expense = auth()->user()->expenses()->where('type', 'expense')->sum('amount');
        $income = auth()->user()->expenses()->where('type', 'income')->sum('amount');

        $balance = $income - $expense;
        $total = $transactions->count();

        return view('admin.dashboard', compact('transactions', 'expense', 'typeColors', 'income', 'categoryColors', 'balance', 'total', 'labels', 'values'));
    }

    public function store(ExpenseRequest $request){
        auth()->user()->expenses()->create([
           'description' => $request->description,
           'amount' => $request->amount,
           'date' => $request->date,
           'type' => $request->type,
           'category' => $request->category,
        ]);

        return redirect()->back()->with('success', 'Lançamento adicionado com sucesso!');
    }

    public function destroy($expense){
        auth()->user()->expenses()->findOrFail($expense)->delete();
        return redirect()->back()->with('success', 'Lançamento removido com sucesso!');
    }
}

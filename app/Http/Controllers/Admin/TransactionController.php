<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        $transactions = $this->transactionRepository\all();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = $this->transactionRepository\findById($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function create()
    {
        return view('admin.transactions.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->transactionRepository\save(new Transaction($data));
        return redirect()->route('admin.transactions.index');
    }

    public function edit($id)
    {
        $transaction = $this->transactionRepository\findById($id);
        return view('admin.transactions.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $transaction = $this->transactionRepository\findById($id);
        $transaction->update($request->all());
        $this->transactionRepository\save($transaction);
        return redirect()->route('admin.transactions.index');
    }

    public function destroy($id)
    {
        $transaction = $this->transactionRepository\findById($id);
        $this->transactionRepository\delete($transaction);
        return redirect()->route('admin.transactions.index');
    }
}

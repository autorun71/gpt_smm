<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($this->transactionRepository\all());
    }

    public function show($id)
    {
        return response()->json($this->transactionRepository\findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $transaction = new Transaction($data);
        $this->transactionRepository\save($transaction);
        return response()->json($transaction, 201);
    }

    public function update(Request $request, $id)
    {
        $transaction = $this->transactionRepository\findById($id);
        $transaction->update($request->all());
        $this->transactionRepository\save($transaction);
        return response()->json($transaction);
    }

    public function destroy($id)
    {
        $transaction = $this->transactionRepository\findById($id);
        $this->transactionRepository\delete($transaction);
        return response()->json(null, 204);
    }
}

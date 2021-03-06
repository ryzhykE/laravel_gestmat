<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    public function index()
    {
        $suppliers = Supplier::where('user_id', auth()->user()->id)->latest()->paginate(10);

        return view('suppliers', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $supplier = new Supplier();
        $supplier->user_id = auth()->user()->id;
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;

        $supplier->save();

        return redirect()->back()->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier-edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $supplier->user_id = auth()->user()->id;
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;

        $supplier->save();

        return redirect()->back()->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->back()->with('success', 'Fornecedor excluído com sucesso!');
    }
}

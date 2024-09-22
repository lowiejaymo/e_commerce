<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $suppliers = Supplier::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('contact_num', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->get();

        return view('suppliers.index', compact('suppliers'));
    }


    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|numeric',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
        ]);

        $supplier = Supplier::create([
            'name' => $request->input('name'),
            'contact_num' => $request->input('contact_number'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('suppliers.index')->with('added_success', $supplier->name);
    }


    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|numeric',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $id . ',supplier_id',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'name' => $request->input('name'),
            'contact_num' => $request->input('contact_number'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('suppliers.index')->with('update_success', 'Supplier updated successfully!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if ($supplier) {
            $supplier->delete();

            return redirect()->route('suppliers.index')->with('delete_success', 'Supplier');
        }

        return redirect()->route('suppliers.index')->with('error', 'Supplier not found');
    }

}

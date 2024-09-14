<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
            return $query->where('product_name', 'like', '%' . $search . '%');
        })->get();

        return view('products.index', compact('products'));
    }

    
    public function create()
    {
        return view('products.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|min:5|unique:products,product_name',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName(); 
            $imagePath = $image->storeAs('product_images', $imageName, 'public'); 
            $imageName = basename($imagePath); 
        } else {
            $imageName = 'no-product-image.png'; 
        }

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'product_image' => $imageName, 
        ]);

        return redirect()->route('products.index')->with('success_product_added', $product->product_name);
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        // Fetch the product by its ID and return a view to edit it
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|min:3|unique:products,product_name,' . $id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('product_image')) {
            if ($product->product_image && $product->product_image !== 'no-product-image.png') {
                Storage::disk('public')->delete('product_images/' . $product->product_image);
            }

            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName(); 
            $imagePath = $image->storeAs('product_images', $imageName, 'public'); 
            $imageName = basename($imagePath); 
        } else {
            $imageName = $product->product_image; 
        }

        $product->update([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'product_image' => $imageName, 
        ]);

        return redirect()->route('products.show', $product->id)->with('update_product_information', 'Product information has been updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product_name = $product->product_name;
        $product->delete();

        return redirect()->route('products.index')->with('deleted_product', $product_name);
    }
}

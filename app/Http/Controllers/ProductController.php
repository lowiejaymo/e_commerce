<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::select('category_id', 'type')->get();
    $products = Product::query();

    // Filter by categories if selected
    if ($request->has('categories') && is_array($request->input('categories'))) {
        $categoryIds = array_filter(array_map('intval', $request->input('categories')));
        if (!empty($categoryIds)) {
            $products->whereIn('category_id', $categoryIds);
        }
    }

    // Handle minimum price filter
    if ($request->has('min_price') && is_numeric($request->input('min_price'))) {
        $minPrice = $request->input('min_price');
        $products->where(function ($query) use ($minPrice) {
            $query->whereRaw('price - (price * product_discount / 100) >= ?', [$minPrice])
                  ->orWhere('price', '>=', $minPrice); // Include original price if no discount
        });
    }

    // Handle maximum price filter
    if ($request->has('max_price') && is_numeric($request->input('max_price'))) {
        $maxPrice = $request->input('max_price');
        $products->where(function ($query) use ($maxPrice) {
            $query->whereRaw('price - (price * product_discount / 100) <= ?', [$maxPrice])
                  ->orWhere('price', '<=', $maxPrice); // Include original price if no discount
        });
    }

    // Handle search functionality
    if ($request->has('search') && !empty($request->input('search'))) {
        $searchTerm = $request->input('search');
        $products->where('product_name', 'like', '%' . $searchTerm . '%');
    }

    // Fetch products
    $products = $products->get();

    return view('products.index', [
        'categories' => $categories,
        'products' => $products,
    ]);
}


    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('products.create', compact('suppliers', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|min:5|unique:products,product_name',
            'price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('product_images', $imageName, 'public');
            $imageName = basename($imagePath);
        } else {
            $imageName = 'no-product-image.png';
        }

        // Create the product
        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'product_discount' => $request->input('product_discount'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'product_image' => $imageName,
            'supplier_id' => $request->input('supplier_id'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('products.index')->with('success_product_added', $product->product_name);
    }



    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('products.edit', compact('product', 'suppliers', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|min:3|unique:products,product_name,' . $id,
            'price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'category_id' => 'required|exists:categories,category_id',
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
            'product_discount' => $request->input('product_discount'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'product_image' => $imageName,
            'supplier_id' => $request->input('supplier_id'),
            'category_id' => $request->input('category_id'),
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

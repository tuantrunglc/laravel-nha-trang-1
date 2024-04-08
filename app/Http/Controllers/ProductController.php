<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    // Hiển thị form để tạo sản phẩm mới
    public function create()
    {
        return view('products.create');
    }

    // Lưu sản phẩm mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product($request->all());
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }
        $product->save();
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    // Hiển thị chi tiết một sản phẩm
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Cập nhật thông tin sản phẩm trong database
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->update($request->all());
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image) {
                Storage::delete($product->image);
            }
    
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }
    
        $product->save();
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    // Xóa sản phẩm khỏi database
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}

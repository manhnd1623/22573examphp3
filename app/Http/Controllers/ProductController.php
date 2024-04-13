<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    const PATH_VIEW ='products.';
    const PATH_UPLOAD ='products';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->latest()->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = \request()->except('image');

        if (\request()->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, \request()->file('image'));
        }

        Product::query()->create($data);
        return back()->with('msg, Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = \request()->except('image');

        if (\request()->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, \request()->file('image'));
        }

        $oldImg =  $product->image;
        $product->update($data);

        if (\request()->hasFile('image') && Storage::exists($oldImg)) {
            Storage::delete($oldImg);
        }

        Product::query()->create($data);
        return back()->with('msg, Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if(Storage::exists($product->image)){
            Storage::delete($product->image);
        }
    }
}

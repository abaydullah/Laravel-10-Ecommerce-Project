<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use function League\Flysystem\move;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id','asc')->with('categories','brand')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create',compact('brands','categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required'
        ]);
        $product = new Product();
       $main_slider = $request->main_slider;
       if ($main_slider){
           $main_slider = 1;
       }else{
           $main_slider = 0;
       }
       $hot_deal = $request->hot_deal;
        if ($hot_deal){
            $hot_deal = 1;
        }else{
            $hot_deal = 0;
       }
       $best_rated = $request->best_rated;
        if ($best_rated){
            $best_rated = 1;
        }else{
            $best_rated = 0;
        }
       $hot_new = $request->hot_new;
        if ($hot_new){
            $hot_new = 1;
        }else{
            $hot_new = 0;
        }
        $status = $request->status;
        if ($status){
            $status = 1;
        }else{
            $status = 0;
        }

        $image = $request->file('image');
        if ($image){
            $ext = $image->extension();
            $imagename = uniqid().time().'.'.$ext;
            $image->move(public_path('products'), $imagename);
            $image_url = 'products/'.$imagename;
            $product->brand_id  = $request->brand_id;
            $product->name  = $request->name;
            $product->quantity  = $request->quantity;
            $product->color  = implode(", ", $request->color);
            $product->size  = implode(", ", $request->size);;
            $product->code  = $request->code;
            $product->selling_price  = $request->selling_price;
            $product->discount_price  = $request->discount_price;
            $product->video_link  = $request->video_link;
            $product->main_slider  = $main_slider;
            $product->hot_deal  = $hot_deal;
            $product->best_rated  = $best_rated;
            $product->hot_new  = $hot_new;
            $product->image  = $image_url;
            $product->details  = $request->details;
            $product->status  = $status;
            $product->save();
            $product->categories()->attach($request->categories);
        }else{
            $product->brand_id  = $request->brand_id;
            $product->name  = $request->name;
            $product->quantity  = $request->quantity;
            $product->color  = implode(", ", $request->color);
            $product->size  = implode(", ", $request->size);
            $product->code  = $request->code;
            $product->selling_price  = $request->selling_price;
            $product->discount_price  = $request->discount_price;
            $product->video_link  = $request->video_link;
            $product->main_slider  = $main_slider;
            $product->hot_deal  = $hot_deal;
            $product->best_rated  = $best_rated;
            $product->hot_new  = $hot_new;
            $product->details  = $request->details;
            $product->status  = $status;
            $product->save();
            $product->categories()->attach($request->categories);
        }

        return redirect()->route('admin.products.index')->with('create', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('categories')->find($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.edit',compact('brands','categories','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {



        $product = Product::find($id);
        $main_slider = $request->main_slider;
        if ($main_slider){
            $main_slider = 1;
        }else{
            $main_slider = 0;
        }
        $hot_deal = $request->hot_deal;
        if ($hot_deal){
            $hot_deal = 1;
        }else{
            $hot_deal = 0;
        }
        $best_rated = $request->best_rated;
        if ($best_rated){
            $best_rated = 1;
        }else{
            $best_rated = 0;
        }
        $hot_new = $request->hot_new;
        if ($hot_new){
            $hot_new = 1;
        }else{
            $hot_new = 0;
        }
        $status = $request->status;
        if ($status){
            $status = 1;
        }else{
            $status = 0;
        }
        $image = $request->file('image');
        if ($image){
            $ext = $image->extension();
            $imagename = uniqid().time().'.'.$ext;
            if (file_exists($product->image)){
            unlink($product->image);
            }

            $image->move(public_path('products'), $imagename);
            $image_url = 'products/'.$imagename;
            $product->brand_id  = $request->brand_id;
            $product->name  = $request->name;
            $product->quantity  = $request->quantity;
            $product->color  = implode(", ", $request->color);
            $product->size  = implode(", ", $request->size);
            $product->code  = $request->code;
            $product->selling_price  = $request->selling_price;
            $product->discount_price  = $request->discount_price;
            $product->video_link  = $request->video_link;
            $product->main_slider  = $main_slider;
            $product->hot_deal  = $hot_deal;
            $product->best_rated  = $best_rated;
            $product->hot_new  = $hot_new;
            $product->image  = $image_url;
            $product->details  = $request->details;
            $product->status  = $status;
            $product->update();
            $product->categories()->sync($request->categories);
        }else{
            $product->brand_id  = $request->brand_id;
            $product->name  = $request->name;
            $product->quantity  = $request->quantity;
            $product->color  = implode(", ", $request->color);
            $product->size  = implode(", ", $request->size);
            $product->code  = $request->code;
            $product->selling_price  = $request->selling_price;
            $product->discount_price  = $request->discount_price;
            $product->video_link  = $request->video_link;
            $product->main_slider  = $main_slider;
            $product->hot_deal  = $hot_deal;
            $product->best_rated  = $best_rated;
            $product->hot_new  = $hot_new;
            $product->details  = $request->details;
            $product->status  = $status;
            $product->update();
            $product->categories()->sync($request->categories);
        }
        return redirect()->route('admin.products.index')->with('create', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (file_exists($product->image)){
            unlink($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('delete','Product Deleted Successfully');
    }
}

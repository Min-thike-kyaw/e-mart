<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.product.index',["items" => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getChildrenById($id)
    {
        $child_categories = Category::where('parent_id',$id)->pluck('title','id')->all();
        if ($child_categories) {
            return response()->json([
                "data" => $child_categories,
                "status" => true,
                "msg" => ""
            ]);
        } else {
            return response()->json([
                "data" =>null,
                "status" => false,
                "msg" => "No child category found"
            ]);
        }

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'nullable',
            'summary' => 'required',
            'stock' => 'required|numeric',
            'brand_id' => 'required',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'photo' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|max:100',
            'size' => 'nullable|in:XS,S,M,L,XL',
            'condition' => 'nullable|in:winter,popular,new',

            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        //slug
        $slug = Str::slug($data['title']);
        $slug_count = Product::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time() . "-" . $slug;
        }
        $data['slug'] = $slug;

        $data['offer_price'] = $request->price - ($request->price * $request->discount/100);
        $product = Product::create($data);
        if ($product) {
            return redirect()->route('product');
        } else {
            return back("error", "Something wrong");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('backend.product.edit',["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function productStatus(Request $request)
    {
        // dd($request->all());
        $product = Product::find($request->id);
        // dd($request->all());
        if($request->mode == "true"){
            $product->status = "active";
        } else {
            $product->status = "inactive";
            // dd($product->status);
        }
        $product->save();
        return  response()->json([
            "data" => "Successfully updated",
        ]);
        // exit;

    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'nullable',
            'summary' => 'required',
            'stock' => 'required|numeric',
            'brand_id' => 'required',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'photo' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|max:100',
            'size' => 'nullable|in:XS,S,M,L,XL',
            'condition' => 'nullable|in:winter,popular,new',

            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        //slug
        $slug = Str::slug($data['title']);
        $slug_count = Product::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time() . "-" . $slug;
        }
        $data['slug'] = $slug;

        $data['offer_price'] = $request->price - ($request->price * $request->discount/100);

        if($request->photo == null) {

            $data['photo'] = $product->photo;
            // dd($request->all());
        }
        // dd($data);

        $status = $product->fill($data)->save();
        if ($status) {
            return redirect()->route('product');
        } else {
            return back("error", "Something wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route("product");
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $categories = Category::where(["status" => "active", "is_parent" => 1])->orderBy("id","DESC")->limit(3)->get();
        $banners = Banner::where(["status" => "active", "condition" => "banner"])->orderBy("id","DESC")->limit(3)->get();
        // dd($banners);
        return view('frontend.pages.index',[
            "categories" => $categories,
            "banners" => $banners
        ]);
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug',$slug)->get()->first();
        $rel_products = Product::where(['cat_id'=>$product->cat_id, 'status' => "active"])->inRandomOrder()->limit(8)->get();
        // dd($rel_products);
        return view('frontend.pages.product-detail',["product" => $product,"rel_products" => $rel_products]);
    }

    public function categoryProduct($slug)
    {
        $category = Category::with('products')->where('slug',$slug)->first();



        // dd($category);
        // dd($rel_products);
        return view('frontend.pages.category-product',["category" => $category]);
    }
}

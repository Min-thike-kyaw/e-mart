<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function home()
    {
        // dd(auth()->user());
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

    public function categoryProduct($slug,Request $request)
    {
        $category = Category::with('products')->where('slug',$slug)->first();

        if($request->sort){
            if($request->sort == "priceAsc") {
                $products = Product::where(['status' => 'active', 'cat_id' => $category->id])->orderBy('offer_price','ASC')->paginate(8);
            }
            elseif($request->sort == "priceDes") {
                $products = Product::where(['status' => 'active', 'cat_id' => $category->id])->orderBy('offer_price','DESC')->paginate(8);
            }
            elseif($request->sort == "alphaAsc") {
                $products = Product::where(['status' => 'active', 'cat_id' => $category->id])->orderBy('title','ASC')->paginate(8);
            }
            elseif($request->sort == "alphaDes") {
                $products = Product::where(['status' => 'active', 'cat_id' => $category->id])->orderBy('title','DESC')->paginate(8);
            }
        } else {
            $products = Product::where(['status' => 'active', 'cat_id' => $category->id])->orderBy('id','DESC')->paginate(8);
        }


        // dd($category);
        // dd($rel_products);
        return view('frontend.pages.category-product',["category" => $category, "products" => $products]);
    }

    public function userAuth()
    {
        // Auth::logout();

        return view('frontend.auth.auth');
    }

    public function userLogin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('welcome');
        }
    }

    public function userRegister(Request $request)
    {
        $this->validate($request, [
            "fullname" => 'required|string',
            "username" => 'nullable|string',
            "email" => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);
        $data = $request->all();

        $data['password'] = Hash::make($request->password);
        $checked = User::create($data);
        if($checked){
            return redirect()->route('welcome');
        } else {
            return back()->with("error", "Something wrong");
        }

    }

    public function userLogout(){
        if(auth()->check()){
            Auth::logout();
            return redirect()->route('welcome');
        }


    }

    public function userAccount()
    {
        return view('frontend.user.account');
    }

    public function userDashboard()
    {
        return view('frontend.user.dashboard');
    }

    public function userOrder()
    {
        return view('frontend.user.order');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Category::find(2)->parent_id);
       return view('backend.category.index')->with("items" , Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create')->with("parent_categories", Category::where('is_parent',true)->get());
    }

    public function CategoryStatus(Request $request)
    {
        // dd($request->all());
        $banner = Category::find($request->id);
        // dd($request->all());
        if($request->mode == "true"){
            $banner->status = "active";
        } else {
            $banner->status = "inactive";
            // dd($banner->status);
        }
        $banner->save();
        return  response()->json([
            "data" => "Successfully updated",
        ]);
        // exit;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'summary' => 'required',
            'photo' => 'required',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->all();
        $slug = Str::slug($data['title']);
        $slug_count = Category::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time() . "-" . $slug;
        }
        $data['slug'] = $slug;
        if($request->is_parent) {
            $data['parent_id'] = null;
        } else {
            $data['is_parent'] = false;
        }
        // dd($data);
        $status = Category::create($data);
        if($status) {
            return redirect()->route('category');
        } else {
            return back()->with("error", "Something wrong");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit',["parent_categories" =>  Category::where('is_parent',true)->get(), "category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required',
            'summary' => 'required',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->all();

        //slug
        $slug = Str::slug($data['title']);
        $slug_count = Category::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time() . "-" . $slug;
        }
        $data['slug'] = $slug;

        //parent category
        if($request->is_parent) {
            $data['parent_id'] = null;
        } else {
            $data['is_parent'] = false;
        }

        //photo
        if($request->photo == null) {

            $data['photo'] = $category->photo;
            // dd($request->all());
        }
        // dd($data);

        $status = $category->fill($data)->save();
        if($status) {
            return redirect()->route('category');
        } else {
            return back()->with("error", "Something wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route("category");

    }
}

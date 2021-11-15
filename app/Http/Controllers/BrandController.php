<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.brand.index",["items" => Brand::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'photo' => 'required',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->all();
        $slug = Str::slug($data['title']);
        $slug_count = Brand::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time() . "-" . $slug;
        }
        $data['slug'] = $slug;
        $status = Brand::create($data);
        if($status) {
            return redirect()->route('brand');
        } else {
            return back()->with("error", "Something wrong");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view("backend.brand.edit",["brand" => $brand]);

    }

    public function brandStatus(Request $request)
    {
        $brand = Brand::find($request->id);
        // dd($request->all());
        if($request->mode == "true"){
            $brand->status = "active";
        } else {
            $brand->status = "inactive";
            // dd($brand->status);
        }
        $brand->save();
        return  response()->json([
            "data" => "Successfully updated",
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        // dd($request);
        $data = $request->all();
        if($request->photo == null) {

            $data['photo'] = $brand->photo;
            // dd($request->all());
        }
        $slug = Str::slug($data['title']);
        $slug_count = Brand::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time() . "-" . $slug;
        }
        $data['slug'] = $slug;
        $status = $brand->fill($data)->save();
        if($status) {
            return redirect()->route('brand');
        } else {
            return back()->with("error", "Something wrong");
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function delete(Brand $brand)
    {
        $brand->delete();
        return redirect()->route("brand");
    }
}

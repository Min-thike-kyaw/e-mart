<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function index()
    {
        // $items = Banner::last()->slug;
        // return DB::table('banners')->order_by('upload_time', 'desc')->first();
        // return Banner::latest()->first();

        return view('backend.banner.index')->with("items" , Banner::all());
    }

    public function create()
    {
        return view('backend.banner.create');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:promo,banner',
        ]);
        $data = $request->all();
        $slug = Str::slug($data['title']);
        $slug_count = Banner::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time() . "-" . $slug;
        }
        $data['slug'] = $slug;
        $status = Banner::create($data);
        if($status) {
            return redirect()->route('banner');
        } else {
            return back()->with("error", "Something wrong");
        }
    }

    public function bannerStatus(Request $request)
    {
        // dd($request->all());
        $banner = Banner::find($request->id);
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

    public function edit(Banner $banner)
    {
        // dd($banner);

        return view('backend.banner.edit',["banner" => $banner]);
    }

    public function update(Request $request, Banner $banner)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:promo,banner',
        ]);

        // dd($request);
        $data = $request->all();
        if($request->photo == null) {

            $data['photo'] = $banner->photo;
            // dd($request->all());
        }
        $slug = Str::slug($data['title']);
        $slug_count = Banner::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time() . "-" . $slug;
        }
        $data['slug'] = $slug;
        $status = $banner->fill($data)->save();
        if($status) {
            return redirect()->route('banner');
        } else {
            return back()->with("error", "Something wrong");
        }
    }

    public function delete(Banner $banner)
    {
        $banner->delete();
        return redirect()->route("banner");

    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;


class IndexController extends Controller
{
    public function home()
    {
        $banners=Banner::where(['status'=>'active', 'condition'=>'banner'])->orderBy('id', 'DESC')->limit(5)->get();
        $categories=Category::where(['status'=>'active', 'is_parent'=>1])->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.index', compact(['banners', 'categories']));
    }

    public function productCategory($slug)
    {
        $categories=Category::with('products')->where('slug',$slug)->first();
        return view('frontend.pages.product-category', compact(['categories']));
    }
}

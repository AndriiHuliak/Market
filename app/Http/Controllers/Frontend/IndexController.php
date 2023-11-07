<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;



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
        return view('frontend.pages.product.product-category', compact(['categories']));
    }

    public function productDetail($slug)
    {
        $product=Product::with('rel_prods')->where('slug',$slug)->first();
        if ($product) {
            return view('frontend.pages.product.product-detail', compact('product'));
        }
        else{
            return 'Product detail not found';
        }
    }

    public function userAuth()
    {
        return view('frontend.auth.auth');
    }

    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email'=>'email|required|exists:users,email',
            'password'=>'required|min:4',
        ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status'=>'active'])) {
            Session::put('user',$request->email);
            if (Session::get('url.intended')) {
                return Redirect::to(Session::get('url.intended'));
            }else{
                return redirect()->route('home')->with('success', 'Successfully login');
            }
        }
        else{
            return back()->with('error', 'Invalid email & password');
        }
    }

    public function registerSubmit(Request $request)
    {
        $this->validate($request, [
            'username'=>'nullable|string',
            'full_name'=>'required|string',
            'email'=>'email|required|unique:users,email',
            'password'=>'required|min:4|confirmed',
        ]);

        $data=$request->all();
        $check=$this->create($data);
        Session::put('user', $data['email']);
        Auth::login($check);
        if ($check) {
            return redirect()->route('home')->with('success', 'Successfully registered');
        }
        else{
            return back()->with('error', 'Please check your credentials');
        }
    }

    private function create(array $data)
    {
        return User::create([
            'username'=>$data['username'],
            'full_name'=>$data['full_name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
        ]);
    }

    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();

        return redirect()->home()->with('success', 'Successfully logout');
    }
}




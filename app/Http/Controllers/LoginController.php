<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login() {
        return view('auth.login');
    }

    function loginPost(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('admin.dashboard'))->with('success', 'Login successful');
        } else {
            return redirect(route('login'))->with('error', 'Invalid email or password');
        }
    }

    function register() {
        return view('auth.register');
    }

    function registerPost(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect(route('login'))->with('success', 'User created successfully');
    }   

    function logout() {
        Auth::logout();
        return redirect(route('login'))->with('success', 'Logout successful');
    }

    function dashboard() {

        $categories = Category::all()->count();
        $providers = User::all()->count();
        $products = Product::all()->count();
        $customers = Customer::all()->count();
        $invoices = Invoice::all()->count();
        $purchases = Purchase::all()->count();
        $users = User::all()->count();
        $totalsale = Invoice::sum('total');
        $totalpurchase = Purchase::sum('total');


        return view('admin.dashboard', compact('categories', 'providers', 'products','customers','invoices','users','totalsale','totalpurchase','purchases'));
    }
}

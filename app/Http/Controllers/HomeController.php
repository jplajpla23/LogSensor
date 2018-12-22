<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function editUser()
    {
        $u=Auth::user();
        return view('user',compact('u'));
    }
    public function editUserSave(Request $request)
    {


        if(strcmp($request->email, Auth::user()->email)==0)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6|confirmed'
            ]);
            if ($validator->fails()) {
                return redirect()->route('editUser')
                ->withErrors($validator)
                ->withInput();
            }
            $u=Auth::user();
            $u->name=$request->name;
                //$u->email=$request->email;
            $u->password= Hash::make($request->password);
            $u->save();


        }else{
            $validator = Validator::make($request->all(), [
              'name' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:6|confirmed'
          ]);
            if ($validator->fails()) {
                return redirect()->route('editUser')
                ->withErrors($validator)
                ->withInput();
            }
            $u=Auth::user();
            $u->name=$request->name;
            $u->email=$request->email;
            $u->password= Hash::make($request->password);
            $u->save();
        }
        return redirect()->route('home');
        
    }
}

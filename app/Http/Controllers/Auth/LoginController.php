<?php 

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Traits\loginTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller 
{

    use loginTrait;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function show($type)
    {
        
        return view('auth.login',compact('type'));
        
    }
    public function login(Request $request)
    { 

      if (Auth::guard($this->guard_name($request))->attempt(["email"=>$request->email,"password"=>$request->password])) {
        
      return $this->redirect($request);

      }else{

        Session()->flash('wrong', 'البريد أو الرقم السري خطأ!');

        return redirect("/login/".$this->guard_name($request));

      }
        
    }
    public function logout(Request $request , $type)
    { 
      

        Auth::guard($type)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
       

      }


        
 }
 



    




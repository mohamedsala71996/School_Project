<?php

namespace App\Traits;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

trait loginTrait
{

    public function guard_name($request)
    {
        if ($request->type == "student") {
            $guard_name = "student";
        } elseif ($request->type == "teacher") {
            $guard_name = "teacher";
        } elseif ($request->type == "parent") {
            $guard_name = "parent";
        } else {
            $guard_name = "web";
        }
        return $guard_name;
    }


    public function redirect($request)
    {
        if ($request->type == "student") {
            return redirect()->intended(RouteServiceProvider::STUDENT);
        } elseif ($request->type == "teacher") {
            return redirect()->intended(RouteServiceProvider::TEACHER);
        } elseif ($request->type == "parent") {
            return redirect()->intended(RouteServiceProvider::PARENT);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}

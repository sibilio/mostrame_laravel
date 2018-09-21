<?php

namespace App\Http\Controllers\Back\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChangePasswordAtiveUserController extends Controller
{
    public function showViewNewPassword()
    {
      return view('back.users.mudar-senha-usuario-ativo');
    }
    
    public function changePassword(Request $request)
    {
       $this->validate($request,[
           'nova-senha' => 'password_confirmation:'.$request['confirmacao-senha'].'|required|min:6',
           'confirmacao-senha' => 'required|min:6'
       ]);
       
       $user = Auth::user();
       $user->password = bcrypt($request['nova-senha']);
       $user->save();
       
       return view('back.users.mudar-senha-usuario-ativo')->with('message', true);
    }
}

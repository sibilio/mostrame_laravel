<?php

namespace App\Http\Controllers\Back\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BaseApp\BaseRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   private $userRepository;
   
   public function __construct()
   {
      $this->userRepository = new BaseRepository('App\User');
   }
   
   public function index()
   {
      if(\Illuminate\Support\Facades\Auth::check()){
         return redirect()->route('dashboard');
      }
      else
         return view('back.login.login');
   }
   
   /**
    * Realiza o login via email e senha. Caso positivo redireciona para o
    * dashboard, em caso negativo volta para a tela de login
    * @param Request $request
    * @return view
    */
   public function doLogin(Request $request)
   {
      $remember = isset($request['remember'])?true:false;
      
      $this->loginValidator($request);
      $credenciais = [
          'email' => $request['email'],
          'password' => $request['password']
      ];
      
      if(Auth::attempt($credenciais, $remember))
         return redirect()->route('dashboard');
      else
         return view('back.login.login')->with("loginErr", true);
   }
   
   public function logout()
   {
      Auth::logout();
      return redirect()->route('login');
   }
   
   public function goDashboard()
   {
      return view('back.dashboard');
   }
   
   /**
    * Validador para a tela de login
    * @param Request $request
    */
   private function loginValidator(Request $request)
   {
      $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required|max:20'
      ]);
   }
}

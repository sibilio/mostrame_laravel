<?php

namespace App\Http\Controllers\Back\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\ControlAccess\PasswordRecovery;

class RecoveryPasswordController extends Controller
{
   private $passwordRecovery;
   
   public function __construct()
   {
      $this->passwordRecovery = new PasswordRecovery();
   }
    /**
    * Recebe via $request a nova senha e o email do usuário para atualizar a senha
    * ao final redireciona para a tela de login
    * @param Request $request
    */
   public function salvarNovaSenha(Request $request)
   {
      $this->validarSenhas($request);
         
      if(PasswordRecovery::changePassword($request['user_id'], $request['passwordConfirmation']))
         return view ('back.login.mensagem-senha-recuperada-com-sucesso');
      else
         return "A alteração falhou!";
   }
   
   /**
    * Através de token que fora enviado anteriormente para o email do usuário
    * esse método abre a janela para digitação de nova senha caso o token
    * seja válido.
    * @param string $token Token para recuperação de senha passado via URL
    */
   public function telaRecuperarSenha($token)
   {
      $user_id = PasswordRecovery::validateToken($token);
      //return var_dump($user_id);
      if($user_id > 0)
         return view('back.login.recuperacao-de-senha')
                  ->with('user_id', $user_id);
      else
         return view ('back.login.mensagem-token-invalido');
   }
   
   public function telaDigitaEmailNovaSenha($showMessage)
   {
      $showMessage = ($showMessage === 'yes')?true:false;
      return view('back.login.digita-email-nova-senha')
               ->with('mensagem', $showMessage);
   }
   
   /**
    * Envia o link para digitação de nova senha para o email do cliente.
    * @param string $email
    */
   public function enviarLink(Request $request)
   {
      $this->validate($request, [
         'email' => 'required|email'
      ]);

      $this->passwordRecovery->createLink($request['email']);
      
      return redirect()->route('recovery::telaDigitaEmailNovaSenha', ['showMessage'=>'yes']);
   }
   
   /**
    * Valida a digitação do email e a confirmação do email
    * @param type $request
    */
   private function validarSenhas($request)
   {
      $this->validate($request, [
          'password' => 'required|min:'.env('MIN_PASSWORD').'|password_confirmation:'.$request['passwordConfirmation'],
          'passwordConfirmation' => 'required|min:'.env('MIN_PASSWORD')
      ]);
   }
}

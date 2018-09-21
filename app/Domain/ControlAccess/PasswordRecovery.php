<?php
namespace App\Domain\ControlAccess;

use App\BaseApp\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

/**
 * Realiza as funções necessárias para recuperação de senha esquecida
 */
class PasswordRecovery
{
   /**
    * Cria o link para recuperação da senha
    * @param string $email Email do usuário
    * @return string Link de recuperação ou FALSE caso não exista o email.
    */
   public static function createLink(string $email)
   {
      $user = self::getUser($email);
      
      if (!is_null($user)) {
         $token = bcrypt($email.time());
         $token = self::sanitizeToken($token);
         
         $sql = 'insert into password_resets (';
         $sql.= 'email,';
         $sql.= 'token,';
         $sql.= 'created_at';
         $sql.= ') values (?, ?, ?)';
         
         $hora = Carbon::now();
         DB::insert($sql, [$user->email, $token, $hora]);
         
         $link = route('recovery::recuperarSenha', ['token'=>$token]);
         
         self::enviarLink($email, $link);
         
         return true;
      }
      return false;
   }
   
   /**
    * Faz a validação do token enviado no link
    * @param string $token
    * @return integer Retorna um número inteiro que é o id do usuário que possui o token, caso
    * o token não seja encontrado retorna 0.
    */
   public static function validateToken(string $token)
   {
      //$ps representa a tabela password_resets
      $ps = DB::table('password_resets')->where('token', $token)->first();
      
      if(!is_null($ps)){
         //deleta o token se foi criado a mais de uma hora e retorna 0
         $horaToken = Carbon::parse($ps->created_at)->timestamp;
         if(Carbon::now()->timestamp > ($horaToken+3600)){ //3600  = 60min x 60seg = 1 hora que tem 3600 segundos
            DB::delete('delete from password_resets where token = :token', ['token'=>$token]);
            return 0;
         }
         
         $user = self::getUser($ps->email);
         return $user->id;
      }
      
      return 0;
   }
   
   /**
    * Grava a nova senha no registro do usuário
    * @param integer $user_id
    * @param string $newPassword
    * @return boolean Retorna true caso a operação senha bem sucedida, caso contrário retorna false.
    */
   public static function changePassword($user_id, $newPassword)
   {
      $ur = new BaseRepository('App\User');
      $user = $ur->get($user_id);
      
      if($user !== false){
         $user->password = bcrypt($newPassword);
         $user->save();
         
         self::deleteToken($user->email);
         
         return true;
      }
      return false;
   }
   
   /**
    * Retira todos os caracteres que podem dar algum problema na URL por caracteres que certamente não dão.
    * @param string $token
    * @return string Token sanitizado.
    */
   private static function sanitizeToken($token)
   {
      $wrongCaracters = [
          "\'", '\"', '!', '@', '#', '$', '/', '*', '.',
          '%', '&', '*', '-', '~', '^', '\\', '+'
      ];
      
      $newCaracter = function () {
         return rand(1, 999);
      };
      
      $sanitizetedToken = str_replace($wrongCaracters, $newCaracter(), $token);
      $sanitizetedToken = substr($sanitizetedToken, 0, 70);
      
      return $sanitizetedToken;
   }
   
   private static function getUser($email)
   {
      $userRepository = new BaseRepository("App\User");
      $user = $userRepository->where("email", $email);
      return $user;
   }
   
   private static function enviarLink($email, $link)
   {
      Mail::to($email)
          ->send(new \App\Mail\RecoveryEmail($link));
   }
   
   private static function deleteToken($email)
   {
      DB::delete('delete from password_resets where email = :email', ['email'=>$email]);
   }
}


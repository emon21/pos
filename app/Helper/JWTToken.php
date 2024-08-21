<?php


namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;


//class

class JWTToken
{

   //Create Token
   public static function CreateToken($userEmail,$userID): string
   {
      //key
      $key = env('JWT_KEY');
      $payload = [
         'iss' => 'laravel-token',
         'iat' => time(),
         'exp' => time() + 60 * 60,
         'userEmail' => $userEmail,
         'userID' => $userID
      ];

      //Token Generate
      $jwt = JWT::encode($payload, $key, 'HS256');
      return $jwt;
   }

   public static function CreateTokenSetPassword($userEmail):string{

      //key
      $key = env('JWT_KEY');
      $payload = [
         'iss' => 'laravel-token',
         'iat' => time(),
         'exp' => time() + 60 * 10 ,
         'userEmail' => $userEmail,
         'userID' => '0'
      ];

      //Token Generate
      $jwt = JWT::encode($payload, $key, 'HS256');
      return $jwt;
   }

   //Verify Token
   public static function VerifyToken($token): string|object
   {
      try {
         if($token==null){
            return 'unauthorized';
         }else{
            $key = env('JWT_KEY');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return $decoded;
         }
         
      } 
      catch (Exception $ex) {
         return 'unauthorized';
      }
   }

   //Check Token
  
}

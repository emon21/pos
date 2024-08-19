<?php


namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;


//class

class JWTToken
{

   //Create Token
   public static function CreateToken($userEmail): string
   {
      //key
      $key = env('JWT_KEY');
      $payload = [
         'iss' => 'laravel-token',
         'iat' => time(),
         'exp' => time() + 60 * 60,
         'userEmail' => $userEmail
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
         'userEmail' => $userEmail
      ];

      //Token Generate
      $jwt = JWT::encode($payload, $key, 'HS256');
      return $jwt;
   }

   //Verify Token
   function VerifyToken($token): string
   {
      try {
         $key = env('JWT_KEY');
         $decoded = JWT::decode($token, new Key($key, 'HS256'));
         return $decoded->userEmail;
      } 
      catch (Exception $ex) {
         return 'unauthorized';
      }
   }

   //Check Token
  
}

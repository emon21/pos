<?php


namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken{


   // public static function generateToken($data)
   // {
   //    $jwt = \Firebase\JWT\JWT::encode($data, env('JWT_SECRET'));
   //    return $jwt;
   // }


   public static function CreateToken($userEmail):string{

      $key =env('JWT_KEY');
      $payload = [
         'iss' =>'laravel-token',
         'iat' => time(),
         'exp' =>time() +60*60,
         'userEmail' => $userEmail
      ];


     $jwt = JWT::encode($payload,$key,'HS256');

     return $jwt;
 
   }


   function VerifyToken($token):string{
      try{

         $key = env('JWT_KEY');
         $decode = JWT::decode($token, new Key($key, 'HS256'));
         return $decode->userEmail;
      

      }catch(Exception $ex){
         
         return 'unauthorized';
      
   }


}

}
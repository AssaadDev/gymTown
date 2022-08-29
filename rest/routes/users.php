<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
/*
**  CRUD for gymTown
*/

// not sure if im using it
// Flight::route('POST /Users', function(){
//   Flight::json(Flight::usersSrv()->add(Flight::request()->data->getData()));  // short vesrion of code from the code above
// });


/**
 * @OA\Get(path="/Users/{id}", tags={"Users"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return one Users from the API.",
 *     @OA\Parameter(in="path", name="id", example=1, description="List one Users "),
 *     @OA\Response(response="200", description="Fetch Users")
 * )
 */

Flight::route('GET /Users/@id', function($id){
  Flight::json(Flight::usersSrv()->get_by_id($id));
});


/**
 * @OA\Get(path="/Users", tags={"Users"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all Users from the API. ",
 *         @OA\Response( response=200, description="List of Users."),
 *         @OA\Response( response=404, description="error")
 * )
 */

Flight::route('GET /Users', function(){
    Flight::json(Flight::usersSrv()->get_all(Flight::query('search'))); //Flight::json() vraca nam json format
});


/**
* @OA\Post(
*     path="/UserDelete/{id}", security={{"ApiKeyAuth": {}}},
*     summary="Add Users",
*     description="Add Users",
*     tags={"Users"},
*     @OA\RequestBody(description="Users info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*           @OA\Parameter(in="path", name="id", example=20, description="ID of the Users"),
*    				@OA\Property(property="id", type="string", example="20",	description="ID of the Users"),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="User has been DELETED"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

Flight::route('POST /UserDelete/@id', function($id){
  Flight::usersSrv()->deletedUser($id);
  Flight::json(["message"=>"Succesfully deleted!"]);
});

/**
* @OA\Put(
*     path="/Users/{id}", security={{"ApiKeyAuth": {}}},
*     summary="Update User from the API. ",
*     description="Update User",
*     tags={"Users"},
*     @OA\Parameter(in="path", name="id", example=1, description="User ID"),
*     @OA\RequestBody(description="Basic Gym info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="id", type="string", example="11",	description="ID of the gym"),
*    				@OA\Property(property="name", type="string", example="testUser",	description="name of the gym"),
*    				@OA\Property(property="password", type="string", example="12345",	description="address of the gym" )
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="User has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

Flight::route('PUT /Users/@id', function($id){
  $data = Flight::request()->data->getData();  // Flight::request() vraca nam sta je poslano na API (ex. query spec, id, object, ...);
  $data['id'] = $id;
  Flight::json(Flight::usersSrv()->update($data));
});


/**
* @OA\Post(
*     path="/register", 
*     summary="Add Users",
*     description="Add Users",
*     tags={"Users"},
*     @OA\RequestBody(description="Users info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="testUser",	description="name of the User"),
*    				@OA\Property(property="email", type="string", example="testEmail",	description="email of the User" ),
*           @OA\Property(property="password", type="string", example="123",	description="password of the User" ),
*           @OA\Property(property="phone", type="string", example="1235322123",	description="phone of the User" ),
*           @OA\Property(property="gender", type="string", example="male",	description="gender of the User" ),
*           @OA\Property(property="status", type="string", example="ACTIVE",	description="status of the User" )
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="User has been created"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

 Flight::route('POST /register', function(){
   Flight::json(Flight::usersSrv()->register(Flight::request()->data->getData()));  // short vesrion of code from the code above
 });


 /**
 * @OA\Post(
 *     path="/verify", security={{"ApiKeyAuth": {}}},
 *     summary="Password check",
 *     description="Password check",
 *     tags={"Users"},
 *     @OA\RequestBody(description="Users info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="id", type="string", example="1",	description="id of the User"),
 *    				@OA\Property(property="password", type="string", example="1234",	description="password of the User" )
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Password OK"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error, Bad password"
 *     )
 * )
 */

 Flight::route('POST /verify', function(){
   $data = Flight::request()->data->getData();
   $userDB = Flight::usersSrv()->verify(Flight::request()->data->getData());  // short vesrion of code from the code above
   //print_r($userDB[0]['password'] === $data['password']);
   if($userDB[0]['password'] == md5($data['password'])){
     Flight::json(["message" => "Password OK"], 200);
   }else{
     Flight::json(["message" => "Password not correct"], 404);
   }
 });


 /**
 * @OA\Post(
 *     path="/login",
 *     summary="login check",
 *     description="login check",
 *     tags={"Users"},
 *     @OA\RequestBody(description="login info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="email", type="string", example="audi@tt.rs",	description="email of the User"),
 *    				@OA\Property(property="password", type="string", example="12345",	description="password of the User" )
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="User ok"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $user = Flight::usersSrv()->login($login['email']);
      if (isset($user[0]['id'])){
        if($user[0]['status'] == 'ACTIVE' || $user[0]['status'] == 'ADMIN' ){
          if($user[0]['password'] == md5($login['password'])){
            unset($user[0]['password']);
            $jwt = JWT::encode($user[0], Config::JWT_SECRET(), 'HS256');
            Flight::json(['token' => $jwt, 'userID' => $user[0]['id'], 'status' => $user[0]['status']]);
          }else{
            Flight::json(["message" => "Wrong password"], 404);
          }
        }else{
          Flight::json(["message" => "User doesn't Exists"], 404);
        }
      }else{
        Flight::json(["message" => "User doesnt exist"], 404);
      }
  });

?>

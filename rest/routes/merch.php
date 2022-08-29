<?php

/*
**  CRUD for gymTown
*/

/**
 * @OA\Get(path="/Merch/{id}", tags={"Merch"},
 *     summary="Return one Merch from the API.",
 *     @OA\Parameter(in="path", name="id", example=1, description="List one Merch"),
 *     @OA\Response(response="200", description="Fetch Gym")
 * )
 */

Flight::route('GET /Merch/@id', function($id){
  Flight::json(Flight::merchSrv()->get_by_id($id));
});


/**
 * @OA\Get(path="/Merch", tags={"Merch"},
 *         summary="Return all Gym from the API. ",
 *         @OA\Parameter(in="query", name="gender", example="male", description="Search critieri"),
 *         @OA\Parameter(in="query", name="category", example="top", description="Search critieri"),
 *         @OA\Response( response=200, description="List of Merch."),
 *         @OA\Response( response=404, description="error")
 * )
 */

Flight::route('GET /Merch', function(){
  if(Flight::query('category') != NULL || Flight::query('gender') != NULL){
    Flight::json(Flight::merchSrv()->get_query_spec(Flight::query('category'),Flight::query('gender')));
  }else{
    Flight::json(Flight::merchSrv()->get_all(NULL));
  }
});


/**
* @OA\Post(
*     path="/MerchAdd", security={{"ApiKeyAuth": {}}},
*     summary="Add Merch",
*     description="Add Merch",
*     tags={"Merch"},
*     @OA\RequestBody(description="Merch info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="testMerch",	description="property of the Merch"),
*    				@OA\Property(property="price", type="string", example="COMING SOON",	description="property of the Merch" ),
*           @OA\Property(property="gender", type="string", example="unisex",	description="property of the Merch" ),
*           @OA\Property(property="photo", type="string", example="https://i.pinimg.com/736x/0a/bb/e5/0abbe546e479edc1eb62f5a8ccd66328.jpg",	description="description of the Merch"),
*    				@OA\Property(property="category", type="string", example="top",	description="property time of the Merch" )
*                )
*     )),
*     @OA\Response(
*         response=200,
*         description="Merch has been created"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

Flight::route('POST /MerchAdd', function(){
  Flight::json(Flight::merchSrv()->add(Flight::request()->data->getData()));  // short vesrion of code from the code above
});



?>

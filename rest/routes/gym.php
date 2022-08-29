<?php

/*
**  CRUD for gymTown
*/

/**
* @OA\Post(
*     path="/GymAdd", security={{"ApiKeyAuth": {}}},
*     summary="Add gym",
*     description="Add Gym",
*     tags={"Gym"},
*     @OA\RequestBody(description="Gym info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="testGym",	description="name of the gym"),
*    				@OA\Property(property="address", type="string", example="testAddress",	description="address of the gym" ),
*           @OA\Property(property="phone", type="string", example="testPhone",	description="phone of the gym" ),
*           @OA\Property(property="photo", type="string", example="https://thumbs.dreamstime.com/b/funny-fat-man-doing-exercises-gym-beard-124799986.jpg",	description="photo of the gym"),
*    				@OA\Property(property="workTime", type="string", example="00:00 - 24:00",	description="work time of the gym" )
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Gym has been created"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

Flight::route('POST /GymAdd', function(){
  Flight::json(Flight::gymSrv()->add(Flight::request()->data->getData()));  // short vesrion of code from the code above
});

/**
 * @OA\Get(path="/Gyms/{id}", tags={"Gym"},
 *     summary="Return one Gym from the API.",
 *     @OA\Parameter(in="path", name="id", example=1, description="List one Gym"),
 *     @OA\Response(response="200", description="Fetch Gym")
 * )
 */

Flight::route('GET /Gyms/@id', function($id){
  Flight::json(Flight::gymSrv()->get_by_id($id));
});

/**
 * @OA\Get(path="/Gyms", tags={"Gym"},
 *         summary="Return all Gym from the API. ",
 *         @OA\Parameter(in="query", name="search", description="Search critieri"),
 *         @OA\Response( response=200, description="List of Gyms."),
 *         @OA\Response( response=404, description="error")
 * )
 */

Flight::route('GET /Gyms', function(){
  Flight::json(Flight::gymSrv()->get_all(Flight::query('search'))); //Flight::json() vraca nam json format
});

/**
* @OA\Put(
*     path="/GymUp/{id}", security={{"ApiKeyAuth": {}}},
*     summary="Update Gym from the API. ",
*     description="Update Gym",
*     tags={"Gym"},
*     @OA\Parameter(in="path", name="id", example=1, description="Gym ID"),
*     @OA\RequestBody(description="Basic Gym info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="id", type="string", example="2",	description="ID of the gym"),
*    				@OA\Property(property="name", type="string", example="ALL IN",	description="name of the gym"),
*    				@OA\Property(property="address", type="string", example="Malta",	description="address of the gym" ),
*           @OA\Property(property="phone", type="string", example="061-321/287",	description="phone of the gym" ),
*           @OA\Property(property="photo", type="string", example="https://www.shuafitness.com/wp-content/uploads/2021/11/SHUA-gym-solution-for-Ireland-1-1.jpg",	description="photo of the gym"),
*    				@OA\Property(property="workTime", type="string", example="09:30-21:30",	description="work time of the gym" )
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Gym has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

Flight::route('PUT /GymUp/@id', function($id){
  $data = Flight::request()->data->getData();  // Flight::request() vraca nam sta je poslano na API (ex. query spec, id, object, ...);
  $data['id'] = $id;
  Flight::json(Flight::gymSrv()->update($data));
});

?>

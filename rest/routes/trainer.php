<?php

/*
**  CRUD for gymTown
*/


/**
 * @OA\Get(path="/Trainer/{id}", tags={"Trainer"},
 *     summary="Return one Trainer from the API.",
 *     @OA\Parameter(in="path", name="id", example=1, description="List one Trainer"),
 *     @OA\Response(response="200", description="Fetch Trainer")
 * )
 */

Flight::route('GET /Trainer/@id', function($id){
  Flight::json(Flight::trainerSrv()->get_by_id($id));
});


/**
 * @OA\Get(path="/Trainer", tags={"Trainer"},
 *         summary="Return all Trainers from the API. ",
 *         @OA\Response( response=200, description="List of Trainers."),
 *         @OA\Response( response=404, description="error")
 * )
 */

Flight::route('GET /Trainer', function(){
    Flight::json(Flight::trainerSrv()->get_all(NULL));
});


?>

<?php

/*
**  CRUD for gymTown
*/

/**
 * @OA\Get(path="/Plans", tags={"Plans"}, 
 *         summary="Return all Plans from the API. ",
 *         @OA\Response( response=200, description="List of Plans."),
 *         @OA\Response( response=404, description="error")
 * )
 */

Flight::route('GET /Plans', function(){
      Flight::json(Flight::plansSrv()->get_all(NULL));
});

?>

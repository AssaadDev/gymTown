<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once '../vendor/autoload.php';

require_once 'dao/GymsDao.class.php';
require_once 'dao/MerchDao.class.php';
require_once 'dao/PlansDao.class.php';
require_once 'dao/TrainerDao.class.php';
require_once 'dao/UsersDao.class.php';

require_once 'services/gymService.class.php';
require_once 'services/merchService.class.php';
require_once 'services/plansService.class.php';
require_once 'services/trainerService.class.php';
require_once 'services/usersService.class.php';

    Flight::register('gymSrv','gymService');
    Flight::register('merchSrv','merchService');
    Flight::register('plansSrv','plansService');
    Flight::register('trainerSrv','trainerService');
    Flight::register('usersSrv','usersService');


    // Flight::map('error', function(Exception $ex){
    //     // Handle error
    //     Flight::json(['message' => $ex->getMessage()], 500);
    // });

    /* utility function for reading query parameters from URL */
    Flight::map('query', function($name){
      echo "test1";
      $request = Flight::request();
      $query_param = @$request->query->getData()[$name];
      $query_param = $query_param ? $query_param : NULL;
      return urldecode($query_param);
    });

    Flight::route('/*', function(){
      //return TRUE;
      //perform JWT decode
      $path = Flight::request()->url;

      if ($path === '/Users' || str_contains($path, '/Users/') || str_contains($path, '/UserDelete/') ||
          $path === '/verify' || $path === '/MerchAdd' || str_contains($path, '/GymUp/') || $path === '/GymAdd')
          {

              $headers = getallheaders();
              if (@!$headers['Authorization']){
                Flight::json(["message" => "Authorization is missing"], 403);
                return FALSE;
              }else{
                try {
                  $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
                  Flight::set('user', $decoded); // check this
                  return TRUE;
                } catch (\Exception $e) {
                  Flight::json(["message" => "Authorization token is not valid"], 403);
                  return FALSE;
                }
              }
            }else{
              return TRUE;
            }
});

/* REST API documentation endpoint */
Flight::route('GET /docs.json', function(){
  $openapi = \OpenApi\scan('routes');
  header('Content-Type: application/json');
  echo $openapi->toJson();
});

    require_once dirname(__FILE__).'/routes/gym.php'; // calling routes
    require_once dirname(__FILE__).'/routes/merch.php'; // calling routes
    require_once dirname(__FILE__).'/routes/plans.php'; // calling routes
    require_once dirname(__FILE__).'/routes/trainer.php'; // calling routes
    require_once dirname(__FILE__).'/routes/users.php'; // calling routes


    Flight::start();
 ?>

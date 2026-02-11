<?php

use app\controllers\UserController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
 
/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->map('/', function() use ($app) {
		$app->render('login');
	});

	$router->get('/LoginForm', function() use ($app){
	$username=$_GET['username']??'';
	$email=$_GET['email']??'';
	$password=$_GET['password']??'';

	$userController=new UserController($app);

	$result=$userController->CheckUser($username,$email,$password);

	if(isset($result['isAdmin']) && $result['isAdmin']==true){
		$app->render('categorie',['username'=>$result['donnees']['username'],'id'=>$result['donnees']['id']]);
		return;
	}else{
		if(isset($result['error'])){
			$app->render('login',['error'=>$result['error']]);
		}else{
			$app->render('messages',['username'=>$result['username'],'id'=>$result['id']]);
		}
	}
});

	// $router->get('/hello-world/@name', function($name) {
	// 	echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	// });

	// $router->group('/api', function() use ($router) {
	// 	$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
	// 	$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
	// 	$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	// });


	
}, [ SecurityHeadersMiddleware::class ]);
<?php
/*
|--------------------------------------------------------------------------
| Middleware requirements
|--------------------------------------------------------------------------
|
| Add Middleware to App
|
*/

/*
|--------------------------------------------------------------------------
| Whoops errors format
| Must be APP_DEBUG = true
|--------------------------------------------------------------------------
*/
$whoopsGuard = new \Zeuxisoo\Whoops\Provider\Slim\WhoopsGuard();
$whoopsGuard->setApp($app);
$whoopsGuard->setRequest($container['request']);
$whoopsGuard->setHandlers([]);
$whoopsGuard->install();

/*
 *
|--------------------------------------------------------------------------
| Error Middleware
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Minecraft Ip generator Middleware
|--------------------------------------------------------------------------
*/
$app->add(new \App\Middlewares\IpGeneratorMiddleware($container));
$app->add(new \App\Middlewares\VoteCountMiddleware($container));
$app->add(new \App\Middlewares\MinifyMiddleware($container));


$app->add(new \App\Middlewares\Auth\LoginMiddleware($container));
$app->add(new \App\Middlewares\GroupMiddleware($container));

\Validator\ValidationLanguage::setLang('fr');
<?php
/*
require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->run();
*/

$url = $_GET['url'];
$curl_url = 'https://labs.diffbot.com/testdrive/article?token=testdriverehjenztgeil&url='.$url;

// init curl object        
$ch = curl_init();

// define options
$optArray = array(
    CURLOPT_URL => $curl_url,
    CURLOPT_RETURNTRANSFER => true
);

// apply those options
curl_setopt_array($ch, $optArray);

// execute request and get response
$result = curl_exec($ch);

echo $result;

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

<?php 
$proxies = array('86.188.142.244:8080'); // random public http proxy

function getData($proxylist)
{
    $rand_proxy = rand(0,count($proxylist)-1);
    $agent = "Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/532.4 (KHTML, like Gecko) Chrome/4.0.233.0 Safari/532.4";
    $referer = "http://www.google.com/";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $curl_url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_PROXY, $proxylist[$rand_proxy]);
    $data = curl_exec($ch);
    if($data!==true){$ex=new RuntimeException('curl_exec error. errno: '.curl_errno($ch).' error: '.curl_error($ch));@curl_close($ch);throw $ex;}
    curl_close($ch);
    echo $data;
}

getData($proxies);

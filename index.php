<?php
session_start(); // On appelle session_start() APRÈS avoir enregistré l'autoload.
// echo 'test' .' '. 'test'.' '. sodium_crypto_pwhash_str('test', SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE, SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE).'</br>';
require 'autoload.php';
require_once 'vendor/autoload.php';

//uniquement en debbugging
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );





/*
 $loader = new \Twig\Loader\FilesystemLoader('view');
 $twig = new \Twig\Environment($loader);

 $monTableau = ['nom=>Frati, prenom=>Fred'];
 $data=[
   'title' => 'Mon super blog',
   'monTableau' =>$monTableau
 ];
 echo $twig->render('test.twig', $data);
 die;
 */

$controllerPath = 'controller';

if( isset( $_GET['controller'] ) ) {
  $controllerName = ucfirst($_GET['controller']);
} else {
  $controllerName = 'Home';
}
$fileName = 'controller/' . $controllerName . 'Controller.php';
$className = $controllerPath . '\\' . $controllerName . 'Controller';



if( file_exists( $fileName) ) {
  if( class_exists( $className ) ) {
    $controller = new $className();
  } else {
    exit( "Error : Class not found!" );
  }
} else {
  exit( "Error 404 : not found!" );
}

?>

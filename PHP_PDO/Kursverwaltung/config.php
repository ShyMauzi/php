<?php
/**
 * Created by PhpStorm.
 * User: L.Klaes
 * Date: 19.10.2018
 * Time: 11:21
 * Verbindung zum Webserver und zur DB coursema
 */
try {
    $server = 'localhost';
    $db = 'coursema';
    $user = 'root';
    $pwd = '';
    $con = new PDO('mysql:host=' . $server . ';dbname=' . $db . ';charset=utf8', $user, $pwd);
    //Exception Handling explizit einschalten
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exceptin $e) {

    //Fehlerbehebung
    echo $e->getMessage() . '<br>';
}
<?php
/* Florian Auzinger, 25.01.2020
    db Kursverwaltung
    Verbindung zum Server/zur DB
*/
$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'kursverwaltung';

try
{
    $con = new PDO('mysql:host='.$server.';dbname='.$db.';charset=utf8', $user, $pwd);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e)
{
    switch($e->getCode())
    {
        case 1049:
            echo 'Die angegebene DB '.$db.'existiert nicht! Wenden sie sich an den Administrator';
            break;
        default:
            echo $e->getMessage();
    }
    echo $e->getMessage();
}
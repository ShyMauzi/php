<?php
/* Florian Auzinger, 14.01.2020
   Wiederholung PHP/PDO mit MySQL/MariaDB

   config.php */

$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'movie';

try
{
    $con = new PDO('mysql:host='.$server.';dbname='.$db.';charset=utf8', $user, $pwd);
    // Exception Handling explizit einschalten
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (Exception $e)
{
    switch ($e->getCode())
    {
        case 2002:
            echo '<span style="color:red"> Der angegebene Host ist unbekannt. </span>';
            break;
        default:
            echo $e->getMessage();
    }
    echo $e->getMessage();
}

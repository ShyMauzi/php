<?php
echo '<h1>Tabelle-Schule</h1>';
try
{
    /* Tabelle aller Personen */
    $query = 'select * from person';
    $select = $con->prepare($query);
    $select->execute();

    while($row = $select->fetch(PDO::FETCH_NUM))
    {
        /*foreach($row as $r)
        {
            echo $r.' ';
        }*/
        echo $row[0].' '.$row[1].' '.$row[2];
        echo '<br>';
    }

    /* Alle Lehrberufe in Tabelle ausgeben*/

    $query = 'select * from lehrberuf';
    $select = $con->prepare($query);
    $select->execute();

    echo '<table border ="1">';
    while($row = $select->fetch())
    {
        echo '<tr>';
        foreach($row as $r)
        {
            echo '<td>'.$r.'</td>';
        }
        echo '<tr>';
        //echo $row[0].' '.$row[1].' '.$row[2];
        echo '<br>';
    }
    echo '</table>';

}
catch (Exception $e)
{
    echo $e->getMessage();
}
?>
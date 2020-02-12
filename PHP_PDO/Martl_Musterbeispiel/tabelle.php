<?php
echo '<h1>Schule</h1>';
try
{
    /* Tabelle aller Personen */
    $query = 'select * from person';
    $select = $con->prepare($query);
    $select->execute();
    while($row = $select->fetch())
    {
        /*foreach($row as $r)
            echo $r.' ';*/
        echo $row[0].' '. $row[1].' '.$row[2];
        echo '<br>';
    }
    echo '<br>';
    /* Alle Lehrberufe in Tabelle ausgeben */

    $query_lb = 'select leh_name_lang, leh_name_kurz 
as "Kurz" from lehrberuf';
    $selLB = $con->prepare($query_lb);
    $selLB->execute();
    echo '<table class="table">
          <tr class="table-bordered">';
    for($i = 0; $i < $selLB->columnCount(); $i++)
    {
        echo '<th class="table-bordered">'.$selLB->
            getColumnMeta($i)['name'].'</th>';
    }
    echo '</tr>';
    while($row = $selLB->fetch(PDO::FETCH_NUM))
    {
        echo '<tr>';
        foreach($row as $r)
            echo '<td class="table-striped">'.$r.'</td>';
        echo '</tr>';
    }

    echo '</table>';
} catch(Exception $e)
{
    echo $e->getMessage();
}
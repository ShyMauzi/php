<?php
echo '<h1>Formular-Schule</h1>';
if (isset($_POST['save']))
{
    //TODO
}
else
{
    /* Erstellen Sie ein Formular zum Erfassen von Personen + Funktion */
    echo '<table>';
    //echo '<form action="" method= "get">';
    echo '<tr>';

    echo '<label for="vorname">Vorname:</label>';
    echo '<input type="text" name="vorname" id="vorname" required placeholder="z.B. Max"> <br>';

    echo '</tr>';
    echo '<tr>';

    echo '<label for="nachname">Nachname:</label>';
    echo '<input type="text" name="nachname" id="nachname" required placeholder="z.B. Mustermann"> <br>';

    echo '</tr>';
    echo '<tr>';

    echo '<label for="funktion">Funktion:</label>';
    echo '<input type="text" name="funktion" id="funktion" required placeholder="z.B. Lehrer"> <br>';

    echo '</tr>';
    echo '<tr>';

    echo '<input type="submit" value ="Speichern" name="save">';

    echo '</tr>';
    echo '</table>';

    $insertPersonQuery = 'insert into person values (?, ?)';
    //$select = $con->prepare($query);
    //$select->execute();
}
<?php
/**
 * Created by PhpStorm.
 * User: L.Klaes
 * Date: 19.10.2018
 * Time: 11:39
 * Kursliste.php
 */
?>
<!Doctype HTML>
<html>
<head>
    <title>Kursliste</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Formatierung.css">
</head>
<body>
<nav>
    <?php
    include 'menu.html'
    ?>
</nav>
<main>
    <?php
    include 'config.php';
    try {
        $stmt = $con->prepare
        ('select c.crs_id "Kurs_ID",c.crs_name "Bezeichnung",
        ch.coh_starttime "Startdatum",p.per_sirname "Vortragender" from course c,coursehist ch, person p 
        where c.crs_id=ch.crs_id and c.per_id=p.per_id ');

        $stmt->execute();

        $meta = array();
        echo '<table border="1">
        <tr>';
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $meta[$i] = $stmt->getColumnMeta($i);
            echo '<th>' . $meta[$i]['name'] . '</th>';
        }
        echo '</tr>';
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<tr>';
            foreach ($row as $r) {
                echo '<td>' . $r . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

    } catch (Exception $e) {
        echo '$e';
    }
    ?>
</main>
</body>
</html>

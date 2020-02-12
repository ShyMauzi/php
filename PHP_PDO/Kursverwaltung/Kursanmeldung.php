<?php
/**
 * Created by PhpStorm.
 * User: L.Klaes
 * Date: 22.10.2018
 * Time: 11:39
 * Kursanmeldung.php
 */
?>
<!Doctype HTML>
<html>
<head>
    <title>Kursanmeldung</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Formatierung.css">
</head>
<body>
<nav>
    <?php
    include 'menu.html';
    ?>
</nav>
<main>
    <h1>Kursanmeldung</h1>

    <?php
    include 'config.php';
    if (isset($_POST['show'])) {
        echo '<table>';
        echo '<tr> <td> Formulardaten verarbeiten.... </td></tr>';
        $person = $_POST['per'];
        $kurs = $_POST['kur'];
        try {
            $stmt = $con->prepare("insert into coursehistperson (coh_id,per_id) values (:coh_id,:per_id)");
            $stmt->bindParam(":coh_id", $kurs);
            $stmt->bindParam("per_id", $person);
            $stmt->execute();

        } catch (Exception $e) {
            echo "$e";
        }

        echo '<tr> <td> Folgende Daten wurden eingefügt </td></tr>';
        echo '<tr> <td> PersonID:' . $person . '</td></tr>';
        echo '<tr> <td> KursID:' . $kurs . '</td></tr>';
        echo '</table>';

    } else {
        echo '<form method="post">';
        echo '<label>Kunde:</label>';
        $query_person = 'select * from person order by per_id';
        $query_course = 'select ch.coh_id,c.crs_name,ch.coh_starttime from course c left join coursehist ch on c.crs_id=ch.crs_id ';
        try {
            $stmt = $con->prepare($query_person);
            $stmt->execute();
            echo '<select name="per">';
            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                echo '<option value="' . $row[0] . '">' . $row[1] . ' ' . $row[2];;

            }
            echo '</select>';


        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
        }

        try {
            echo '<br><label>Kurse:</label>';
            $stmt2 = $con->prepare($query_course);
            $stmt2->execute();
            echo '<select name="kur">';
            while ($row2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                echo '<option value="' . $row2[0] . '">' . $row2[1] . ' ' . $row2[2];;

            }
            echo '</select>';

        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
        };

        echo '<br>';
        ?>
        <input type="submit" name="show" value="Anmelden"> </form>
        <?php
    }

    ?>
</main>
</body>
</html>

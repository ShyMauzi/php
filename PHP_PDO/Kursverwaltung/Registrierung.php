<?php
/**
 * Created by PhpStorm.
 * User: L.Klaes
 * Date: 19.10.2018
 * Time: 11:39
 * Registrierung.php
 */
?>
<!Doctype HTML>
<html>
<head>
    <title>Registrierung</title>
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
    if (isset($_POST['send'])) {
        echo '<h3>Sind Sie sicher, dass Sie die Daten speichern wollen? </h3>';
        ?>
        <form method="post">
            <input type="radio" name="option" value="yes">Ja<br>
            <input type="radio" name="option" value="no">Nein<br>
            <input type="hidden" name="vname_new" value=<?php echo $_POST['vname']; ?>>
            <input type="hidden" name="nname_new" value=<?php echo $_POST['nname']; ?>>
            <input type="submit" name="send_option" value="Datensatz speichern">

        </form>
        <?php
    } else if (isset($_POST['send_option'])) {

        $value = $_POST['option'];

        if ($value == "yes") {

            $vname = $_POST['vname_new'];
            $nname = $_POST['nname_new'];

            try {
                $stmt = $con->prepare("insert into person (per_firstname,per_sirname) values (:per_firstname,:per_sirname)");
                $stmt->bindParam(":per_firstname", $vname);
                $stmt->bindParam("per_sirname", $nname);
                $stmt->execute();

                $stmt = $con->prepare("select per_firstname,per_sirname,per_id from person order by per_id desc limit 1");
                $stmt->execute();
                echo '<h3>Persönliche Daten</h3>';
                $row = $stmt->fetch(PDO::FETCH_NUM);
                $id;
                $count = 0;
                echo '<table>';
                foreach ($row as $r) {
                    if ($count <= 1) {
                        echo '<tr>';
                        echo '<td>' . $r . '</td>';
                        echo '</tr>';
                    } else {
                        $id = $r;
                    }
                    $count++;
                }
                echo '<tr> <td> Persönliche Daten erfasst!' . '</td></tr>';
                echo '<tr> <td> KundenID =' . $id . '</td></tr>';
                echo '</table>';


            } catch (Exception $e) {
                echo $e->getMessage() . '<br>';
            }
        } else {
            echo '<table>';
            echo '<tr> <td> Persönliche Daten wurden nicht gespeichert! </td></tr>';
            echo '</table>';
        }
    } else {
        ?>
        <h1>Registrierung</h1>
        <form method="post">
            <label for="vn">Vorname: </label>
            <input id="vn" type="text" name="vname" required><br>
            <label for="nn">Nachname: </label>
            <input id="nn" type="text" name="nname" required><br>
            <input type="submit" name="send" value="Speichern">
        </form>
        <?php
    }
    ?>
</main>
</body>
</html>
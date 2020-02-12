<?php
/* Florian Auzinger, 25.01.2020
    db Kursverwaltung
    Suche nach einem Trainer
*/

echo '<h1>Suche nach Trainern</h1>';

?>

<style>
    th {
        padding: 5px;
    }
    td {
        padding: 5px;
    }
</style>
<?php

if(isset($_POST['search']))
{
    try
    {
        $kurzz = $_POST['kurzz'];

        $query = 'select t.vorname, t.nachname, t.kurzzeichen, k.kursname from trainer t, kurs k where k.trainer_id = t.trainer_id and t.kurzzeichen like ?;';
        $select = $con->prepare($query);
        $kurzz = '%'.$kurzz.'%';
        $select->execute([$kurzz]);
        ?>

        <table>
        <tr>
            <th>Vorname</th><th>Nachname</th><th>Kurzzeichen</th><th>Kursname</th>
        </tr>

        <?php
        while ($row = $select->fetch(PDO::FETCH_NUM)) {
            echo '<tr>';
            foreach ($row as $r) {
                echo '<td>' . $r . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        echo '<input type="button" onclick="history.back(-1)" value="Back"/>';

    } catch(Exception $e)
    {
        echo $e->getMessage();
    }
}
else
{
    try
    {
        ?>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label for="kurzz">Kurzzeichen</label>
                        <input type="search" id="kurzz" name="kurzz"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="search" value="Suche"/>
                    </td>
                </tr>

            </table>

        </form>
    <?php
    }
    catch (Exception $e)
    {
        $e->getMessage();
    }
}
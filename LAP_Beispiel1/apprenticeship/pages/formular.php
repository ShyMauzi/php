<style>
    td {
        padding: 5px;
    }
</style>
<?php
echo '<h1>Trainer hinzufügen</h1>';
if(isset($_POST['insert']))
{
    try
    {
        $vname = $_POST['vname'];
        $nname = $_POST['nname'];
        $kurzz = $_POST['kurzz'];
        
        $query = 'insert into trainer (vorname, nachname, kurzzeichen) values (?, ?, ?)';
        $select = $con->prepare($query);
        $select->execute([$vname, $nname, $kurzz]);

        echo '<h2>Trainer erfolgreich hinzugefügt!</h2>';

        echo '<input type="button" onclick="history.back(-1)" value="Back"/>';

    } catch(Exception $e)
    {
        echo $e->getMessage();
    }
}
else
{
    ?>
    <form method="post">
        <table>
            <tr>
                <td><label for="vname">Vorname: </label><input type="text" id="vname" name="vname"></input></td>
            </tr>
            <tr>
                <td><label for="nname">Nachname: </label><input type="text" id="nname" name="nname"></input></td>
            </tr>
            <tr>
                <td><label for="kurzz">Kurzzeichen: </label><input type="text" id="kurzz" name="kurzz"></input></td>
            </tr>
            <tr>
                <td><input type="submit" name="insert" value="Einfügen"></input></td>
            </tr>
        </table>
    </form>
<?php
}
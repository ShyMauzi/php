<?php
echo '<h1>Personen (+ Funktion) erfassen</h1>';
if(isset($_POST['save']))
{
    $vname = $_POST['vname'];
    $nname = $_POST['nname'];
    $funid = $_POST['funid'];
    $lbid = $_POST['lbid'];

    echo $vname.', '.$nname.' FunktionsID '.$funid;
    $queryPerson = 'insert into person (per_vname, per_nname) values(?, ?)';
    $queryPerFun = 'insert into person_funktion (per_id, fun_id) values(?, ?)';
    $queryPerFunLB = 'insert into person_funktion_lehrberuf(pefu_id, leh_id) values(?, ?)';

    try
    {
        $insertPerson = $con->prepare($queryPerson);
        $insertPerson->execute([$vname, $nname]);
        $perid = $con->lastInsertId();

        $insertPerFun = $con->prepare($queryPerFun);
        $insertPerFun->execute([$perid, $funid]);
        $pefuid = $con->lastInsertId();

        $insertPerFunLB = $con->prepare($queryPerFunLB);
        $insertPerFunLB->execute([$pefuid, $lbid]);
        echo ' wurde erfolgreich gespeichert.<br>';
    } catch(Exception $e)
    {
        echo $e->getMessage();
    }
} else
{
    /* Erstellen Sie ein Formular
       zum Erfassen von Personen + Funktion */
    ?>
<form method="post">
    <div class="formtable">
        <div class="formtr">
            <div class="formtd">
                <label for="vn">Vorname:</label>
            </div>
            <div class="formtd">
                <input id="vn" type="text" name="vname">
            </div>
        </div>
        <div class="formtr">
            <div class="formtd">
                <label for="nn">Nachname:</label>
            </div>
            <div class="formtd">
                <input id="nn" type="text" name="nname">
            </div>
        </div>
        <div class="formtr">
            <div class="formtd">
                <label for="fu">Funktion:</label>
            </div>
            <div class="formtd">
                <select id="fu" name="funid">
        <?php
        $query = 'select * from funktion order by fun_name';
        $selFun = $con->prepare($query);
        $selFun->execute();
        while($row = $selFun->fetch(PDO::FETCH_NUM))
        {
            echo '<option value="'.$row[0].'">'.$row[1];
        }
        ?>
                </select>
            </div>
        </div>

        <div class="formtr">
            <div class="formtd">
                <label for="lb">Lehrberuf:</label>
            </div>
            <div class="formtd">
                <select id="lb" name="lbid">
                    <?php
                    $query = 'select * from lehrberuf order by leh_name_lang';
                    $selLB = $con->prepare($query);
                    $selLB->execute();
                    while($row = $selLB->fetch(PDO::FETCH_NUM))
                    {
                        echo '<option value="'.$row[0].'">'.$row[2].' - '.$row[1    ];
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="formtr">
            <div class="formtd">
                &nbsp;
            </div>
            <div class="formtd">
                <input type="submit" name="save" value="speichern">
            </div>
        </div>
    </div>
</form>
<?php
}
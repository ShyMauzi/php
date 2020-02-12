<?php
echo '
<h1>PHP Seite</h1>';

try
{
    $query = 'select g.name "Genre", 
                     concat_ws(\' \', m.originalTitle, m.rentalTitle) "Filmtitel", 
	                 m.releaseYear "Jahr", 
	                 group_concat(concat_ws(\' \', firstName, lastName)) "Regie"
                from genre g 
	          right outer join movie m using (genre_id)
	          right outer join movie_director md using (movie_id)
	          left outer join person p using (person_id)
              group by originalTitle';
    $select = $con->prepare($query);
    $select->execute();

    echo '<table border ="1">';
    while($row = $select->fetch(PDO::FETCH_NUM))
    {
        echo '<tr>';
        echo '<td>'.$row[0].'</td><td>'.$row[1].'</td>';
        echo '<tr>';
        //echo $row[0].' '.$row[1].' '.$row[2];
        echo '<br>';
    }
    echo '</table>';
}
catch(Exception $e)
{
    $e->getMessage();
}




?>
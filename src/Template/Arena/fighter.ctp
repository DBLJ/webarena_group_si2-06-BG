<?php $this->assign('title', 'titredepage');?>


<?php 
echo ("Vos personnages sont les suivants :");
echo '<br>';
for($i=0;$i<$nb_perso;$i++){
        echo ($perso[$i]['name']);
        echo(" au niveau");
        echo($perso [$i]['level']);
        echo '<br>';
}
?>


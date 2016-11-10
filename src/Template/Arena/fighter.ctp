<?php $this->assign('title', 'titredepage');?>


<?php 
echo ("Votre personnage :");
echo '<br>';
for($i=0;$i<$nb_perso;$i++){
        echo ($perso[$i]['name']);
        echo(" au niveau");
        echo($perso [$i]['level']);
        echo '<br>';
        
    
}
echo($nomguild[0]['name']);


?>


<?php

//datos enviados por metodo POST
$id=$_POST['idInput'];
$nombre=$_POST['nombreInput'];
$desc=$_POST['descInput'];
//Nuevo formato de la lista
$list = array("$id;$nombre;$desc",);
//apertura del archivo
$file = fopen('archivoP.csv','a');  
//lectura y adicion de la nueva liena de infromacion
foreach ($list as $line){
  fputcsv($file,explode(',',$line));
}
//cierre del archivo
fclose($file);

?>
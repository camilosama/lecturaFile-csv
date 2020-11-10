<?php
//datros enviados ppor ajax
$oldId=$_POST['oldId'];
$id=$_POST['idInput'];
$nombre=$_POST['nombreInput'];
$desc=$_POST['descInput'];
$newLine= "$id;$nombre;$desc\n";
// archivoP.csv
//lectura y apertura de archivo temporal
$reading = fopen('archivoP.csv', 'r');
$writing = fopen('myfile.tmp', 'w');

$replaced = false;
//Lectura de linea porlinea y verificacion para editar solo la linea exacta por el id
while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line[0],$oldId)) {
    $line = $newLine;
    $replaced = true;
  }
  fputs($writing, $line);
}
//cierre de lectura y escritura
fclose($reading); fclose($writing);
// mremplazo y eliminacio nde archivo temporal
if ($replaced) {
  rename('myfile.tmp', 'archivoP.csv');
} else {
  unlink('myfile.tmp');
}




?>
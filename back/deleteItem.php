<?php
//datos enviados por metodo POST
    $id = $_POST['item'];
    $file ="archivoP.csv";
    $lineas = file("archivoP.csv") ;
//recorrido linea por linea para comparar y sacar de la lista
    foreach ($lineas as $nLinea => $dato){

        if ($dato[0] != $id )
            $info[] = $dato ;
    }
    //actualizacion del archivo sin la lista deceada
    $documento = implode($info, ''); 
    file_put_contents('archivoP.csv', $documento);
?>
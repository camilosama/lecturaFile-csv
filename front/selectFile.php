<div class="container mt-3 bg-light">
    <br>
    <div class="alert alert-info" role="alert">
        <b>Resultado del documento</b>
        <span class="float-right btn btn-primary" onclick="modalAddItem()" >Nuevo Item <i class="fas fa-plus"></i></span>
        <div><button class="btn btn-primary" onclick="exportTableToCSV('members.csv')">Exportar Tabla HTML a CSV</button></div>
        
    </div>
    <br>
    <table id="myTable" class="table table-sm text-center tablesorter">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Desc</th>
                <th>Editar</th>
                <th>Eliminar</th>
            <tr>
        </thead>
        <tbody>
<?php
        if (($handle = fopen("../back/archivoP.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
?>
                <tr>
                    <td><?php echo $data[0] ?></td>
                    <td><?php echo $data[1] ?></td>
                    <td><?php echo $data[2] ?></td>
                    <td><button type="button" class="btn btn-info" onclick="modItem('<?php echo $data[0] ?>','<?php echo $data[1] ?>','<?php echo $data[2] ?>')" ><i class="fas fa-edit"></i></button></td>
                    <td><button type="button" class="btn btn-danger" onclick="deleteItem(<?php echo $data[0] ?>)">  <i class="fas fa-trash-alt"></i></button> </td>
                </tr>
 <?php
            }
            fclose($handle);
        }
?>
        </tbody>
    </table>
</div>

<div id="respuestaModal"></div>

<script>
    $("#myTable").tablesorter({ sortList: [[0,0], [1,0]] });
</script>
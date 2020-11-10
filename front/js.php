<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>


<script>


    //Llamdo de la duncionalidad inicial y lectura del archivo 
    function pendeintes(){
        $.ajax({
            url:'front/selectFile.php',
            type:"POST",
            success:function(respuesta){
                $("#respDiv").html(respuesta);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);
            }
        })
    }

    //eliminar item del archivo
    function deleteItem(item){
        $.ajax({
            url:'back/deleteItem.php',
            type:"POST",
            data: {item:item},
            success:function(){
                location.reload(); 
            },
        })
    }

    //Apertura del modal para editar item
    function modItem(id,nombre,desc){
        $.ajax({
            url:'front/modalModItem.php',
            type:"POST",
            data: {id:id,nombre:nombre,desc:desc},
            success:function(respuesta){
                $("#respuestaModal").html(respuesta);
            },
        })
    }
    
    //Apertura del modal para adicionar item
    function modalAddItem(){
        $.ajax({
            url:'front/modalAddItem.php',
            type:"POST",
            success:function(respuesta){
                $("#respuestaModal").html(respuesta);
            },
        })
    }
    //validador de campos y restriccion de los mismos para dicionar o editar items
    function validarFrm( valor){
        const idInput = $('#idInput').val();
        const nombreInput = $('#nombreInput').val();
        const descInput = $('#descInput').val();
        if(idInput.length === 0  || isNaN(idInput)){
            new Noty({
                text: '<b>El campo Id es requerido y debe de ser numerico</b>',
                type: 'error',
                layout: 'topRight',
                theme: 'bootstrap-v4',
                killer:true,
                progressBar:true,
                timeout:4000
            }).show();
            return;
        } 
        if(nombreInput.length === 0  || descInput.length >= 50  || !isNaN(nombreInput)){
            new Noty({
                text: '<b>El campo Nombre es requerido y debe de ser tipo String menos de 50 caracteres</b>',
                type: 'error',
                layout: 'topRight',
                theme: 'bootstrap-v4',
                killer:true,
                progressBar:true,
                timeout:4000
            }).show();
            return;
        } 
        if(descInput.length === 0  ||  !isNaN(descInput)){
            new Noty({
                text: '<b>El campo Descripcion es requerido y debe de ser tipo String</b>',
                type: 'error',
                layout: 'topRight',
                theme: 'bootstrap-v4',
                killer:true,
                progressBar:true,
                timeout:4000
            }).show();
            return;
        } 
        if(valor ===0 ){
            registrarNuevoItem();
        }else{
            modificarItem();
        }
        
    }
    //registro back del nuevo item
    function registrarNuevoItem(){
        const idInput = $('#idInput').val();
        const nombreInput = $('#nombreInput').val();
        const descInput = $('#descInput').val();
        $.ajax({
            url:'back/adicionarItem.php',
            type:"POST",
            data: {idInput:idInput,nombreInput:nombreInput,descInput:descInput},
            success:function(){
                location.reload(); 
            },
        })
    }
    //registro nback para la edicion del item
    function modificarItem(){
        const idInput = $('#idInput').val();
        const nombreInput = $('#nombreInput').val();
        const descInput = $('#descInput').val();
        const oldId = $('#oldId').val();
        $.ajax({
            url:'back/modificarItem.php',
            type:"POST",
            data: {idInput:idInput,nombreInput:nombreInput,descInput:descInput,oldId:oldId},
            success:function(){
                location.reload(); 
            },
        })
    }

    //Funciona para la exportacion del archivo con los filtros aplciados
    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;
        // CSV file
        csvFile = new Blob([csv], {type: "text/csv"});
        // Download link
        downloadLink = document.createElement("a");
        // File name
        downloadLink.download = filename;
        // Create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);
        // Hide download link
        downloadLink.style.display = "none";
        // Add the link to DOM
        document.body.appendChild(downloadLink);
        // Click download link
        downloadLink.click();
    }

    //Funciona para la exportacion del archivo con los filtros aplciados
    function exportTableToCSV(filename) {
        var csv = [];
        var rows = document.querySelectorAll("table tr");
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");
            for (var j = 0; j < cols.length; j++) 
                row.push(cols[j].innerText);
            csv.push(row.join(";"));        
        }
        // Download CSV file
        downloadCSV(csv.join(";"), filename);
    }

 
</script>
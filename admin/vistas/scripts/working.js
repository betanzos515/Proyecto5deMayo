var tabla;


function init(){
	listar(); 
	listarnivel(); 


	$("#nivel").change(listar);
	$("#grado").change(listar);
	$("#seccion").change(listar);
	$("#fecha_inicio").change(listar);
	$("#fecha_fin").change(listar);
	$("#diferencia").change(listar);

	$("#nivel").change(listarnivel);
	$("#fecha_inicio").change(listarnivel);
	$("#fecha_fin").change(listarnivel);
	$("#diferencia").change(listarnivel);
}


function listar()
{
	var nivel = $("#nivel").val();

	var grado = $("#grado").val();
	var seccion = $("#seccion").val();
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();
	var diferencia = $("#diferencia").val();



	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true, 
	    "aServerSide": true,
	    dom: 'Bfrtip',
	    buttons: [
            {extend:'excel',text:'<i class="fa fa-file-excel-o"></i>'},
          ],
		"ajax":
				{
					url: '../ajax/rptworking.php?op=level',
					data:{nivel: nivel,grado: grado,seccion: seccion,fecha_inicio: fecha_inicio,fecha_fin: fecha_fin, diferencia:diferencia},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


function listarnivel()
{
	var nivel = $("#nivel").val();
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();
	var diferencia = $("#diferencia").val();

	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,
	    "aServerSide": true,
	    dom: 'Bfrtip',
	    buttons: [

            {extend:'excel',text:'<i class="fa fa-file-excel-o"></i>'},

          ],
		"ajax":
				{
					url: '../ajax/rptworking.php?op=nivel',
					data:{nivel: nivel,fecha_inicio: fecha_inicio,fecha_fin: fecha_fin, diferencia:diferencia},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "asc" ]]
	}).DataTable();
}



function rpt()
{
      	var nivel = $("#nivel").val();
      	var grado = $("#grado").val();
      	var seccion = $("#seccion").val();
      	var fecha_inicio = $("#fecha_inicio").val();
		var fecha_fin = $("#fecha_fin").val();
		var diferencia = $("#diferencia").val();

      if (nivel!="" ){
      		VentanaCentrada('../reportes/rpt_ngs.php?nivel='+nivel+'&grado='+grado+'&seccion='+seccion+'&fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin+'&diferencia='+diferencia,'','1024','768','true'); 	
      }else {
      		swal("Error!","Selecione Nivel","error");
      	}
}
init();
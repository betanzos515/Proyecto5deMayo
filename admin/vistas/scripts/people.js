var tabla;

function init(){
	mostrarform(false);
	listar()

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	});

	$('#checkall').change(function() {
    $('.checkitem').prop("checked",$(this).prop("checked"))
    });
}


function rpt()
{
      var nivel = $("#rnivel").val();
      var grado = $("#rgrado").val();
      var sgrado = $("#sgrado").val();
      var seccion = $("#rseccion").val();
      var dni = $("#rdni").val();

      if (nivel=="DNI"){
      	if (dni=="") {
			swal("Error!","Escriba un DNI porfavor","error");
      	}else{
      		VentanaCentrada('../reportes/rpt_qr.php?dni='+dni,'','1024','768','true');
      		limpiar()
      	}

      }else {

      	if (nivel=="Matutino") {
      		if(nivel=="Matutino" && grado=="Todo" && seccion =="Todo"){
      			swal("Error!","Selecione un Grado y un Grupo","error");
      		} else if(nivel=="Matutino" && grado!="Todo" && seccion =="Todo"){
      		swal("Error!","Selecione un Grupo","error");

				} else if(nivel=="Matutino" && grado=="Todo" && seccion !="Todo"){
      		swal("Error!","Selecione  Grado","error");
      		}else{
      		VentanaCentrada('../reportes/rpt_global.php?&nivel='+nivel+'&grado='+grado+'&seccion='+seccion,'','1024','768','true');
      		limpiar();
      		}
      	} else {

      		if (nivel=="Vespertino") {
	      		if(nivel=="Vespertino" && sgrado=="Todo" && seccion =="Todo"){
	      			swal("Error!","Selecione un Grado y un Grupo","error");
	      		} else if(nivel=="Vespertino" && sgrado!="Todo" && seccion =="Todo"){
	      		swal("Error!","Selecione un Grupo","error");

					} else if(nivel=="Vespertino" && sgrado=="Todo" && seccion !="Todo"){
	      		swal("Error!","Selecione  Grado","error");
	      		}else{
	      		VentanaCentrada('../reportes/rpt_global.php?&nivel='+nivel+'&grado='+sgrado+'&seccion='+seccion,'','1024','768','true');
	      		limpiar();
	      		}

      	}


      }




}
}

function limpiar()
{
	$("#rdni").val("");
	$("#apellidos").val("");
	$("#nombre").val("");
	$("#dni").val("");
	$("#grado").val("Seleccione..");
	$("#grado").selectpicker('refresh');
	$("#seccion").val("");
	$("#Seccion").selectpicker('refresh');
	$("#sexo").val("");
	$("#nivel").val("Seleccione..");
	$("#nivel").selectpicker('refresh');
	$("#idpeople").val("");


	$("#dnimg").val("");
	$("#rgrado").val("Todo");
	$("#rgrado").selectpicker('refresh');
	$("#rseccion").val("Todo");
	$("#rseccion").selectpicker('refresh');


	$("#sgrado").val("Todo");
	$("#sgrado").selectpicker('refresh');
	$("#rnivel").val("Primaria");
	$("#rnivel").selectpicker('refresh');
	$("#div3").css("display", "none");
    $("#divs").css("display", "none");
    $("#div1").css("display", "block");
    $("#div2").css("display", "block");


}

function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}


function cancelarform()
{
	limpiar();
	mostrarform(false);
}


function listar()
{
	tabla=$('#tbllistado').dataTable(
	{

		"aProcessing": true,
	    "aServerSide": true,
	    dom: 'Bfrtip',
	    buttons: [

	    			{extend:'colvis',text:'<i class="glyphicon glyphicon-eye-open"></i>'},
	    			{extend:'excel',text:'<i class="fa fa-file-excel-o"></i>'}
	    		],
		"ajax":
				{
					url: '../ajax/persona.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,
	    "order": [[ 0, "asc" ]],
			    scrollY: '40vh',
		   		scrollCollapse: true,
		   		paging:false
	}).DataTable();


}


function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/persona.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
	          swal("Exito!",datos,"success");
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idpeople)
{
	$.post("../ajax/persona.php?op=mostrar&idpeople="+idpeople, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#apellidos").val(data.apellidos);
		$("#nombre").val(data.nombre);
		$("#dni").val(data.dni);
		$("#dnimg").val(data.dni);
		$("#grado").val(data.grado);
		$("#grado").selectpicker('refresh');
 		$("#seccion").val(data.seccion);
 		$("#seccion").selectpicker('refresh');
 		$("#sexo").val(data.sexo);
 		$("#sexo").selectpicker('refresh');
 		$("#nivel").val(data.nivel);
 		$("#nivel").selectpicker('refresh');
 		$("#idpeople").val(data.idpeople);



 	})
}


function desactivar(idpeople)
{
	swal({
		title: 'Advertencia?',
		text: "Está Seguro de desactivar este registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/persona.php?op=desactivar", {idpeople : idpeople}, function(e){
				swal("Exito!",e,"success");
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}



function activar(idpeople)
{
	swal({
		title: 'Advertencia?',
		text: "Está Seguro de activar este registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/persona.php?op=activar", {idpeople : idpeople}, function(e){
				swal("Exito!",e,"success");
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}



function eliminar(idpeople,qr)
{
	swal({
		title: 'Advertencia?',
		text: "Está Seguro de eliminar este registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/persona.php?op=eliminar&id="+idpeople+'&qr='+qr, function(e){
				swal("Exito!",e,"success");
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}


function eliminarsel()
{

          	var qr = $('.checkitem:checked').map(function(){return $(this).val() }).get().join(' ');

					swal({
							title: 'Advertencia?',
							text: "Está Seguro de eliminar los registro?",
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							cancelButtonText: 'No',
							confirmButtonText: 'Si'
						}).then((result) => {
							if (result.value) {
								$.post("../ajax/persona.php?op=eliminarsel&qr="+qr, function(e){
									/*selimg();*/
									swal("Exito!",e,"success");
									tabla.ajax.reload();
									$("#checkall").prop('checked',false);
								});
							}
							tabla.ajax.reload();
							$("#checkall").prop('checked',false);
						})
}



 function validarExt(file)
{

  var archivoInput = document.getElementById('csv');
  var archivoRuta = archivoInput.value;
  var extPermitidas = /(.csv|.CSV)$/i;

  if(!extPermitidas.exec(archivoRuta)){
    swal('Error!','Formato incorrecto','error') ;
    archivoInput.value = '';
    return false;

  }
}


init();

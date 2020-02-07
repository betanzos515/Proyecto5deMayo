var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	$('#checkall').change(function() {
    $('.checkitem').prop("checked",$(this).prop("checked"))
    });

}


//Función mostrar formulario
function mostrarform(flag)
{
	//limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);

	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
	}
}


function cancelarform()
{
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

	    		],
		"ajax":
				{
					url: '../ajax/config_ass.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,
	    "order": [[ 0, "asc" ]],
	    	scrollY: 			'40vh',
   			scrollCollapse: 	true,
   			paging: 			false
	}).DataTable();
}

function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/config_ass.php?op=guardaryeditar",
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
}

function mostrar(idassistance)
{
	$.post("../ajax/config_ass.php?op=mostrar",{idassistance : idassistance}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idassistance").val(data.idassistance);
		$("#idpeople").val(data.idpeople);
		$("#nombre").val(data.nombre);
		$("#apellidos").val(data.apellidos);
		$("#h_entrada").val(data.h_entrada);
		$("#h_salida").val(data.h_salida);
		$("#fecha").val(data.fecha);
 	})
}

function eliminar(idassistance)
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
			$.post("../ajax/config_ass.php?op=eliminar", {idassistance : idassistance}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}

function eliminarsel()
{
          var id = $('.checkitem:checked').map(function(){
          	return $(this).val()
          }).get().join(' ')
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
								 $.post("../ajax/config_ass.php?op=eliminarsel",{id : id}, function(e){						        		
									swal("Exito!",e,"success");	
									tabla.ajax.reload();
									$("#checkall").prop('checked',false);
								});
							}
							tabla.ajax.reload();
							$("#checkall").prop('checked',false);
						})
}
init();
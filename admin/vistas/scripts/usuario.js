var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$("#imagenmuestra").hide();
	//Mostramos los permisos
	$.post("../ajax/usuario.php?op=permisos&id=",function(r){
	        $("#permisos").html(r);
	});
}

//Función limpiar
function limpiar()
{
	$("#nombre").val("");
	$("#login").val("");
	$("#clave").val("");
	$("#iduser").val("");
}

//Función mostrar formulario
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

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          

		        ],
		"ajax":
				{
					url: '../ajax/usuario.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
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

function mostrar(iduser)
{
	$.post("../ajax/usuario.php?op=mostrar",{iduser : iduser}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#login").val(data.login);
		$("#clave").val(data.clave);
		$("#iduser").val(data.iduser);

 	});
}

//Función para desactivar registros
function desactivar(iduser)
{
	swal({
			  title: 'Advertencia?',
			  text: "Está Seguro de desactivar el usuario?",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Si'
			}).then((result) => {
			  if (result.value) {
			  	$.post("../ajax/usuario.php?op=desactivar", {iduser : iduser}, function(e){								        		
			  					swal("Exito!",e,"success");	
			  					tabla.ajax.reload();
				});

			  }

	})
}

//Función para activar registros
function activar(iduser)
{
	swal({
			  title: 'Advertencia?',
			  text: "Está Seguro de activar el Usuario?",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Si'
			}).then((result) => {
			  if (result.value) {
			  	$.post("../ajax/usuario.php?op=activar", {iduser : iduser}, function(e){						        		
			  					swal("Exito!",e,"success");	
			  					tabla.ajax.reload();
				});

			  }

	})
}

init();
var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

}


function limpiar()
{
	$("#nombre").val("");
	$("#logo").val("");
	$("#year").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#identidad").val("");
	$("#imgdv").attr("src","");
}

function clearimg()
{

	$("#logo").val("");
	$("#imgdv").attr("src","");
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

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
/*		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'*/
		        ],
		"ajax":
				{
					url: '../ajax/entidad.php?op=listar',
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
		url: "../ajax/entidad.php?op=guardaryeditar",
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

function mostrar(identidad)
{
	$.post("../ajax/entidad.php?op=mostrar",{identidad : identidad}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#year").val(data.year);
		$("#nombre").val(data.nombre);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/ie/"+data.logo);
		$("#imagenactual").val(data.logo);
 		$("#identidad").val(data.identidad);

 	})
}


function validarExt(file)
{

	var filesize=file.files[0].size/1024/1024;
	var archivoInput = document.getElementById('logo');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.jpg|.png|.jpeg|.gif)$/i;

	if(!extPermitidas.exec(archivoRuta)){
		swal('Error!','Formato incorrecto','error') ; 
		archivoInput.value = '';
		$("#imgdv").attr("src","");
		return false;
	} else if (filesize>2) {
		swal('Error!','El archivo excede los 2 MB','error') ; 
		archivoInput.value = '';
		$("#imgdv").attr("src","");
		return false;
	}else{
        if (archivoInput.files && archivoInput.files[0]) 
        {
        	var visor = new FileReader();
        	visor.onload = function(e) 
        	{
        		document.getElementById('visorArchivo').innerHTML = 
        		'<embed src="'+e.target.result+'" width="150" height="120" id="imgdv" />';
        	};
        	visor.readAsDataURL(archivoInput.files[0]);
        	/*$("#imagenmuestra").hide();*/
        }
    }
}

init();
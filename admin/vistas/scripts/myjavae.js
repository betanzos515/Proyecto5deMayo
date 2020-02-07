var tabla;

$(function(){
	$('#subida').submit(function(){		
		var comprobar = $('#csv').val().length; /*comprobar si hay archivo*/

		if(comprobar>0){
			$('#resultados').css('display','block');
			var formulario = $('#subida');
			var archivos = new FormData();	
			var url = '../ajax/importarCSVe.php';
				for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 
               	 archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));
      		 	}
				
			$.ajax({	
				url: url,
				type: 'POST',		
				contentType: false, 				
            	data: archivos,				
               	processData:false,				
				beforeSend : function (){					
					$('#resultados').html('<center><img src="../files/images/ajax-loader.gif" width="30" heigh="30"></center>');					
				},
				success: function(data){					
					if(data ='OK'){
						swal("Exito!","importacion Satisfactoriamente","success");
						$("#subida")[0].reset();
						tabla.ajax.reload();
						cerrar();
						return false;	
					}else{
						swal("Advertencia!","Problema al cargar el archivo","warning"); 
						tabla.ajax.reload();
						$("#subida")[0].reset();
						return false;
					}								 
				}				
			});			
			return false;			
		}else{		
			swal("Advertencia!","Selecciona un archivo .CSV para importar","error");
					
			return false;			
		}
	});
});


function cerrar()
{
$("#modal-default").modal('hide');
$('#resultados').css('display','none');
}

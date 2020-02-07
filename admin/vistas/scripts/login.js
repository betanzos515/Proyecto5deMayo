$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    logina=$(".email").val();
    clavea=$(".password").val();

    $.post("../ajax/usuario.php?op=verificar",
        {"logina":logina,"clavea":clavea},
        function(data)
    {
        if (data!="null")
        {
            $(location).attr("href","escritorio.php");            
        }
        else
        {
            swal("Error!","Usuario y/o Password incorrectos","error"); 
            $(".email").val("");
            $(".password").val("");
        }
    });
})
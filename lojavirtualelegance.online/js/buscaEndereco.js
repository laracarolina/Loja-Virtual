function buscaEnderecoResidencial(cep)
{
    if (cep.length != 9)
        return;

    $.ajax({

        url: 'buscarEndereco.php',
        type: 'POST',
        async: true,
        dataType: 'json',
        data: {'cep': cep},

        success: function (result)
        {

              if (result != "") {
                document.forms[0]["log"].value = result.rua;
                document.forms[0]["bairro"].value = result.bairro;
                document.forms[0]["cidade"].value = result.cidade;
                var campoSelect = document.getElementById("estadoSelect");
            	for (var i=0; i<campoSelect.options.length; i++){	
		        if (campoSelect.options[i].value == result.estado){
			    campoSelect.options[i].selected = true;
			    break;
		        }
	           }
            }
        },

        error: function (xhr, textStatus, error)
        {
            // xhr é o objecto XMLHttpRequest
            alert(textStatus + error + xhr.responseText);
        }

    });

}

function buscaEnderecoDeEntrega(cep)
{
    if (cep.length != 9)
        return;

    $.ajax({

        url: 'buscarEndereco.php',
        type: 'POST',
        async: true,
        dataType: 'json',
        data: {'cep': cep},

        success: function (result)
        {

              if (result != "") {
                document.forms[0]["log2"].value = result.rua;
                document.forms[0]["bairro2"].value = result.bairro;
                document.forms[0]["cidade2"].value = result.cidade;
                var campoSelect = document.getElementById("estado2Select");
            	for (var i=0; i<campoSelect.options.length; i++){	
		        if (campoSelect.options[i].value == result.estado){
			    campoSelect.options[i].selected = true;
			    break;
		        }
	           }
            }
        },

        error: function (xhr, textStatus, error)
        {
            // xhr é o objecto XMLHttpRequest
            alert(textStatus + error + xhr.responseText);
        }

    });

}

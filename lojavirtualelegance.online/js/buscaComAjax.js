function mostraResultados()
{
	var str = document.getElementById("txtBusca").value;
	if (str.length == 0)
	{
		alert("Erro!");
	}
	else
	{
		buscaResultados(str);
	}
}

function buscaResultados(palavraChave){
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onload = function (e){
			if (xmlhttp.status == 200)
			{
				var corpoDaPagina = document.getElementById("corpoDaPagina");
				var resultados = "";
				var caminho = "imagens/";

				var response1 = xmlhttp.responseText;
				var response  = JSON.parse(response1);
				if(response[0] == "Sem resultados para a busca"){
					corpoDaPagina.innerHTML = response;
				}

				else
				{
					for(var i=0;i<response.length;i++){
						
						resultados += "<div class='row'>";
						resultados += "<div class='col-md-3 centerContent'>";
						resultados += "<a href=visualizaDetalhes.php?idProduto="+response.id+"><img float='left' src='" + caminho + response[i].foto + "'width='250' height='250'></a></div>";
						resultados += "<div class='col-md-7'>";
						resultados += "<a href=visualizaDetalhes.php?idProduto="+response.id+"><label>" + response[i].nome + "</label></a>";
						resultados += "<br><label>" + response[i].descricao + "</label>";
						resultados += "<br><label class='text-info'>R$" + response[i].preco + "</label>";
						resultados += "<br><br><a href<a href=visualizaDetalhes.php?idProduto="+JSON.stringify(response[i].id)+"><button class='btn btn-sm estilo'> VER PRODUTO</button></a><br></div>";
						resultados += "<div class='col-md-2'></div></div>";
						
					}
					corpoDaPagina.innerHTML = resultados;
				}
			}
		}

	var url = "buscarResultados.php?palavraChave=" + palavraChave;
		xmlhttp.open("GET", url, true);
			xmlhttp.send();
}



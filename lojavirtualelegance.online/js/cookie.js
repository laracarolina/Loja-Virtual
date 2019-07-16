
function setCookie(){
  var id = document.getElementById("idProduto").value;
  var nomeCookie = "produto" + id;
  //var d = new Date();
  //var diasParaExpirar = 1;
  //d.setTime(d.getTime() + (diasParaExpirar * 24 * 60 * 60 * 1000));
  //var expiraEm = "expiraEm="+d.toUTCString();
  document.cookie = nomeCookie + "=" + id + ";";// + expiraEm + ";path=/";
  alert("O produto foi adicionado ao seu carrinho de compras!");
 
}


// retorna o valor do cookie "nome"
function getCookie(nome) {
  var name = nome + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


//pega produtos adicionados ao carrinho e mostra na modal do carrinho
function getProdutosAdicionados(){
  var string = document.cookie;
  var corpoDaModal = document.getElementById("modalCarrinho");
  if(string != ""){
     //alert(string);
     var xmlhttp = new XMLHttpRequest();
		 xmlhttp.onload = function (e){
			 if (xmlhttp.status == 200)
			 {
       // var corpoDaModal = document.getElementById("modalCarrinho");
        var caminho = "imagens/";
        var response = JSON.parse(xmlhttp.responseText);
        var resultados = "";
        for(var i=0;i<response.length;i++){
          resultados += "<div class='row'>";
          resultados += "<div class='col-md-5'>";
          resultados += "<img src='" + caminho + response[i].foto + "' class='imageStyle' width='150' height='150'></div>"
          resultados += "<div class='col-md-7'>";
          resultados += "<label>" + response[i].nome + "</label>";
          resultados += "<br><label class='text-info'>R$" + response[i].preco + "</label></div></div>";
        }
        corpoDaModal.innerHTML = resultados;

       }
       else{
        corpoDaModal.innerHTML = "Nenhum produto adicionado";
       }
 }
       var url = "buscarProdutosAdicionados.php?string=" + string;
       xmlhttp.open("GET", url, true);
       xmlhttp.send();
}

  
}


//pega os profutos adicionados ao carrinho e mostra na tela de conclusao de pedido
function getProdutosAdicionados2(){
  var string = document.cookie;
  var produtosDoCarrinho = document.getElementById("produtosDoCarrinho");
  if(string != ""){
     //alert(string);
     var xmlhttp = new XMLHttpRequest();
		 xmlhttp.onload = function (e){
			 if (xmlhttp.status == 200)
			 {
        var caminho = "imagens/";
        var response = JSON.parse(xmlhttp.responseText);
        var resultados = "";
        var precoTotal = 0;
        if(response != ""){
        for(var i=0;i<response.length;i++){
          resultados += "<div class='row'>";
          resultados += "<div class='col-lg-3'>";
          resultados += "<img src='" + caminho + response[i].foto + "' width='210' height='210'></div>"
          resultados += "<div class='col-lg-9'>";
          resultados += " <br><h3 class='card-title'>" + response[i].nome + "</h3>";
          resultados += "<h4 class='card-title'>R$" + response[i].preco + "</h4>";
          resultados += "<p class='card-text'>" + response[i].descricao + "</p></div></div>";
          precoTotal = precoTotal + parseFloat(response[i].preco);
        }
          resultados += "<br><div class='row'>";
          resultados += "<div class='col-lg-9'></div>";
          resultados += "<div class='col-lg-3' style='background-color: rgb(27, 17, 71); color: white;'><h3> Total = R$" + precoTotal + "</h3></div></div>";
          produtosDoCarrinho.innerHTML = resultados;

       }
       else{
        corpoDaModal.innerHTML = "Nenhum produto adicionado";
       }
 }
}
       var url = "buscarProdutosAdicionados.php?string=" + string;
       xmlhttp.open("GET", url, true);
       xmlhttp.send();
}

  
}



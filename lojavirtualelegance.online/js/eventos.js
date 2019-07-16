
   function excluirCliente(){
    if (confirm("Deseja excluir o cliente?")){
        var cpf = document.getElementById("cpf").value;
        alert(cpf)
        $.ajax({

            url: 'excluirCliente.php',
            type: 'POST',
            async: true,
            dataType: 'json',
            data: {'cpf': cpf},
    
            success: function (result)
            {
    
                  if (result != "") {
                    alert("Cliente excluido com sucesso");
                }
                else alert("Erro ao excluir cliente")
            },
    
            error: function (xhr, textStatus, error)
            {
                // xhr é o objecto XMLHttpRequest
                alert(textStatus + error + xhr.responseText);
            }
    
        });
    }
}

function enviarPedido(){
  var string = document.cookie;
    var cpfCliente = document.getElementById("cpfDoCliente").value;
    var radio = document.getElementsByName("pagamento");
    var formaPagamento;
   
    for(var i = 0; i < radio.length; i++){
        if(radio[i].checked){
         formaPagamento = radio[i].value;
   }
}
    if(string != ""){
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onload = function (e){
       if (xmlhttp.status == 200){
        alert("Pedido realizado com sucesso!");
        document.cookie = "";
          var response = JSON.parse(xmlhttp.responseText);
       
         }
   }
         var url = "salvarPedido.php?string=" + string + "&cpfCliente=" + cpfCliente + "&formaPagamento=" + formaPagamento;
         xmlhttp.open("GET", url, true);
         xmlhttp.send();
  }
  
    
  }

  
 





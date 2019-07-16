<header>
		
    <div class="row">

        <div class="col-lg-3">
            <img style="margin-left: auto; margin-right:auto; display: block; width: auto"  id="logo" src="images/logo.png" onclick="window.location.href='homeCliente.php'">
        </div>

        <div class="col-lg-6">
            <input type="text" id="txtBusca" class="espacamento1" placeholder="O que você está procurando?">
                    
            <img id="lupa" src="images/lupa.png" onclick="mostraResultados()">
        </div>

        <div class="col-lg-1 nopadding">
            <div class="espacamento1"><a class="navLink" href="dadospessoais.php"> Minha Conta </a> </div>
        </div>
				
        <div class="col-lg-1 nopadding">
            <div class="espacamento1"><a class="navLink" href="home.php"> Sair </a> </div>
        </div>
				
        <div class="col-lg-1 nopadding">
            <div><img id="icon" data-toggle="modal" data-target="#myModal" src="images/icon.png" onclick="getProdutosAdicionados()"></div>
        </div>

    </div>
			
</header>
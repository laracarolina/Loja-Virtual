<header>

    <div class="row">

        <div class="col-lg-3">
            <img style="margin-left: auto; margin-right:auto; display: block; width: auto"  id="logo" src="images/logo.png" onclick="window.location.href='home.php'">
        </div>
			
        <div class="col-lg-6">
            <!-- <input type="text" id="txtBusca" class="espacamento1" placeholder="O que você está procurando?" onkeyup="mostraResultados(this.value)">-->
                <input type="text" id="txtBusca" class="espacamento1" placeholder="O que você está procurando?">
                <img id="lupa" src="images/lupa.png" onclick="mostraResultados()">
            <!-- <button id="botaoBusca" class="btn btn-sm estilo"><a onmouseenter="changeStyle(this)" href="resultadoss.html"> Buscar </a></button>-->
        </div>


        <div class="col-lg-1 nopaddind">
            <div class="espacamento1"><a class="navLink" href="cadastro.php"> Cadastro </a></div>
        </div>
			
        <div class="col-lg-1 nopadding">
            <div class="espacamento1"><a class="navLink" href="login.php"> Login </a></div>
        </div>
			
        <div class="col-lg-1 nopadding">
            <div><img id="icon" data-toggle="modal" data-target="#myModal" src="images/icon.png" onclick="getProdutosAdicionados()"></div>
        </div>

    </div>

</header>


<?php
if(isset($_POST['id_pedido'])){

if(!isset($_SESSION))
{
  session_start();
}
header("Content-Type: text/html; charset=utf-8", true);
require 'classes/Login.php';

$login = new Login();

// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Delivery</title>
<link rel="icon" type="image/png" href="../../web/images/plate.png" />

<link href="../../web/css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom Theme files -->
<link href="../../web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--Animation-->
<script src="../../web/js/wow.min.js"></script>
<link href="../../web/css/animate.css" rel='stylesheet' type='text/css' />
<script>
	new WOW().init();
</script>

<link rel="stylesheet" href="../../web/font-awesome-4.3.0/css/font-awesome.min.css">
<link href="../../web/css/pace.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">

<?php
$current_url = base64_encode($url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$_SESSION['return_url'] = $current_url;

require '../functions/account.php';
require '../functions/pedidos.php';
$data = buscaDatasPedido($_POST['id_pedido']);

$detalhes = detalhes_pedido($_POST['id_pedido']);

$itens = lista_itens_pedido($_POST['id_pedido']);

include 'includes/account_verif.php';
 ?>
 <div class="menu-bar">
			<div class="container">
				<div class="top-menu">
					<ul>
						<li class="active"><a href="../../">Inicio</a></li>|
						<li><a href="../../termos-de-uso">Termos de Uso</a></li>|
						<li><a href="../pedidos">Pedidos</a></li>|
						<li><a href="../../contato/">Contato</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>

<?php
if ($login->usuarioLogado() == true) {
?>
				<div class="login-section">
					<ul>
						<li><a href="#">Bem-vindo, <?=$_SESSION['login']?></a></li>
						<li><a href="../../minhaconta/">Minha Conta</a></li> |
						<?php

						if(isset($_SESSION['products'])){
						$total = 0;

					    foreach ($_SESSION["products"] as $cart_itm)
					    {
					        $valorTotalProduto = ($cart_itm['valor']+$cart_itm['valor_adicional']+$cart_itm['valor_borda']);
					        $subtotal = ($valorTotalProduto*$cart_itm["qtd"]);
					        $total = ($total + $subtotal);
					    }
						 ?>
						<li><a href="../../pedido/produtos">
						<i class="fa fa-shopping-cart"></i>
						
						<?php
						if($_SESSION['compra_minima'] > $total){
        					$_SESSION['taxa_servico'] = 0;}

							$total = $total + $_SESSION['taxa_servico'] + $_SESSION['taxa'];

						 echo count($_SESSION['products']).' Item  ';

						 echo '[ R$ '. number_format($total,2,",",".").' ]';

						 } else { ?>

						 <li><a href="#" class="popover-bottom" data-toggle="popover"
						 data-content="Seu carrinho está vazio, por favor insira seu cep para escolher seus produtos.">
						<i class="fa fa-shopping-cart"></i>
						
						<?php
							echo 'Carrinho Vazio';
							} ?>

						</a></li> |
						<li><a href="../../minhaconta/?logout">Sair</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

<?php } else { ?>

				<div class="login-section">
					<ul>
						<li><a href="../../minhaconta/">Login</a>  </li> |
						<li><a href="../../minhaconta/cadastrar">Registre-se</a> </li> |
						
						<?php
						if(isset($_SESSION['products'])){
						$total = 0;
						
					    foreach ($_SESSION["products"] as $cart_itm)
					    {
					        $valorTotalProduto = ($cart_itm['valor']+$cart_itm['valor_adicional']+$cart_itm['valor_borda']);
					        $subtotal = ($valorTotalProduto*$cart_itm["qtd"]);
					        $total = ($total + $subtotal);
					    }
						 ?>
						<li><a href="../pedido/produtos">
						<i class="fa fa-shopping-cart"></i>
						
						<?php
						if($_SESSION['compra_minima'] > $total){
        					$_SESSION['taxa_servico'] = 0;}

							$total = $total + $_SESSION['taxa_servico'] + $_SESSION['taxa'];

						 echo count($_SESSION['products']).' Item  ';

						 echo '[ R$ '. number_format($total,2,",",".").' ]';

						 } else { ?>
						
						 <li><a href="#" class="popover-bottom" data-toggle="popover"
						 data-content="Seu carrinho está vazio, por favor insira seu cep para escolher seus produtos.">
						<i class="fa fa-shopping-cart"></i>
						
						<?php
							echo 'Carrinho Vazio';
							} ?>
						</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
<?php } ?>
<div class="wow fadeInLeft" data-wow-delay="0.4s">
	<div class="container">
		<div class="login-page">
          	   </div>
  		<div class="menu-minha-conta">
				<div class="row">
				<ul>
					<h3>PEDIDOS</h3>
					<li><a href="../../minhaconta/">Ultimo pedido</a></li>
					<li><a href="../pedidos">Ver todos</a></li>

					<h3>ENDEREÇOS</h3>
					<li><a href="../cadastrar-endereco">Cadastrar novo endereço</a></li>
					<li><a href="#">Meus endereços</a></li>

					<h3>MEU CADASTRO</h3>
					<li><a href="../alterarDadosCadastrais">Alterar dados cadastrais</a></li>
				</ul>
				</div>
		</div>

		<div class="minha-conta-content">
			<h2>Pedido: <?=$data['id_pedido']?></h2>
			<p>Acompanhe seu pedido abaixo</p>

			<div class="ultimo-pedido">
				<div class="row">
					<div class="col-md-3">
						<h3>Pedido</h3>
						<p><?=$data_pedido;?></p>
					</div>
					<div class="col-md-3">
						<h3>Pagamento</h3>
						<p><?=$data_pgto;?></p>
					</div>
					<div class="col-md-3">
						<h3>Preparo</h3>
						<p><?=$data_preparo;?></p>
					</div>
					<div class="col-md-3">
						<h3>Entrega</h3>
						<p><?=$data_entrega;?></p>
					</div>
				</div>
				<div class="row">
					<ul>
						<li class="progress <?=$ok1?>"></li>
						<li class="progress <?=$ok2?>"></li>
						<li class="progress <?=$ok3?>"></li>
						<li class="progress <?=$ok4?>"></li>
					</ul>
				</div>
				<div class="row">
					<br>
					<h4><strong>Status:</strong> <?=$data['status']?></h4>
				</div>
			</div>
	<div class="row">
	<br>
	<table class="table table-hover">
	    <thead>
	      <tr>
	        <th>Nome do Produto</th>
	        <th>Qtd</th>
	        <th>Adicional</th>
	        <th>Borda Recheada</th>
	        <th>Valor Unitario</th>
	        <th>Subtotal</th>
	      </tr>
	    </thead>
	    <tbody>
	     <?php
	     $total = 0;
		foreach($itens as $item): ?>
	      <tr>
	        <td><strong><?=$item['produto']."</strong> (".$item['categoria'].")";?></td>
	        <td><?=$item['qtd'];?></td>
	        <td><?=$item['adicional'];?></td>
	        <td><?=$item['borda'];?></td>
	        <td><?=number_format($item['valor'],2,",",".");?></td>
	        <td><?=number_format($item['subtotal'],2,",",".");?></td>
	        <?php $total = $total + $item['subtotal']; ?>
	      </tr>
	    <?php endforeach;
		 ?>
	    </tbody>
	  </table>
	  	<div class="detalhes-pedido-footer">
	  		<p>Total dos itens: R$ <?=number_format($total,2,",",".");?></p>
	  	</div>
	  	<a href="../pedidos" class="btn btn-default btn-lg"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>
	  	<br><br>
		</div>
      </div>
	</div>
  </div>
<div class="clearfix"></div>
		<!--Contatos e Footer Section-->
        <div class="contact-section" id="contact">
            <div class="container">
                <div class="contact-section-grids">
                    <div class="col-md-3 contact-section-grid wow fadeInLeft" data-wow-delay="0.4s">
                        <h4>A Empresa</h4>
                        <ul>
                            <li>
                                <a href="https://www.godfood.com.br/contato">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Contato
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Politica de Privacidade
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="https://www.godfood.com.br/termos-de-uso">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Termos de Uso
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#Order">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Entenda como funciona
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 contact-section-grid wow fadeInLeft" data-wow-delay="0.4s">
                        <h4>Nossos Parceiros</h4>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Empresa 1
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Empresa 2
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Empresa 3
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Empresa 4
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 contact-section-grid wow fadeInRight" data-wow-delay="0.4s">
                        <h4>Siga-me os bons</h4>
                        <ul>
                            <li>
                                <a href="https://facebook.com/godfooddelivery" target="_blank">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-facebook fa-inverse"></i>
                                    </span>Facebook
                                </a>
                            </li>
                        </ul>
                            <ul>
                            <li>
                                <a href="https://instagram.com/god.food" target="_blank">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-instagram fa-inverse"></i>
                                    </span>Instagram
                                </a>
                            </li>
                        </ul>
                            <ul>
                            <li>
                                <a href="https://plus.google.com/u/0/109781837218722392654/" target="_blank">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-google-plus fa-inverse"></i>
                                    </span>Google +
                                </a>
                            </li>
                        </ul>
                            <ul>
                            <li>
                                <a href="https://twitter.com/GodFoodDelivery" target="_blank">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-twitter fa-inverse"></i>
                                    </span>Twitter
                                </a>
                            </li>
                        </ul>
                    </div>
					<div class="col-md-3 contact-section-grid nth-grid wow fadeInRight" data-wow-delay="0.4s">
						<h4>Inscreva-se na nossa Newsletter</h4>
						<p>E receba todas as Novidades no seu E-mail</p>
						<form action="../../subscribe.php" method="POST" accept-charset="utf-8" onsubmit="return sucesso()">
						<input type="text" class="text" value="" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
						<input type="submit" value="Cadastrar">
						</form>
						</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

	<script src="../../web/js/jquery.min.js"></script>
	<script src="../../web/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../web/js/easing.js"></script>
	<script src="../../web/js/pace.min.js"></script>
</body>
</html>
<?php
} else {
    header('Location: ../../');
  }
}
?>
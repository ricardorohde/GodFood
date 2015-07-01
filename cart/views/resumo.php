<?php

if(!isset($_SESSION))
{
    session_start();
}

require 'config.php';
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Resumo do Pedido</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />

<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="../web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Shopping Cart Custon CSS -->
<link href="style/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--Animation-->
<script src="../web/js/wow.min.js"></script>
<link href="../web/css/animate.css" rel='stylesheet' type='text/css' />
<script>
    new WOW().init();
</script>

<link rel="stylesheet" href="../web/font-awesome-4.3.0/css/font-awesome.min.css">

<link rel="stylesheet" href="inspinia/css/ladda.min.css">
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">

<?php
include 'includes/menu-top.php';
include 'mensagens.php';
?>

 <div class="alert alert-danger alert-dismissible" role="alert">
      <h4>Você está em um ambiente de teste, nenhum pedido será registrado oficialmente nem entregue, caso encontre algum problema, bug ou erro, por favor, entre em contato conosco. Agradecemos sua compreensão. <br> <br>
Para pagamentos no PayPal, utilize nossa conta teste:
<br><br> <strong>
Email: teste@godfood.com.br <br>
Senha: 12345678 </strong></h4>
    </div>
<div id="products-wrapper">
 <br>
 <div class="animated fadeInLeft">
 	<div class="view-cart">
  	<h1 align="center">Resumo do Pedido</h1>
  		<br>
 	<?php
	require '../functions/pedidos.php';
	require '../functions/restaurantes.php';

	$restaurante = mostra_infos_restaurante($_SESSION['id_restaurante'],$_SESSION['cep']);

    $current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

	if(isset($_SESSION["products"]))
    {
	    $total = 0;
		echo '<form method="post" action="process.php">';
		echo '<ul>';
		$cart_items = 0;
		foreach ($_SESSION["products"] as $cart_itm) :

        	$product_code = $cart_itm["code"];
			$produtos = select_resumo_pedido($product_code);
			$categoria = mostra_categoria($product_code);
		?>
		    <li class="cart-itm">
            	<div class="product-info">
					<h3><?=$produtos['nome']?> (<?= $categoria['categoria'];  ?>)</h3>
					<span class="remove-itm"><a href="cart_update.php?removep=<?=$cart_itm['code']?>&return_url=<?=$current_url?>" class="btn btn-default btn-sm"><i class="fa fa-trash-o fa-1x"></i></a></span>
            			<h4>Quantidade : <?=$cart_itm["qtd"]?></h4>
               		<?php if(strlen($produtos['descricao']) > 3){ ?>
            			<h4><?=$produtos['descricao']?></h4>
            		<?php } ?>
            			<h4><strong>Adicional : <?=$cart_itm['adicional'];?></strong></h4>
            			<h4><strong>Borda Recheada : <?=$cart_itm['borda'];?></strong></h4>

            <?php if(strlen($cart_itm['obs'])>5){ ?>
        				<h4>Obs: <?=$cart_itm['obs'];?>;</h4>
            <?php } $valorTotalProduto = ($cart_itm['valor']+$cart_itm['valor_adicional']+$cart_itm['valor_borda']); ?>

            		<div class="unitario">Valor Unit: R$ <?=number_format($valorTotalProduto,2,",",".");?></div>
				</div>
        <?php
			$subtotal = ($valorTotalProduto*$cart_itm["qtd"]);
	 
		?>

			<div class="p-price">R$ <?=number_format($subtotal,2,",",".")?></div><br>
			</li>

		<?php
			$total = ($total + $subtotal);

			echo '<input type="hidden" name="item['.$cart_items.']['.'name'.']" value="'.$produtos['nome'].'" />';
			echo '<input type="hidden" name="item['.$cart_items.']['.'code'.']" value="'.$product_code.'" />';
			echo '<input type="hidden" name="item['.$cart_items.']['.'desc'.']" value="'.$produtos['descricao'].'" />';
			echo '<input type="hidden" name="item['.$cart_items.']['.'adic'.']" value="'.$cart_itm['adicional'].'" />';
			echo '<input type="hidden" name="item['.$cart_items.']['.'borda'.']" value="'.$cart_itm['borda'].'" />';
			echo '<input type="hidden" name="item['.$cart_items.']['.'cod_borda'.']" value="'.$cart_itm['cod_borda'].'" />';
			echo '<input type="hidden" name="item['.$cart_items.']['.'obs'.']" value="'.$cart_itm['obs'].'" />';
			echo '<input type="hidden" name="item['.$cart_items.']['.'cod_adic'.']" value="'.$cart_itm['cod_adicional'].'" />';
			echo '<input type="hidden" name="item['.$cart_items.']['.'qtd'.']" value="'.$cart_itm["qtd"].'" />';
			$cart_items ++;

        endforeach;

        $_SESSION['total'] = $total;
        ?>

    	</ul>
    	<div>
	<div class="taxas">
      <p>
      <?php if($restaurante['compra_minima'] > $total){
        $restaurante['taxa_servico'] = 0; ?>

        Valor Minimo: R$ <?=number_format($restaurante['compra_minima'],2,",",".");?> <br><br>

      <?php } $grandTotal = $total + $restaurante['taxa'] + $restaurante['taxa_servico']; ?>

            <strong>Sub-total: R$ <?=number_format($total,2,",",".");?> <br></strong>
            Taxa de entrega: R$ <?=number_format($restaurante['taxa'],2,",",".");?> <br>

            <?php if($restaurante['compra_minima'] < $total){ ?>
            Serviços: R$ <?=number_format($restaurante['taxa_servico'],2,",",".");?> <br>
        </p>
            <?php } ?>

            <p><strong>Total: R$ <?=number_format($grandTotal,2,",",".");?></strong> <br></p>

    </div>
		<br><br><br>
		<a href="escolha_produtos.php" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>
		</div>
<?php
    }else{
	echo '<h2> :( Seu carrinho está vazio</h2>';
	echo '<br><br><br>';
	echo '<a href="escolha_produtos.php" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>';
	}

    ?>
    </div>
</div>
<div class="animated fadeInRight">
  <div class="enderecos">
	<h1 align="center">Selecione o Endereço para Entrega</h1>
    <br>
	<?php
	 $enderecos = mostra_enderecos($_SESSION['id_usuario']);
	 foreach($enderecos as $endereco):
	 	if($endereco['cep'] == $_SESSION['cep']){
	 ?>

	<div class="radio">
  	<label>
  		<h3>
	    <input type="radio" name="endereco" value="<?= $endereco['id_endereco']; ?>" id="<?= $endereco['id_endereco']; ?>" required>
		<?php
		echo $endereco['logradouro'].', '.$endereco['numero'].' - '.$endereco['bairro'];
		echo "<h4>".$endereco['cidade']." - ".$endereco['estado']." - ".$endereco['cep']."</h4>";

		if(strlen($endereco['complemento']) > 2 || strlen($endereco['referencia']) > 2){
			echo "<h5>".$endereco['complemento']." - ".$endereco['referencia']."</h5>";
		}
		?>
		</h3>
  	</label>
</div>
<?php }
 endforeach; ?>
		<div align="right">
		<br><br>
				<a href="../minhaconta/cadastrar_enderecos.php" class="btn btn-default btn-lg">Cadastrar Novo Endereço <i class="fa fa-home"></i></a>
		</div>
	</div>
  </div>
</div>
<div class="view-cart-final" align="center">
 <?php if($restaurante['compra_minima'] > $_SESSION['total']){ ?>
            <button type="button" class="btn btn-warning btn-lg" disabled>Valor do pedido inferior ao valor minimo de R$ <?=number_format($restaurante['compra_minima'],2,",",".");?> <i class="fa fa-exclamation-triangle"></i></button>
        <?php } else { ?>
            <button type="submit" class="ladda-button btn btn-primary" data-color="mint" data-size="m" data-style="expand-left" name"ok"><i class="fa fa-credit-card"></i> Confirmar Pedido e seguir com o Pagamento</button>
        <?php } ?>

		</form>
</div>

<div class="clearfix"> </div>
<br>
    <div class="contact-section" id="contact">
            <div class="container">
                <div class="contact-section-grids">
                    <div class="col-md-3 contact-section-grid wow fadeInLeft" data-wow-delay="0.4s">
                        <h4>A Empresa</h4>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Sobre
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
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Termos de Uso
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#">
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
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-facebook fa-inverse"></i>
                                    </span>Facebook
                                </a>
                            </li>
                        </ul>
                            <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-instagram fa-inverse"></i>
                                    </span>Instagram
                                </a>
                            </li>
                        </ul>
                            <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-twitter fa-inverse"></i>
                                    </span>Twitter
                                </a>
                            </li>
                        </ul>
                            <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-youtube fa-inverse"></i>
                                    </span>Youtube
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 contact-section-grid nth-grid wow fadeInRight" data-wow-delay="0.4s">
                        <h4>Inscreva-se na nossa Newsletter</h4>
                        <p>E receba todas as Novidades no seu E-mail</p>
                        <form action="../subscribe.php" method="POST" accept-charset="utf-8">
                        <input type="text" class="text" value="" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
                        <input type="submit" value="Cadastrar">
                        </form>
                        </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    <!-- content-section-ends -->
    <!-- footer-section-starts -->
    <div class="footer">
        <div class="container">
            <p class="wow fadeInLeft" data-wow-delay="0.4s">&copy; 2014  All rights  Reserved | Template by &nbsp;<a href="http://w3layouts.com" target="target_blank">W3Layouts</a></p>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../web/js/jquery.min.js"></script>
    <script src="../web/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../web/js/easing.js"></script>

    <script src="inspinia/js/plugins/ladda/spin.js"></script>
    <script src="inspinia/js/plugins/ladda/ladda.js"></script>

    <script type="text/javascript">
        // Bind progress buttons and simulate loading progress
            Ladda.bind( 'button[type=submit]', {
                callback: function( instance ) {
                    var progress = 0;
                    var interval = setInterval( function() {
                        progress = Math.min( progress + Math.random() * 0.1, 1 );
                        instance.setProgress( progress );

                        if( progress === 1 ) {
                            instance.stop();
                            clearInterval( interval );
                        }
                    }, 500 );
                }
            } );
</script>
</body>
</html>
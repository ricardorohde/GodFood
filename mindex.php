<?php 
if(!isset($_SESSION))
    {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Delivery</title>
<link rel="icon" type="image/png" href="web/images/plate.png" />

<link rel="stylesheet" href="pedido/inspinia/css/ladda.min.css">

	<link href="web/css/bootstrap.min.css" rel="stylesheet">	

<!-- Custom Theme files -->
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--Animation-->
<script src="web/js/wow.min.js"></script>
<link href="web/css/animate.css" rel='stylesheet' type='text/css' />
<script>
	new WOW().init();
</script>
<link rel="stylesheet" href="web/font-awesome-4.3.0/css/font-awesome.min.css">
<!-- Chosen -->
<link rel="stylesheet" href="web/chosen/chosen.css">
<link rel="stylesheet" href="web/css/pace.css">

<link rel="stylesheet" href="web/css/superslides.css">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65249437-1', 'auto');
  ga('require', 'linkid', 'linkid.js');
  ga('send', 'pageview');

</script>
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">

<?php
include 'includes/menu-top.php';
require 'functions/pedidos.php';

$cidades = selectCidadesEntregas();

require 'functions/others.php';
$banners = buscaBannersIndex();
?>

		</div>
		<div class="wow fadeInUp" data-wow-delay="0.4s" id="Home">
				<div id="slides">
					    <div class="slides-container">
					<?php foreach($banners as $img): ?>
					      <img src="<?=$img['banner_index']?>" alt="<?=$img['alt']?>">
					<?php endforeach; ?>
					    </div>
					   <div align="center" class="form-index">
						<div class="banner-info">
					<div class="banner-info-head text-center wow fadeInLeft" data-wow-delay="0.5s">
						<h1>OS MELHORES RESTAURANTES NO ALCANCE DO SEU CLICK</h1>
						<div class="line">
							<h2> Faça Pedidos Online</h2>
						</div>
					</div>
						<form action="pedido/escolha-restaurante" method="POST" name="fcep" id="fcep">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<input type="tel" name="cep" id="cep" placeholder="Pesquise por cep" class="form-control cep" required>
							<br>
							<button class="ladda-button btn btn-danger" type="submit" data-size="m" data-style="zoom-in"><i class="fa fa-search fa-2x"> Pesquisar</i></button>
						</div>
					       
					    </div>
						</div>
						</form>
					    </div>
				<nav class="slides-navigation">
					      <a href="#" class="next"><i class="fa fa-angle-right fa-4x"></i></a>
					      <a href="#" class="prev"><i class="fa fa-angle-left fa-4x"></i></a>
				</nav>
			
		</div>
	</div>
	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="content">
		<div class="ordering-section" id="Order">
			<div class="container">
				<div class="ordering-section-head text-center wow bounceInRight" data-wow-delay="0.4s">
					<h3>Comprar comida nunca foi tão facil!</h3>
					<div class="dotted-line">
						<h4>Veja como funciona em 4 passos </h4>
					</div>
				</div>
				<div class="ordering-section-grids">
					<div class="col-md-3 ordering-section-grid">
						<div class="ordering-section-grid-process wow bounceInRight" data-wow-delay="0.4s">
							<i class="one"></i><br>
							<i class="one-icon"></i>
							<p>Escolha <span>seu restaurante</span></p>
							<label></label>
						</div>
					</div>
					<div class="col-md-3 ordering-section-grid">
						<div class="ordering-section-grid-process wow bounceInLeft" data-wow-delay="0.4s">
							<i class="two"></i><br>
							<i class="two-icon"></i>
							<p>Faça  <span>seu prato</span></p>
							<label></label>
						</div>
					</div>
					<div class="col-md-3 ordering-section-grid">
						<div class="ordering-section-grid-process wow bounceInUp" data-wow-delay="0.4s">
							<i class="three"></i><br>
							<i class="three-icon"></i>
							<p>Pague online</p>
							<label></label>
						</div>
					</div>
					<div class="col-md-3 ordering-section-grid">
						<div class="ordering-section-grid-process wow bounceInDown" data-wow-delay="0.4s">
							<i class="four"></i><br>
							<i class="four-icon"></i>
							<p>Aproveite <span>sua comida </span></p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>


		<div class="service-section">
			<div class="service-section-bottom-row">
				<div class="container">
					<div class="col-md-4 service-section-bottom-grid wow bounceIn "data-wow-delay="0.2s">
						<div class="icon">
							<img src="web/images/icon1.jpg" class="img-responsive" alt="" />
						</div>
						<div class="icon-data">
							<h4>Serviço 100% Garantido</h4>
							<p>Após a confirmação do seu pagamento, é só esperar no conforto da sua casa e aproveitar sua comida.</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-4 service-section-bottom-grid wow bounceIn "data-wow-delay="0.2s">
						<div class="icon">
							<img src="web/images/icon2.jpg" class="img-responsive" alt="" />
						</div>
						<div class="icon-data">
							<h4>Pagamento Totalmente Seguro</h4>
							<p>Usamos plataformas totalmente seguras para garantir o maximo de segunraça. </p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-4 service-section-bottom-grid wow bounceIn "data-wow-delay="0.2s">
						<div class="icon">
							<img src="web/images/icon3.jpg" class="img-responsive" alt="" />
						</div>
						<div class="icon-data">
							<h4>Acompanhe seus Pedidos</h4>
							<p>Você pode acompanhar o andamento do seu pedido online, é só acessar seu painel de usuario. </p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
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
						<form action="subscribe.php" method="POST" accept-charset="utf-8" >
						<input type="text" class="text" value="" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
						<input type="submit" value="Cadastrar">
						</form>
						</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="web/js/jquery.min.js"></script>
	<script src="web/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="web/js/easing.js"></script>
	<script type="text/javascript" src="web/js/pace.min.js"></script>

    <script src="pedido/inspinia/js/plugins/ladda/spin.js"></script>
    <script src="pedido/inspinia/js/plugins/ladda/ladda.js"></script>

    		<!--Mascaras -->
	<script type="text/JavaScript" src="web/js/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  	$('#cep').mask('99999-999');
	});
</script>

    <script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 8000 } );
</script>

<script src="web/js/jquery.superslides.min.js"></script>

<script>
    $('#slides').superslides({
      animation: 'fade',
      play: 5000
    });

</script>

<script src="web/chosen/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'			 : {no_results_text:'Desculpe, nada foi encontrado com'}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
</script>

    <script src="web/js/konami.js"></script>
    <script src="web/js/bacon.js"></script>
<script>
    var easter_egg = new Konami();
    	easter_egg.code = function() {
    		SnowStart();
    	}
    easter_egg.load();
</script>
</body>
</html>
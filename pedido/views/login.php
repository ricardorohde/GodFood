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
<link rel="icon" type="image/png" href="../web/images/plate.png" />

<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />

<link rel="stylesheet" href="inspinia/css/ladda.min.css">

<!-- Custom Theme files -->
<link href="../web/css/style.css" rel="stylesheet" type="text/css" media="all" />
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
<link href="../web/css/pace.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">
<?php
include 'includes/menu-top.php';

 ?>
	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="content">
	<div class="container">
		<div class="login-page">
			    <div class="dreamcrub">
			   	 <ul class="breadcrumbs">
                    <li class="home">
                       <a href="../" title="Go to Home Page">Home</a>&nbsp;
                       <span>/ </span>
                    </li>
                    <li class="women">
                       Login
                    </li>
                </ul>
                <ul class="previous">
                	<li><a href="../">Voltar para a pagina inicial</a></li>
                </ul>
                <div class="clearfix"></div>
                <br>
	<?php
include 'mensagens.php';
?>
          	   </div>
			   <div class="account_grid">
			   <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
			  	 <h3>NOVO POR AQUI?</h3>
				 <p>Começe criando sua conta é rápido e fácil, após isso você ja podera pedir varios pratos no conforto da sua casa.</p>
				 <a class="acount-btn" href="../minhaconta/cadastrar"><i class="fa fa-user-plus"></i> &nbsp;&nbsp;Cadastre-se</a>
			   </div>
			   <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
			  	<h3>INFORMAÇÕES DE LOGIN</h3>
				<p>Se você ja possui uma conta, insira seu usuario e senha para acessar sua conta</p>
				<form action="./resumo" method="POST">
				  <div>
					<label for="login">Usuario</label> <br>
					<input type="text" name="login" id="login" required>
				  </div>
				  <div>
					<label for="senha">Senha</label> <br>
					<input type="password" name="senha" id="senha" required>
				  </div>
				</div>
			<div class="col-sm-6 col-md-offset-6 login-right wow fadeInRight" data-wow-delay="0.4s">
				  <button type="submit" class="ladda-button btn-login" data-size="m" data-style="zoom-in"><i class="fa fa-lock fa-1x"></i> &nbsp;&nbsp;Entrar</button> 
				  <br>
				  <a class="forgot" href="../minhaconta/esqueci-minha-senha">Esqueceu sua Senha?</a>
			    </form>
			 </div>
			   <div class="clearfix"> </div>
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
						<form action="../subscribe.php" method="POST" accept-charset="utf-8" onsubmit="return sucesso()">
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
	<script src="../web/js/jquery.min.js"></script>
	<script src="../web/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../web/js/easing.js"></script>

	<script src="inspinia/js/plugins/ladda/spin.js"></script>
    <script src="inspinia/js/plugins/ladda/ladda.js"></script>

    <script src="../web/js/pace.min.js"></script>

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 8000 } );
</script>
</body>
</html>
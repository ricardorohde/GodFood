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
<title>GodFood - Cadastrar</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />
<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />

<link rel="stylesheet" href="../pedido/inspinia/css/ladda.min.css">

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
include 'mensagens_cad.php';
?>

	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="content">
	<div class="main">
	   <div class="container">
		  <div class="register">
		  	  <form action="registro.php" id="form_cadastrar" method="POST">
				 <div class="register-top-grid">
					<h3>INFORMAÇÕES PESSOAIS</h3>
					<div class="col-md-6">
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						<label for="nome">NOME COMPLETO *</label>
						<input type="text" name="nome" id="nome" required tabindex="1">
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						<label for="cpf">CPF *</label>  - digite apenas numeros.
						<input type="text" name="cpf" id="cpf" placeholder="___.___.___-__" maxlength="14" required tabindex="2">
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <label for="email">EMAIL *</label>
						 <input type="text" name="email" id="email" placeholder="email@exemplo.com.br" required tabindex="3">
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <label for="cep">CEP *</label> - digite apenas numeros.
						 <input type="text" name="cep" id="cep" placeholder="_____-___" maxlength="9" required tabindex="4">
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
					 	 <label for="celular">CELULAR </label> - digite apenas numeros.
						 <input type="text" name="celular" id="celular" required placeholder="(17) - 99999-9999" tabindex="5">
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <label for="telefone">TELEFONE </label> - digite apenas numeros.
						 <input type="text" name="telefone" id="telefone" placeholder="(17) - 9999-9999" tabindex="6">
					 </div>
					 </div>

					 <h4><strong>Campos com ( * ) são obrigatórios. </strong></h4>
					 <div class="clearfix"> </div>
					 <div class="col-md-12">
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Inscreva-se na nossa Newsletter</label>
					   </a> <br>
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="termos" checked="" required><i> </i>Concordo que li e aceito os <a href="../termos.php" target="_blank" class="termos-a"> Termos de Uso</a></label>
					   </a>
					</div>
					 </div>
				     <div class="register-bottom-grid">
						    <h3>INFORMAÇÕES DE LOGIN</h3>
						    <div class="col-md-6">
						     <div class="wow fadeInLeft" data-wow-delay="0.4s">
								<label for="usuario">USUARIO * - apenas letras e numeros, sem espaços</label>
								<input type="text" name="usuario" id="usuario" required pattern="[A-Za-z0-9\s]+$" title="Apenas Letras e Numeros" tabindex="7">
					 		</div>
					 		</div>
					 		<div class="col-md-6">
							 <div class="wow fadeInLeft" data-wow-delay="0.4s">
								<label for="senha">SENHA * (6 ou mais caracteres)</label>
								<input type="password" name="senha" id="senha" required pattern=".{6,}" title="Seis ou mais caracteres"	tabindex="8">
							 </div>
							 </div>
							 <div class="col-md-6">
							 <div class="wow fadeInRight" data-wow-delay="0.4s">
								<label for="confirma_senha">CONFIRME A SENHA * (6 ou mais caracteres)</label>
								<input type="password" name="confirma_senha" id="confirma_senha" required pattern=".{6,}" title="Seis ou mais caracteres" tabindex="9">
							 </div>
							 </div>
					 </div>
				<div class="clearfix"> </div>
				<div class="row">
					<div class="register-but">
						   	<button type="submit" tabindex="10" class="ladda-button btn btn-cadastrar" data-size="m" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Cadastrar</button>
							<a href="../minhaconta/" class="btn btn-default btn-lg" title="voltar"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>
						   <div class="clearfix"> </div>
					   </form>
					</div>
				</div>
		   </div>
	     </div>
	    </div>

<div class="clearfix"></div>
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
	<script type="text/javascript" src="../web/js/easing.js"></script>
	<script src="../web/js/bootstrap.min.js"></script>

	<script src="../web/js/pace.min.js"></script>

	<script src="../pedido/inspinia/js/plugins/ladda/spin.js"></script>
    <script src="../pedido/inspinia/js/plugins/ladda/ladda.js"></script>

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 10000 } );
</script>

		<!--Mascaras -->
<script type="text/JavaScript" src="../web/js/jquery.mask.js"></script>
   <script type="text/javascript">
  $(document).ready(function(){
  $('#cep').mask('99999-999');
  $('#cpf').mask('999.999.999-99');
  $('#telefone').mask('(99) - 9999-9999');
  $('#celular').mask('(99) - 99999-9999');
});
   </script>
</body>
</html>
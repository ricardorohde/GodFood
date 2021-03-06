<div class="menu-bar">
			<div class="container">
				<div class="top-menu">
					<ul>
						<li class="active"><a href="../">Inicio</a></li>|
						<li><a href="../termos-de-uso">Termos de Uso</a></li>|
						<li><a href="./pedidos">Pedidos</a></li>|
						<li><a href="../contato/">Contato</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>

<?php
require_once '../minhaconta/classes/Login.php';

$login = new Login();

if ($login->usuarioLogado() == true) {
?>
				<div class="login-section">
					<ul>
						<li><a href="./">Bem-vindo <?=$_SESSION['alcunha']?></a></li>
						<li><a href="./">Minha Conta</a></li> |
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

						 <li><a href="#" data-container="body" data-toggle="popover" data-placement="bottom"
						 data-content="Seu carrinho está vazio, por favor insira seu cep para escolher seus produtos.">
						<i class="fa fa-shopping-cart"></i>
						
						<?php
							echo 'Carrinho Vazio';
							} ?>

						</a></li> |
						<li><a href="../minhaconta/?logout">Sair</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

<?php } else { ?>

				<div class="login-section">
					<ul>
						<li><a href="./">Login</a>  </li> |
						<li><a href="../minhaconta/cadastrar">Registre-se</a> </li> |
						
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
						
						 <li><a href="#" data-container="body" data-toggle="popover" data-placement="bottom"
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
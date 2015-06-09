<?php
if(!isset($_SESSION))
 {
   session_start();
 }
require 'config.php';
require '../functions/pedidos.php';

//add item in shopping cart
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
	$codigo 	= filter_var($_POST["codigo"], FILTER_SANITIZE_STRING); //código do produto
	$cod_adicional = filter_var($_POST['adicional'], FILTER_SANITIZE_STRING); //código do adicional
	$cod_borda = filter_var($_POST['borda'], FILTER_SANITIZE_STRING); // código da borda recheada
	$qtd 	= filter_var($_POST["qtd"], FILTER_SANITIZE_NUMBER_INT); //quantidade
	$return_url 	= base64_decode($_POST["return_url"]); //return url
	$_SESSION['categoria_in'] = $_POST['categoria_in']; //categoria escolhida

	if(strlen($_POST['obs']) > 5){
		$obs = filter_var($_POST['obs'], FILTER_SANITIZE_STRING); // observação
	} else {
		$obs = null;
	}

	$produtos = select_add_produto($codigo);

	if($_POST['adicional'] > 0){
		$adicional = select_add_adicionais($cod_adicional);
	} else{
		$adicional['nome'] = 'Nenhum';
		$adicional['valor'] = '0';
	}

	if($_POST['borda'] > 0){
		$borda = select_add_bordas($cod_borda);
	} else{
		$borda['nome'] = 'Não';
		$borda['valor'] = '0';
	}
		//prepare array for the session variable
		$new_product = array(array('name'=>$produtos['nome'], 'code'=>$codigo, 'qtd'=>$qtd,
			'valor'=>$produtos['valor'], 'adicional'=>$adicional['nome'],
			'valor_adicional'=>$adicional['valor'], 'cod_adicional'=>$cod_adicional,
			'borda'=>$borda['nome'], 'valor_borda'=>$borda['valor'], 'cod_borda'=>$cod_borda, 
			'obs'=>$obs));
		if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false

			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if($cart_itm["code"] == $codigo){ //the item exist in array
					$qtd = $qtd + $cart_itm['qtd'];

						if(strlen($_POST['obs']) > 5){
							$obs = filter_var($_POST['obs'], FILTER_SANITIZE_STRING); // observação
						} else {
							$obs = $cart_itm['obs'];
						}

					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qtd'=>$qtd,
					 'valor'=>$cart_itm["valor"], 'adicional'=>$adicional['nome'],
					 'valor_adicional'=>$adicional['valor'], 'cod_adicional'=>$cod_adicional,
					 'borda'=>$borda['nome'], 'valor_borda'=>$borda['valor'], 'cod_borda'=>$cod_borda,
					 'obs'=>$obs);
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qtd'=>$cart_itm["qtd"],
					 'valor'=>$cart_itm["valor"], 'adicional'=>$cart_itm['adicional'],
					 'valor_adicional'=>$cart_itm['valor_adicional'], 'cod_adicional'=>$cart_itm['cod_adicional'], 
					 'borda'=>$cart_itm['borda'], 'valor_borda'=>$cart_itm['valor_borda'], 'cod_borda'=>$cart_itm['cod_borda'], 
					 'obs'=>$cart_itm['obs']);
				}
			}

			if($found == false) //item não encontrado na matriz
			{
				//adiciona novo item ao array
				$_SESSION["products"] = array_merge($product, $new_product);
			}else{
				//item encontrado, aumenta a quantidade do item
				$_SESSION["products"] = $product;
			}

		}else{
			//cria uma nova sessão se não existir com o produto
			$_SESSION["products"] = $new_product;
		}

	header('Location:'.$return_url);
}

//remove o item escolhido no carrinho
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"]))
{
	$codigo 	= $_GET["removep"]; //pega o código a ser removido
	$return_url 	= base64_decode($_GET["return_url"]); //return url

	foreach ($_SESSION["products"] as $cart_itm) //loop na session products
	{
		if($cart_itm["code"]!=$codigo){ //o item não existe na lista
			$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"],
				'qtd'=>$cart_itm["qtd"], 'valor'=>$cart_itm["valor"],
				'adicional'=>$cart_itm['adicional'],'valor_adicional'=>$cart_itm['valor_adicional'],
				'cod_adicional'=>$cart_itm['cod_adicional'],
				'borda'=>$cart_itm['borda'], 'valor_borda'=>$cart_itm['valor_borda'], 
				'cod_borda'=>$cart_itm['cod_borda'], 'obs'=>$cart_itm['obs']);
		}

		//cria um produto novo em session
		$_SESSION["products"] = $product;
	}

	//redirect back to original page
	header('Location:'.$return_url);
}

//esvaziar carrinho com unset em products
if(isset($_GET["removep"]) && isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
	unset($_SESSION["products"]);
	header('Location:'.$return_url);
}
?>

<?php

if(!isset($_SESSION))
 {
   session_start();
 }

date_default_timezone_set('America/Sao_Paulo');

$dsn = "mysql:host=localhost;dbname=u288492055_food;charset=utf8;TIME_ZONE='-03:00'";
$usuario = "root";
$pass = "";

$pdo = new PDO($dsn, $usuario, $pass);

function mostra_categorias($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT * FROM categorias WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaCategoriaSelecionada($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT * FROM categorias WHERE id_categoria = :id_categoria";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}


function lista_produtos($id_categoria)
{
	global $pdo;
try {
	$sql = "SELECT	p.nome as nome_produto,
		 			p.descricao as descricao,
		      		p.id as codigo,
					p.valor as valor_unit,
		     		c.nome as categoria,
          			c.id_categoria as cod_categoria

			FROM produtos p
		  	INNER JOIN categorias c
		  	ON p.id_categoria = c.id_categoria WHERE p.id_categoria = :id_categoria AND p.status = 1";

	 $cmd = $pdo->prepare($sql);
	 $cmd->bindParam('id_categoria',$id_categoria);
	 $cmd->execute();

	 return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function listaProdutos2Sabor($id_categoria,$id_produto)
{
	global $pdo;
try {
	$sql = "SELECT	p.nome AS nome_produto,
		 			p.descricao AS descricao,
		      		p.id AS codigo,
					p.valor AS valor_unit,
		     		c.nome AS categoria,
          			c.id_categoria AS cod_categoria

			FROM produtos p
		  	INNER JOIN categorias c
		  	ON p.id_categoria = c.id_categoria WHERE p.id_categoria = :id_categoria 
		  		AND p.status = 1 AND p.id != :id_produto";

	 $cmd = $pdo->prepare($sql);
	 $cmd->bindParam('id_categoria',$id_categoria);
	 $cmd->bindParam('id_produto',$id_produto);
	 $cmd->execute();

	 return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_add_produto($product_code)
{
	global $pdo;
try{
	$sql = "SELECT nome, valor, descricao FROM produtos
			WHERE id = :product_code";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('product_code', $product_code);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_resumo_pedido($product_code)
{
	global $pdo;
try{
	$sql = "SELECT nome,descricao, valor FROM produtos
			WHERE id = :product_code";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('product_code', $product_code);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaDesc($product_code)
{
	global $pdo;
try{
	$sql = "SELECT descricao FROM produtos
			WHERE id = :product_code";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('product_code', $product_code);
	$cmd->execute();

	return $cmd->fetch();
	
}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_id_cidade_entrega($cep)
{
	global $pdo;
try{
	$sql = "SELECT id_cidade_entrega from cidades_entregas where cep = :cep";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('cep',$cep);
	$cmd->execute();

	return $cmd->fetch();
}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function inserir_pedido($ItemTotalPrice, $total_pago, $taxa_entrega, $id_usuario, $id_restaurante, $id_cidade_entrega,$endereco)
{
	$data =  date("Y-m-d H:i:s");
	$data_pgto = date("Y-m-d H:i:s", strtotime("+30 seconds"));
	global $pdo;
	
try{
	$sql = "INSERT INTO pedidos (data,valor_total,valor_pago,taxa_entrega,id_usuario,id_restaurante,id_status,id_cidade_entrega,endereco,data_pgto)
			VALUES(:data, :ItemTotalPrice, :total_pago, :taxa_entrega, :id_usuario,
					:id_restaurante, 4,
				   	:id_cidade_entrega,:endereco,:data_pgto)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data', $data);
	$cmd->bindParam('ItemTotalPrice', $ItemTotalPrice);
	$cmd->bindParam('total_pago', $total_pago);
	$cmd->bindParam('taxa_entrega', $taxa_entrega);
	$cmd->bindParam('id_usuario',$id_usuario);
	$cmd->bindParam('id_restaurante', $id_restaurante);
	$cmd->bindParam('id_cidade_entrega', $id_cidade_entrega);
	$cmd->bindParam('endereco',$endereco);
	$cmd->bindParam('data_pgto',$data_pgto);
	$cmd->execute();

$_SESSION['last_id'] = $pdo->lastInsertId();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function update_pedido_sucess($lastid)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;

try{
	$sql = "UPDATE pedidos SET id_status = 4, data_pgto = :data
			WHERE id_pedido = :lastid";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data', $data);
	$cmd->bindParam('lastid', $lastid);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function update_pedido_error($lastid)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;

try{
	$sql = "UPDATE pedidos SET id_status = 3, data_error = :data
			WHERE id_pedido = :lastid";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data', $data);
	$cmd->bindParam('lastid', $lastid);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function update_pedido_fail($lastid)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;

try{
	$sql = "UPDATE pedidos SET id_status = 2, data_error = :data
			WHERE id_pedido = :lastid";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('lastid', $lastid);
	$cmd->bindParam('data', $data);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function update_pedido_warning($lastid)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;

try{
	$sql = "UPDATE pedidos SET id_status = 10, data_error = :data
			WHERE id_pedido = :lastid";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('lastid', $lastid);
	$cmd->bindParam('data', $data);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function insere_itens_pedido($id_pedido,$itens_pedido)
{
	global $pdo;

try{
	$sql = "INSERT INTO itens_pedido (id_pedido, id_categoria, produto, qtd, id_adicional, adicional, id_borda, borda, obs, valor_unit)
	        VALUES (:id_pedido, :id_categoria, :produto, :qtd, :id_adicional, :adicional, :id_borda, :borda, :obs, :valor_unit)";

	$cmd = $pdo->prepare($sql);

	$cmd->bindParam('id_pedido', $id_pedido);

	foreach ($itens_pedido as $item)
	{
			$cmd->bindParam('id_categoria', $item['id_categoria']);
			$cmd->bindParam('produto', $item['produto']);
			$cmd->bindParam('qtd', $item['qtd']);
			$cmd->bindParam('id_adicional',	$item['id_adicional']);
			$cmd->bindParam('adicional', $item['adicional']);
			$cmd->bindParam('id_borda',	$item['id_borda']);
			$cmd->bindParam('borda', $item['borda']);
			$cmd->bindParam('obs', $item['obs']);
			$cmd->bindParam('valor_unit', $item['valor']);
			$cmd->execute();
	}

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function unsets()
{
	unset($_SESSION['last_id']);
	unset($_SESSION["paypal_products"]);
	unset($_SESSION['id']);
	unset($_SESSION['id_restaurante']);
	unset($_SESSION['total']);
	unset($_SESSION['taxa_servico']);
	unset($_SESSION['compra_minima']);
	unset($_SESSION['taxa']);
}

function lista_pedidos_limit5($id_usuario)
{
	global $pdo;
try{
	$sql = "SELECT p.id_pedido as num_pedido,
			       DATE_FORMAT(p.data,'%d/%m/%Y às %T') as data,
			       sp.nome as status,
			       sp.status_reduzido as status_reduzido,
			       p.valor_pago as valor_total

			FROM pedidos p
		    INNER JOIN status_pgto sp
		    ON p.id_status = sp.id_status
		    WHERE id_usuario = :id_usuario
			ORDER BY p.id_pedido DESC
			LIMIT 5";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_usuario', $id_usuario);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function lista_todos_pedidos($id_usuario)
{
	global $pdo;
try{
	$sql = "SELECT p.id_pedido as num_pedido,
			       DATE_FORMAT(p.data,'%d %b %Y - %T') as data,
			       sp.nome as status,
			       sp.status_reduzido as status_reduzido,
			       p.valor_pago as valor_total

			FROM pedidos p
		    INNER JOIN status_pgto sp
		    ON p.id_status = sp.id_status
		    WHERE id_usuario = :id_usuario
			ORDER BY p.id_pedido DESC";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_usuario', $id_usuario);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function lista_itens_pedido($id_pedido)
{
	global $pdo;
try{
	$sql = "SELECT  ip.produto as produto,
        			c.nome as categoria,
	       			ip.qtd as qtd,
	       			ip.adicional as adicional,
	       			ip.borda as borda,
	       			ip.obs as obs,
			       	ip.valor_unit as valor,
			       	(ip.qtd * ip.valor_unit) as subtotal

		FROM itens_pedido ip
      	INNER JOIN categorias c
      	ON ip.id_categoria = c.id_categoria 
        WHERE id_pedido = :id_pedido

      		ORDER BY ip.id_item_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function detalhes_pedido($id_pedido)
{
	global $pdo;
try{
	$sql = "SELECT r.nome_fantasia as nome,
			       sp.nome as status,
			       ce.nome as cidade,
			       p.id_pedido as id_pedido,
			       p.endereco as endereco,
			       p.valor_pago as total_pago


			FROM pedidos p
			INNER JOIN restaurantes r
			ON p.id_restaurante = r.id_restaurante
		    INNER JOIN status_pgto sp
		    ON p.id_status = sp.id_status
			INNER JOIN cidades_entregas ce
			ON p.id_cidade_entrega = ce.id_cidade_entrega where id_pedido = :id_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostra_enderecos($id_usuario)
{
	global $pdo;
try{
	$sql = "SELECT * FROM enderecos WHERE id_usuario = :id_usuario";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_usuario',$id_usuario);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_endereco_entrega($id_endereco)
{
		global $pdo;
try{
	$sql = "SELECT * FROM enderecos WHERE id_endereco = :id_endereco";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_endereco',$id_endereco);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_endereco_entrega_detalhes($id_pedido)
{
		global $pdo;
try{
	$sql = "SELECT * FROM pedidos WHERE id_pedido = :id_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostra_categoria($id_produto)
{
	global $pdo;
try{
	$sql = "SELECT p.id as id_produto,
			       c.nome as categoria

			FROM produtos p
			INNER JOIN categorias c
			ON p.id_categoria = c.id_categoria where id = :id_produto";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_produto',$id_produto);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaCategoria2Sabor($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT nome FROM categorias WHERE id_categoria = :id_categoria";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function busca_adicionais($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT * FROM adicionais WHERE id_categoria = :id_categoria AND status = 1";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function busca_bordas($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT * FROM bordas WHERE id_categoria = :id_categoria AND status = 1";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaBorda($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT * FROM bordas WHERE id_categoria = :id_categoria AND status = 1";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	if($cmd->rowCount() > 0){
		return true;
	} else {
		return false;
	}

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaAdicional($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT * FROM adicionais WHERE id_categoria = :id_categoria AND status = 1";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	if($cmd->rowCount() > 0){
		return true;
	} else {
		return false;
	}

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}


function select_add_adicionais($id_adicional)
{
	global $pdo;
try{
	$sql = "SELECT * FROM adicionais WHERE id_adicional = :id_adicional";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_adicional',$id_adicional);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_add_bordas($id_borda)
{
	global $pdo;
try{
	$sql = "SELECT * FROM bordas WHERE id_borda = :id_borda";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_borda',$id_borda);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function selectCidadesEntregas()
{
	global $pdo;
try{
	$sql = "SELECT ce.nome as nome,
       		ce.cep as cep

		FROM entregas_restaurantes er
		INNER JOIN cidades_entregas ce
		ON ce.id_cidade_entrega = er.id_cidade_entrega

		GROUP By nome
		ORDER BY nome ASC";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function tarifas($id_restaurante,$id_pedido, $vPedido, $taxa_pgto, $taxa_adm, $servico, $taxa_entrega)
{
	$vTotal = (((($vPedido+$taxa_entrega)*($taxa_adm+$taxa_pgto))/100) + 0.6);
	$vLiq = $vPedido + $taxa_entrega - $vTotal;
	$vTotalPago = $vPedido + $servico + $taxa_entrega;
	$tarifas_pgto = (((($vPedido+$servico+$taxa_entrega)*$taxa_pgto)/100) + 0.6);
	$vLiquido_adm = (($vTotal+$servico)-($tarifas_pgto));
	$vTotal_tarifas = ($vTotal + $servico);

	$data =  date("Y-m-d H:i:s");;

	global $pdo;
try{
	$sql = "INSERT INTO tarifas (id_restaurante, id_pedido, data, vTotal_Pago, vTotal_Pedido,
				vLiquido_Restaurante, vLiquido_Adm, vTaxas_Restaurante, vTarifa_pgto, vTotal_Tarifas, taxa_adm)

 			VALUES (:id_restaurante, :id_pedido, :data, :vTotalPago, :vPedido,
 				:vLiq, :vLiquido_adm, :vTotal, :tarifas_pgto, :vTotal_tarifas, :taxa_adm)";

 	$cmd = $pdo->prepare($sql);
 	$cmd->bindParam('id_restaurante',$id_restaurante);
 	$cmd->bindParam('id_pedido',$id_pedido);
 	$cmd->bindParam('data',$data);
 	$cmd->bindParam('vTotalPago',$vTotalPago);
 	$cmd->bindParam('vPedido',$vPedido);
 	$cmd->bindParam('vLiq',$vLiq);
 	$cmd->bindParam('vLiquido_adm',$vLiquido_adm);
 	$cmd->bindParam('vTotal',$vTotal);
 	$cmd->bindParam('tarifas_pgto',$tarifas_pgto);
 	$cmd->bindParam('vTotal_tarifas',$vTotal_tarifas);
 	$cmd->bindParam('taxa_adm',$taxa_adm);
 	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function updateStatusTarifa($id_pedido)
{
	global $pdo;
try{
	$sql = "UPDATE tarifas SET status = 1 where id_pedido = :id_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaTarifasRestaurante($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT taxa_paypal, taxa_adm FROM restaurantes
				WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostra_configs($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT * FROM configs WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}
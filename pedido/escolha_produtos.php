﻿
<?php
if(!isset($_SESSION))
{
    session_start();
}
$current_url = base64_encode($url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$_SESSION['return_url'] = $current_url;

if(!isset($_SESSION['doisSabores'])){ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Pedido</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />

<link href="../web/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
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
<script src="//fast.eager.io/08rF23h_q8.js"></script>
<link rel="stylesheet" href="inspinia/css/ladda.min.css">

<link href="inspinia/css/iCheck/custom.css" rel="stylesheet">
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
    <!--  -->
    <div class="header">

<?php
include 'includes/menu-top.php';
require '../functions/pedidos.php';
require '../functions/restaurantes.php';

if(isset($_POST['id_restaurante'])){

if(isset($_SESSION['id_restaurante'])){
    if(isset($_POST['id_restaurante']) != $_SESSION['id_restaurante']){
        unset($_SESSION['products']);
    }
}

    $id_restaurante = $_POST['id_restaurante'];
    $_SESSION['id_restaurante'] = $_POST['id_restaurante'];
} else {
    if(isset($_SESSION['id_restaurante'])){
        $id_restaurante = $_SESSION['id_restaurante'];
    }
}
if(isset($id_restaurante)){
        $categorias = mostra_categorias($id_restaurante);
        $restaurante = mostra_infos_restaurante($id_restaurante,$_SESSION['cep']);
        $config = mostra_configs($id_restaurante);

        if(!isset($_SESSION['godshield'])){
            $_SESSION['taxa_servico'] = $restaurante['taxa_servico']; // taxa de serviço
        }

        $_SESSION['taxa'] = $restaurante['taxa']; // entrega
        $_SESSION['compra_minima'] = $restaurante['compra_minima']; // valor da compra minima
?>
<div class="animated fadeInRight">

    <div id="products-wrapper">
    <div class="row">
        <h1 align="center"><?=$restaurante['nome_fantasia']?></h1>
    </div>
    <br>
<div class="alert alert-danger alert-dismissible" role="alert">
      <h4>Você está em um ambiente de teste, nenhum pedido será registrado oficialmente nem entregue, caso encontre algum problema, bug ou erro, por favor, entre em contato conosco. Agradecemos sua compreensão.</h4>
</div>
<?php include 'mensagens.php'; ?>
<div class="products">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> <!-- Collapse das Categorias -->
    <?php foreach ($categorias as $cat): ?>
<!-- Header das Categorias -->
  <div class="panel panel-default">
  <a data-toggle="collapse" data-parent="#accordion" href="#<?= $cat['id_categoria']; ?>" aria-expanded="true" aria-controls="<?= $cat['id_categoria']; ?>">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
          <?= $cat['nome'];?>
      </h4>
    </div>
    </a>
    <?php

    if(isset($_SESSION['categoria_in'])){
        if($_SESSION['categoria_in'] == $cat['id_categoria'] ){
            $categoria_in = 'in';
            unset($_SESSION['categoria_in']);
        } else { $categoria_in = '';
    }
    } else{
        $categoria_in = '';
    }
     ?>
    <div id="<?= $cat['id_categoria']; ?>" class="panel-collapse collapse <?=$categoria_in;?>" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body"> <!-- Inicio dos produtos -->
    <?php
     $produtos = lista_produtos($cat['id_categoria']);
     $adicionais = busca_adicionais($cat['id_categoria']);
     $bordas = busca_bordas($cat['id_categoria']);
     $verificaBorda = verificaBorda($cat['id_categoria']);
     $verificaAdicional = verificaAdicional($cat['id_categoria']);
      foreach($produtos as $produto):
?>
    <div class="col-lg-12">
        <div class="contact-box-n">
            <h3><?= $produto['nome_produto'] ?></h3>
                <div class="product-desc"><?= $produto['descricao'] ?></div>
                    <div class="adicionar"><strong>
                        <?= "R$ ".number_format($produto['valor_unit'],2,",","."); ?></strong>
                        <button type="button" class="add_to_cart" data-toggle="modal" data-target="#myModa<?= $produto['codigo']?>"><i class="fa fa-cart-plus fa-2x"></i></button>
                    </div> <!-- Fim dos Protuso -->


<!-- Inicio do Modal dos Adicionais  -->
        <div class="modal inmodal" id="myModa<?= $produto['codigo']?>" tabindex="-1" role="dialog"  aria-hidden="true">
            <form action="cart_update.php" method="POST">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-cutlery modal-icon"></i>
                        <h4 class="modal-title">Aprimore seu Produto</h4>
                        <small><strong><?= $produto['nome_produto'];?></strong> <br> <?= $produto['descricao'] ?></small>
                    </div>
                    <div class="modal-body">
                        <div class="adicionar qtd-add">
                        Quantidade
                        <input type="number" min="1" name="qtd" value="1" required/>
                        </div>
            <?php 
            if($config['conf_borda'] == 1){
                if($verificaBorda == true){ ?>
            <br>
                 <h3>Bordas Recheadas</h3>
                        <p>Se você quer aproveitar cada centimetro da sua pizza, porque não rechear as bordas? Assim você evita o desperdicio e vamos combinar, fica bem mais saboroso *o*</p>
                    <br>
                <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4 radio-borda">
                    <label class="radio-i">
                        <input type="radio" name="borda" class="i-checks" checked="" value="0"> Borda sem recheio</input></div>
                    </label>
                <?php foreach ($bordas as $borda): ?>
                    <div class="col-md-4 radio-borda">
                    <label class="radio-i">
                        <input type="radio" name="borda" class="i-checks" value="<?=$borda['id_borda'];?>"> <?=$borda['nome'];?> + R$ <?=number_format($borda['valor'],2,",",".");?></input>
                    </label>
                    </div>
                <?php endforeach; ?>
                 </div>
                </div>
            <?php }
                }
            if($config['conf_adic'] == 1){
                if($verificaAdicional == true){ ?>
                <br>
                    <h3>Adicionais</h3>
                        <p>Escolha sabiamente seu adicional jovem padawan, pois você pode escolher apenas <strong>01</strong></p>
                    <br>
                <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4 radio-borda">
                    <label class="radio-i">
                        <input type="radio" name="adicional" class="i-checks" checked="" value="0"> Nenhum Adicional</input></div>
                    </label>
                <?php foreach ($adicionais as $adicional): ?>
                    <div class="col-md-4 radio-borda">
                    <label class="radio-i">
                        <input type="radio" name="adicional" class="i-checks" value="<?=$adicional['id_adicional'];?>"> <?=$adicional['nome'];?> + R$ <?=number_format($adicional['valor'],2,",",".");?></input>
                    </label>
                    </div>
                <?php endforeach; ?>
                 </div>
                </div>
                 <br>
            <?php } 
            } ?>
                 <div class="row">
                     <div class="col-md-12">
                     <label for="obs"><h3>Observação</h3></label>
                     <p>Neste campo, você pode inserir alguma observação sobre o produto que você deseja. <br> <strong>Não é obrigatório.</strong></p>
                         <input type="text" class="form-control" id="obs" name="obs" placeholder="Ex: Retirar Tomate, Retirar Milho, etc">
                     </div>
                 </div>
            <?php 
            if($config['conf_2sabores'] == 1){
                if($cat['2sabores'] == 'Sim'){ ?>
                 <br><br>
                <h4>
                    <label class="checkb"><input type="checkbox" class="i-checks" name="doisSabores"> Quero <?=$produto['categoria']?> com 02 Sabores!</label>
                </h4>  
            <?php } 
            }  ?> 
                 </div>
                    
                    <div class="modal-footer">
<!--Input Hidden + botão submit  -->
        <input type="hidden" name="codigo" value="<?= $produto['codigo']?>" />
        <input type="hidden" name="type" value="add" />
        <input type="hidden" name="return_url" value="<?=$current_url?>" />
        <input type="hidden" name="categoria_in" value="<?=$cat['id_categoria'];?>">
                        <button type="button" class="btn btn-danger btn-mobile" data-dismiss="modal"><i class="fa fa-close fa-1x"></i> Cancelar</button>
                        <button type="submit" class="ladda-button btn btn-primary btn-mobile" data-size="s" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Adcionar ao Carrinho</button>
                    </div>
                </div>
            </div>
        </div>

<!-- Fim do Modal  -->

            </form>
        </div>
    </div>
     <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endforeach;?>
</div>
</div>

<div class="animated shake">
  <div class="shopping-cart" id="shopping-cart">
    <h2>Seu Pedido <i class="fa fa-shopping-cart"></i></h2>
    <?php
    if(isset($_SESSION["products"]))
    {
        $total = 0;
        echo '<ol class="shopping-cart-itens">';
        foreach ($_SESSION["products"] as $cart_itm): 
            $categoria = buscaCategoria2Sabor($cart_itm['id_categoria']); ?>
            <li class="cart-itm">
                <span class="remove-itm"><a href="cart_update.php?removep=<?=$cart_itm['code']?>&return_url=<?=$current_url?>" class="btn btn-default btn-sm"><i class="fa fa-trash-o fa-1x"></i></a></span>
                <h3><?=$cart_itm['name']?> (<?= $categoria['nome'];  ?>)</h3>
                    <div class="p-qty">Quantidade : <?=$cart_itm['qtd']?></div>
                    <div class="p-adic"><strong>Adicional</strong> : <?=$cart_itm['adicional']?> , <strong>Borda</strong> : <?=$cart_itm['borda']?></div>

            <?php if(strlen($cart_itm['obs'])>5){ ?>
                    <p>Obs: <?=$cart_itm['obs'];?>;</p>

            <?php } $valorTotalProduto = ($cart_itm['valor']+$cart_itm['valor_adicional']+$cart_itm['valor_borda']);
            $subtotal = ($valorTotalProduto*$cart_itm['qtd']);?>

                    <div class="p-price">Valor : R$ <?=number_format($subtotal,2,",",".");?></div>
            </li>

            <?php

            $total = ($total + $subtotal);
        endforeach; ?>
        </ol>
          <div class="taxa">
          <p>
          <?php if($restaurante['compra_minima'] > $total){
            $restaurante['taxa_servico'] = 0; ?>

            Valor Minimo: R$ <?=number_format($restaurante['compra_minima'],2,",",".");?> <br><br>

          <?php } $grandTotal = $total + $restaurante['taxa'] + $restaurante['taxa_servico']; 
                $_SESSION['grandTotal'] = $grandTotal;?>

                <strong>Sub-total: R$ <?=number_format($total,2,",",".");?> <br></strong>
                Taxa de entrega: R$ <?=number_format($restaurante['taxa'],2,",",".");?> <br>
             </p>
                <?php if($restaurante['compra_minima'] < $total){ ?>
                <form action="update.php" method="POST" id="taxa">
            <?php if(isset($_SESSION['checked']) && $_SESSION['checked'] = 'checked'){ 
                 $checked = 'checked';   ?>
                <input type="hidden" name="godshield" value="no">
            <?php  } else { 
                $checked = '';   ?>
                <input type="hidden" name="godshield" value="yes">
            <?php } 
                if(!isset($_SESSION['godshield'])){
                    $checked = 'checked';
                    echo '<input type="hidden" name="godshield" value="no">';
                }
            ?>
                <p>
                    <input type="checkbox" name="taxa_adm" id="taxa" <?=$checked?> onclick="document.getElementById('taxa').submit();"><strong>GodShield. <a href="#shopping-cart" style="color: #9a2526" data-container="body" data-toggle="popover" data-placement="bottom"
                    data-content="Taxa de administração de risco, caso ocorra algum problema com o seu pedido, nós intermediaremos para que seja encontrada uma solução. Caso o cliente não opte por essa opção, ele declara estar ciente de que qualquer problema ocorrido com o pedido será de sua inteira responsabilidade.">
                    Saiba mais <i class="fa fa-question-circle"></i></a></strong>  R$ <?=number_format($restaurante['taxa_servico'],2,",",".");?> <br>
                </p>
                </form>
                <?php } 
                    if(isset($_SESSION['godshield']) && $_SESSION['godshield'] == 'no'){ ?>
                    <p><strong>Total: R$ <?=number_format(($grandTotal-$restaurante['taxa_servico']),2,",",".");?></strong> <br></p>
                    
                    <?php } else { ?>
                    
                    <p><strong>Total: R$ <?=number_format($grandTotal,2,",",".");?></strong> <br></p>
                    
                    <?php } ?>

        </div>
            <br>
        <span class="remove-itm"><a href="cart_update.php?removep=<?=$cart_itm["code"]?>&emptycart=1&return_url=<?=$current_url?>" class="btn btn-danger btn-md">Esvaziar Carrinho <i class="fa fa-trash-o fa-1x"></i></a></span>
        <br><br><br>
        <?php if($restaurante['compra_minima'] > $total){ ?>
        <br>
            <a href="#" class="btn btn-lg btn-warning btn-block disabled">Valor inferior ao minimo <i class="fa fa-exclamation-triangle"></i></a>

        <?php } else { 
            if ($login->usuarioLogado() == false){?>
        <br>
            <a href="#" data-toggle="modal" data-target="#enderecos" class="btn btn-lg btn-info btn-block">Entre para Continuar <i class="fa fa-lock"></i></a>
            <?php } else { ?>
        <br>
            <a href="#" data-toggle="modal" data-target="#enderecos" class="btn btn-lg btn-success btn-block">Concluir Pedido <i class="fa fa-check"></i></a>
        <?php 
            } 
        } 
     } else { ?>

        <h4>:( Seu carrinho está vazio</h4>
            <h5 align="center">Que tal escolher algo gostoso para comer?</h5>
                <br>
<?php } ?>
    </div>
  </div>
</div>
<?php if ($login->usuarioLogado() == false) { ?>

                            <div class="modal inmodal" id="enderecos" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                <div class="modal-content animated bounceInDown">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-lock modal-icon"></i>
                                            <h4 class="modal-title"><strong>Bem-vindo!</strong> Faça seu login</h4>
                                        </div>
                                        <div class="modal-body">
                                        <form action="./produtos" method="POST">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="login">Usuario</label> 
                                                    <input type="text" name="login" id="login" class="form-control" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="senha">Senha</label> 
                                                    <input type="password" name="senha" id="senha" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="ladda-button btn btn-primary btn-mobile btn-block" data-color="mint" data-size="s" data-style="zoom-in">Entrar <i class="fa fa-check fa-1x"></i></button>
                                        </div>
                                        <div class="modal-footer">
                                            <h4><a href="../minhaconta/cadastrar"> Cadastre-se</a></h4>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
<?php } else { ?>
<div class="modal inmodal" id="enderecos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-home modal-icon"></i>
                        <h4 class="modal-title">Selecione o Endereço para Entrega</h4>
                        <small class="font-bold"><strong>Atenção:</strong> O(s) endereço(s) listado(s) abaixo correspondem ao CEP <strong><?=$_SESSION['cep']?>.</strong> Caso não esteja visualizando algum endereço, verifique se ele não esta cadastrado em outro CEP. </small>
                </div>
                <div class="modal-body">
                <form method="POST" action="./resumo">
                    <?php
                         $enderecos = mostra_enderecos($_SESSION['id_usuario']);
                         foreach($enderecos as $endereco):
                            if($endereco['cep'] == $_SESSION['cep']){
                         ?>
                        <div class="radio">
                        <label>
                            <h3>
                            <input type="radio" name="endereco" class="i-checks" value="<?= $endereco['id_endereco']; ?>" id="<?= $endereco['id_endereco']; ?>" required>
                            <?php
                            echo $endereco['logradouro'].', '.$endereco['numero'].' - '.$endereco['bairro'];
                            echo "<h4 class='padding-left'>".$endereco['cidade']." - ".$endereco['estado']." - ".$endereco['cep']."</h4>";

                            if(strlen($endereco['complemento']) > 2 || strlen($endereco['referencia']) > 2){
                                echo "<h5 class='padding-left'>".$endereco['complemento']." - ".$endereco['referencia']."</h5>";
                            }
                            ?>
                            </h3>
                        </label>
                        </div>
                    <?php }
                     endforeach; ?>
                <div class="pull-right">
                    <a href="../minhaconta/cadastrar-endereco" class="btn btn-default btn-lg">Cadastrar Novo Endereço <i class="fa fa-plus"></i></a>
                </div>
                <br><br>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
                <button type="submit" class="ladda-button btn btn-primary btn-mobile" data-size="s" data-style="zoom-in">Prosseguir <i class="fa fa-check fa-1x"></i></button>
            </form>
             </div>
          </div>
      </div>
       <?php } ?>  
 </div>   
           
<div class="clearfix"> </div>
<br>
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../web/js/jquery.min.js"></script>
    <script src="../web/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../web/js/easing.js"></script>

    <script src="inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="inspinia/js/inspinia.js"></script>
    <script src="js/menu.js"></script>

    <script src="inspinia/js/plugins/ladda/spin.js"></script>
    <script src="inspinia/js/plugins/ladda/ladda.js"></script>

    <script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 10000 } );
</script>

    <!-- iCheck -->
    <script src="js/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>

</body>


    <script>
        $(document).ready(function(){
            $('.contact-box-n').each(function() {
                animationHover(this, 'pulse');
            });
        });
    </script>

</body>

</html>

<?php } else {
    $_SESSION['acesso_invalido'] = "Desculpe,
                Você não tem permissão para ver está pagina!
                <br>";
    header('Location: ./erro');
   }
} else {
    header('Location: completar-produto');
}
?>
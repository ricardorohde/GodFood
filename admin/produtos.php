<?php

require 'classes/Login.php';

$login = new Login();

// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
    require 'functions/functions.php';
    verifica_post();

    $current_url = base64_encode($url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $_SESSION['return_url'] = $current_url;

    if(isset($_SESSION['restaurante'])){
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Produtos</title>
    <link rel="icon" type="image/png" href="../../web/images/plate.png" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/ladda.min.css">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style_alternative.css" rel="stylesheet">
    
    <script src="../js/jquery-2.1.1.js"></script>
    <script src="../js/jquery.maskMoney.js" type="text/javascript"></script>
</head>

<body>
<?php if(isset($_SESSION['restaurante'])){
$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);
} else {
    $restaurante_ativo = null;
}
$nivelUsuario = verificaNivelUsuario($_SESSION['id_nivel']);
?>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                    <img src="../css/logo-branca.png" height="163" width="190" alt="GodFoo">
                    </div>
                </li>
                <li>
                    <a href="../"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a>
                </li>
                <li>
                    <a href="../pedidos"><i class="fa fa-cutlery"></i> <span class="nav-label">Pedidos</span> </span>
                <?php
                    if(isset($_SESSION['restaurante'])){
                        $count = verificaQtdPedidosNav($_SESSION['restaurante']); ?>
                    <span class="label label-success pull-right"><?=$count['pedidos'];?></span>
                <?php } ?>
                </a>
                </li>
                <li class="active">
                    <a href="#"><i class="fa fa-plus"></i> <span class="nav-label">Gerenciar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="../categorias">Categorias</a></li>
                        <li class="active"><a href="../gerenciar/produtos">Produtos</a></li>
                        <li><a href="../adicionais">Adicionais</a></li>
                        <li><a href="../bordas">Bordas Recheadas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Relatórios</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="../relatorios/vendas">Vendas</a></li>
                    </ul>
                </li>

                 <li>
                    <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Administrar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="../gerenciar/restaurantes">Restaurante</a></li>
                        <li><a href="../gerenciar/funcionarios">Funcionarios</a></li>
                    </ul>
                </li>
                <li>
                   <a href="../gerenciar/cidade-entrega"><i class="fa fa-truck"></i> <span class="nav-label">Entregas</span></a>
                </li>
                <?php if($_SESSION['id_nivel'] == 5){ ?>
                <li>
                    <a href="../pesquisa/pedidos"><i class="fa fa-search"></i> <span class="nav-label">Pesquisar Pedido </span></a>
                </li>
                <li>
                    <a href="../cadastrar-cidade"><i class="fa fa-globe"></i> <span class="nav-label">Cadastrar Cidade</span></a>
                </li>
                <li>
                    <a href="../restaurantes"><i class="fa fa-building-o"></i> <span class="nav-label">Alterar Restaurante</span></a>
                </li>
                <?php } ?>
                <li>
                    <a href="../entrar?logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Sair</span></a>
                </li>
            </ul>
        </div>
    </nav>
    
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="welcome-message">
                            <span class="m-r-sm text-muted welcome-message">Seja bem-vindo, <?=$_SESSION['nome']?></span>
                        </li>
                        <li class="logout">
                            <a href="../entrar?logout"><i class="fa fa-sign-out"></i> Sair</a>
                        </li>
                    </ul>
                </nav>
            </div> 

    
<?php
$produtos = lista_produtos($_SESSION['restaurante']);
$categorias = mostra_categorias($_SESSION['restaurante']);
 ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Produtos</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="../">Inicio</a>
                        </li>
                        <li>
                            Gerenciar
                        </li>
                        <li class="active">
                            <strong>Produtos</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                          <div class="col-md-5">
                          <h2 align="center"><?=$restaurante_ativo['nome_fantasia'];?></h2>
                          <form action="../cadastrar.php" method="POST" accept-charset="utf-8">
                          <?php if($restaurante_ativo != null){ ?>
					        <select class="form-control" name="categoria" id="categoria" required>
					           <option value="">Selecione a Categoria</option>
					           <?php
								foreach($categorias as $categoria): ?>
									<option value="<?=$categoria['id_categoria'];?>"
                                        <?php if(isset($_SESSION['categoria']) && $_SESSION['categoria'] == $categoria['id_categoria']){
                                             echo 'selected';}?>>
                                    <?=$categoria['nome'];?>
                                    </option>
								<?php endforeach; ?>
					        </select>
					        <?php } ?>
					      </div>
	                </div>
                </div>
            </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
            <div class="col-md-11">
                <h1 align="center"> Cadastrar Produto</h1>
                <br>
                </div>
            </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="nome">Nome do Produto</label>
                            <input type="text" id="nome" name="nome" value="" placeholder="Nome do Produto" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                           <label for="valor">Valor</label>
                            <input type="text" class="form-control" name="valor" id="valor" id="valor" required>
                            <script type="text/javascript">$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="descricao">Descrição</label>
                            <input type="text" id="descricao" name="descricao" value="" placeholder="Descrição" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" selected>Ativado</option>
                                <option value="0">Desativado</option>
                            </select>
                        </div>
                    </div>
                     <div class="col-sm-1">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="ladda-button btn btn-primary btn-outline" data-size="s" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Cadastrar</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
                <?php include 'mensagens.php'; ?>
               <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                    <div class="row">
                        <form name="form_pesquisa" id="form_pesquisa" method="post" action="../updates.php">
                            <div class="col-lg-8">
                                <input type="text" class="form-control pesquisa" name="pesquisaProduto" id="pesquisaProduto" value="" placeholder="Pesquise por Nome, Categoria ou Descrição" tabindex="1">
                            </div>
                            <div class="col-lg-2">
                                <select name="status" class="form-control">
                                    <option value="1" selected>Ativar</option>
                                    <option value="0">Desativar</option>
                                </select>
                            </div>
                        <div class="col-lg-1">
                        <button type="submit" class="ladda-button btn btn-warning btn-outline" data-size="s" data-style="zoom-in"><i class='fa fa-pencil-square-o fa-1x'></i> Alterar Status</button>
                        </div>
                        <input type="hidden" name="alteraStatus" value="yep">
                        </form>
                        </div>
                    </div>
                    <br>
                    <div id="contentLoading">
                         <div id="loading"></div>
                    </div>
                    <div class="ibox-content">
                       <div id="MostraPesq"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
            <div class="footer">
                <div>
                    <strong>Copyright &copy;</strong> - GodFood - Delivery  2015
                </div>
            </div>

        </div>
 </div>

    <!-- Mainly scripts -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>

    <script src="../js/plugins/ladda/spin.js"></script>
    <script src="../js/plugins/ladda/ladda.js"></script>

    <!-- Scripts JS -->

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 8000 } );
</script>

<script type="text/javascript">

 
$(document).ready(function(){

    //Aqui a ativa a imagem de load
    function loading_show(){
        $('#loading').html("<img src='../css/loading.gif'/>").fadeIn('fast');
    }

    //Aqui desativa a imagem de loading
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }

    // aqui a fun?o ajax que busca os dados em outra pagina do tipo html, n? ?json
    function load_dados(valores, page, div)
    {
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
                      loading_show();
                },
                data: valores,
                success: function(msg)
                {
                    loading_hide();
                    var data = msg;
                    $(div).html(data).fadeIn();
                }
            });
    }

    //Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
    load_dados(null, '../PesqProdutos.php', '#MostraPesq');


    //Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#pesquisaProduto').keyup(function(){

        //o serialize retorna uma string pronta para ser enviada
        var valores = $('#form_pesquisa').serialize()

        //pegando o valor do campo #pesquisaProduto
        var $parametro = $(this).val();

        if($parametro.length >= 1)
        {
            load_dados(valores, '../PesqProdutos.php', '#MostraPesq');
        }else
        {
            load_dados(null, '../PesqProdutos.php', '#MostraPesq');
        }
    });

    });
    </script>

</body>

</html>
<?php
    } else {
    $_SESSION['mensagem'] = "Você precisa escolher um restaurante para gerenciar os produtos";
    header('Location: ../restaurantes');
    }
} else {
    header('Location: ../entrar');
}
 ?>
<?php
if(!isset($_SESSION))
{
  session_start();
}
header("Content-Type: text/html; charset=utf-8", true);
require 'classes/Login.php';

$login = new Login();

// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
    require 'functions/functions.php';
    if(isset($_POST['id_borda'])){
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Alterar Dados</title>
    <link rel="icon" type="image/png" href="../../web/images/plate.png" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/ladda.min.css">
    
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <script src="../js/jquery.min.js" type="text/javascript"></script>
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
                        <li><a href="../gerenciar/produtos">Produtos</a></li>
                        <li><a href="../adicionais">Adicionais</a></li>
                        <li class="active"><a href="../bordas">Bordas Recheadas</a></li>
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
$_SESSION['id_borda'] = $_POST['id_borda'];

$borda = mostraDadosBorda($_POST['id_borda']);
$categorias = busca_categorias($_SESSION['restaurante']);

 ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Alterar Dados</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="../">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Alterar Dados</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                          <div class="col-md-5">
                          <h2 align="center"><?=$restaurante_ativo['nome_fantasia'];?></h2>
					      </div>
	                </div>
                </div>
            </div>

    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <?php include 'mensagens.php';?>
               <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
              <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">

                    <form action="../updates.php" method="POST">
                      <h2>Alteração de dados</h2>
                    </div>
                    <div class="ibox-content">
                       <div class="input-group">
                           <div class="row">
                               <div class="col-md-4">
                                   <label for="nome">Nome do Produto</label>
                                    <input type="text" class="form-control" name="nome" id="nome" value="<?=$borda['nome']?>" required>
                               </div>
                                <div class="col-md-3">
                                   <label for="cpf">Categoria</label>
                                    <select name="categoria" class="form-control" disabled="disabled">
                                  <?php foreach($categorias as $categoria): 
                                  if($categoria['id_categoria'] == $borda['id_categoria']){ 
                                    $selected = "selected"; } else { $selected = ""; } ?>
                                      <option value="<?=$categoria['id_categoria']?>" <?=$selected?>><?=$categoria['nome']?></option>
                                  <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                   <label for="valor">Valor</label>
                                   <?php $valor = str_replace(".",",", $borda['valor']);?>
                                    <input type="text" class="form-control" name="valor" id="valor" value="<?=$valor?>" required>
                                    <script type="text/javascript">$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
                               </div>
                               <div class="col-md-3">
                               <label for="status">Status</label>
                                  <select name="status" class="form-control" id="status">
                                    <option value="1">Ativado</option>
                                    <option value="0">Desativado</option>
                                  </select>
                               </div>
                           </div>
                          <br>
                        <div align="right">
                          <input type="hidden" name="alterarDadosBorda" value="alterar">
                            <a href="../bordas" type="button" class="btn btn-default btn-lg btn-outline"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>
                            &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary btn-lg btn-outline"><i class="fa fa-check fa-1x"></i> Atualizar</button>
                          </form>
                          </div>
                       </div>

                        </div>
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
    <script src="../js/jquery-2.1.1.js"></script>
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

    <!-- iCheck -->
    <script src="../js/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });

      $("form").submit(function() {
        $("select").removeAttr("disabled");
      });
        </script>
</body>

</html>
<?php
  } else {
      header('Location: ../bordas');
  }
} else {
    header('Location: ../entrar');
}
 ?>


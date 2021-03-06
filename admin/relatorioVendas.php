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

    <title>GodFood - Relatório de Vendas</title>
    <link rel="icon" type="image/png" href="../../web/images/plate.png" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/ladda.min.css">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">

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
                <li>
                    <a href="#"><i class="fa fa-plus"></i> <span class="nav-label">Gerenciar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="../categorias">Categorias</a></li>
                        <li><a href="../gerenciar/produtos">Produtos</a></li>
                        <li><a href="../adicionais">Adicionais</a></li>
                        <li><a href="../bordas">Bordas Recheadas</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Relatórios</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="../relatorios/vendas">Vendas</a></li>
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
$dadosR = mostraDadosRestaurante($_SESSION['restaurante']);

include 'includes/verificaDatasRelatorio.php';

$vendas = mostraDadosRelatorioVendas($data1,$data2,$_SESSION['restaurante']);
$taxa_entrega = buscaTaxaEntregaRelatorio($data1,$data2,$_SESSION['restaurante']);
$tarifas = buscaTarifasRestauranteAdmin($data1,$data2,$_SESSION['restaurante']);

$config = mostra_configs($_SESSION['restaurante']);
 ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Relatório de Vendas</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="../">Inicio</a>
                        </li>
                        <li>
                            Relatórios
                        </li>
                        <li class="active">
                            <strong>Vendas</strong>
                        </li>
                    </ol>
                </div>
               <div class="col-sm-8">
                    <div class="title-action">
                        <h2 align="left"><?=$restaurante_ativo['nome_fantasia'];?></h2>
                    </div>
                </div>
            </div>

    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <?php include 'mensagens.php';?>

            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>GodFood Ltda.</strong><br>
                                        www.godfood.com.br<br>
                                        Santa Fé do Sul - SP, Brasil<br>
                                        (17) - 99764-0291
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Relatório de Vendas</h4>
                                    <small>Emitido em</small>
                                    <h4 class="text-navy"><?=date('d/m/Y \à\s H:i');?> </h4>
                                    <address>
                                        <strong><h3><?=$dadosR['nome_fantasia']?></h3></strong>
                                        <?=$dadosR['logradouro'].", n° ".$dadosR['numero']." - ".$dadosR['bairro']?><br>
                                        <?=$dadosR['cidade']?><br>
                                        <?=$dadosR['fone']?>
                                    </address>
                    <form action="../relatorios/vendas" method="POST">
                        <div class="col-md-offset-4">
                            <div class="form-group" id="data">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" required value="<?=$dataS1?>"/>
                                    <span class="input-group-addon">até</span>
                                    <input type="text" class="input-sm form-control" name="end" required value="<?=$dataS2?>" />
                                </div>
                            </div>
                             <button type="submit" class="ladda-button btn btn-primary btn-outline" data-size="s" data-style="zoom-in"><i class="fa fa-calendar fa-1x"></i> Alterar Data</button>
                             </form>
                        </div>

                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="left">Item</th>
                                        <th>Total Vendidos</th>
                                    <?php if($config['conf_adic'] == 1){ ?>
                                        <th>Com adicionais</th>
                                    <?php } 
                                    if($config['conf_borda'] == 1){?>
                                        <th>Com bordas</th>
                                    <?php } ?>
                                        <th style="text-align: right">Valor Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                <?php $subtotal = 0;
                                 foreach ($vendas as $venda): ?>
                                    <tr>
                                        <td class="left"><strong><?=$venda['produto']." (".$venda['categoria'].")"; ?></strong></td>
                                        <td><?=$venda['qtd']?></td>
                                    <?php $countAdic = buscaDadosAdicVendidos($data1, $data2, $venda['produto']);
                                        if($countAdic['qtd'] < 1){
                                            $countAdic['qtd'] = 0;
                                        }
                                     if($config['conf_adic'] == 1){ ?>
                                        <td><?=$countAdic['qtd']?></td>
                                    <?php }
                                    $countBorda = buscaDadosBordaVendidos($data1, $data2, $venda['produto']);
                                        if($countBorda['qtd'] < 1){
                                            $countBorda['qtd'] = 0;
                                        } 
                                    if($config['conf_borda'] == 1){?>
                                        <td><?=$countBorda['qtd']?></td>
                                    <?php } ?>
                                        <td style="text-align: right">R$ <?= number_format($venda['sub_total'],2,",",".");?></td>
                                    </tr>
                                <?php $subtotal = $subtotal + $venda['sub_total'];
                                     endforeach; ?>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Entregas :</strong></td>
                                    <td>+ R$ <?= number_format($taxa_entrega['taxa_entrega'],2,",",".");?></td>
                                </tr>
                                <tr>
                                    <td><strong>Sub-Total :</strong></td>
                                    <td>R$ <?= number_format(($subtotal+$taxa_entrega['taxa_entrega']),2,",",".");?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tarifas :</strong></td>
                                    <td>- R$ <?= number_format($tarifas['taxa_pgto'],2,",",".");?></td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL LIQUIDO :</strong></td>
                                    <?php $total = $subtotal + $taxa_entrega['taxa_entrega'] - $tarifas['taxa_pgto']; ?>
                                    <td><strong>R$ <?= number_format($total,2,",",".");?></strong></td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="well m-t"><strong>Atenção: </strong>
                                O <strong>Sub-Total</strong> representa o valor total dos produtos vendidos + o valor recebido das entregas no periodo de <?=$dataS1?> até <?=$dataS2?>. <strong>TAXAS</strong> representa o valor repassado para a Administração do site, e o <strong>TOTAL LIQUIDO</strong> é o valor final recebido pelo restaurante.
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

    <!-- Data picker -->
   <script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>

   <script type="text/javascript">
        $('#data .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });
   </script>

</body>

</html>
<?php
    } else {
        $_SESSION['mensagem'] = "Você precisa escolher um restaurante para ver o relatório";
        header('Location: ../restaurantes');
    }
} else {
    header('Location: ../entrar');
}
 ?>
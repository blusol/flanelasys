<?php
session_start();
include_once('../includes/config.php');
require_once($path_relative . "verifica.php");
include_once($path_relative. 'includes/funcao.php');
include_once($path_classes . 'fla_rotatividade.class.php');

if (isset($_GET) && !empty($_GET['cod_rotatividade'])) {
    $objRotatividade = new fla_rotatividade();
    $objRotatividade->set_cod_rotatividade($_GET['cod_rotatividade']);
    $objRotatividade->imprimeCupomEntrada();
}
?>
<script language="javascript">
    window.close();
</script>

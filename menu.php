<ul id="jsddm">
    <li><a href="#">Estacionamento</a>
        <ul>
            <li><a href="<?php echo $url.'rotatividade/index.php';?>">:: Rotatividade</a></li>
        </ul>
    </li>

    <li><a href="#">Relat�rios</a>
        <ul>
            <li><a href="<?php echo $url; ?>relatorios/fechamento_caixa.php">:: Fechamento de Caixa </a></li>
            <li><a href="<?php echo $url; ?>relatorios/gera_rps.php">:: Gerar Lote RPS </a></li>
        </ul>
    </li>

<?php
    if ($_SESSION["COD_TIPO_USUARIO"] == 2) {
?>    
        <li><a href="#">Administra��o</a>
            <ul>
                <li><a href="<?php echo $url; ?>admin/clientes/index.php">:: M�dulo Clientes</a></li>
				<li><a href="<?php echo $url; ?>admin/cores/index.php">:: M�dulo Cores</a></li>
                <li><a href="<?php echo $url; ?>admin/descontos/index.php">:: M�dulo Descontos</a></li>				
                <li><a href="<?php echo $url; ?>admin/marcas/listar_marca.php">:: M�dulo Marcas</a></li>
                <li><a href="<?php echo $url; ?>admin/precos/index.php">:: M�dulo Pre�os</a></li>				
                <li><a href="<?php echo $url; ?>admin/usuarios/index.php">:: M�dulo Usu�rios</a></li>
                <li><a href="<?php echo $url; ?>admin/modelos/listar_modelo.php">:: M�dulo Veiculos</a></li>			
                <li><a href="<?php echo $url; ?>admin/gerais/index.php">:: Configura��es Gerais</a></li>
            </ul>
        </li>
<?php
    }
?>        
</ul>
<span style="text-align:right;float:right;font-size:small;">
    Ol�, <strong> <?php echo $_SESSION['NOM_USUARIO']; ?> !</strong> <a href="<?php echo $url.'logout.php'; ?>">Sair</a>
</span>
<br /><br />
<h2 style="text-align:center;font-weight:bolder;">
    <?php echo $titulo_pagina; ?>
</h2>
<div style="width:100%">
    <div style="float:left;width:20%">
        <img src="<?php echo $url; ?>images/logotipoFlanelaTransparente.png" alt="Flanela Sys" style="height:150px;width:200px;" />
    </div>
    <div style="float:right;width:80%">

        <ul id="jsddm">
            <li><a href="<?php echo $url . 'rotatividade/index.php'; ?>">Estacionamento</a></li>

            <li><a href="#">Relatórios</a>
                <ul>
                    <li><a href="<?php echo $url; ?>relatorios/fechamento_caixa.php">:: Fechamento de Caixa </a></li>
                    <li><a href="<?php echo $url; ?>relatorios/gera_rps.php">:: Gerar Lote RPS </a></li>
                    <li><a href="<?php echo $url; ?>relatorios/mensalistas.php">:: Mensalistas </a></li>
                </ul>
            </li>
            <?php
            if ($_SESSION["COD_TIPO_USUARIO"] == 2) {
                ?>    
                <li><a href="#">Administração</a>
                    <ul>
                        <li><a href="<?php echo $url; ?>admin/clientes/index.php">:: Módulo Clientes</a></li>
                        <li><a href="<?php echo $url; ?>admin/cores/index.php">:: Módulo Cores</a></li>
                        <li><a href="<?php echo $url; ?>admin/descontos/index.php">:: Módulo Descontos</a></li>				
                        <li><a href="<?php echo $url; ?>admin/marcas/listar_marca.php">:: Módulo Marcas</a></li>
                        <li><a href="<?php echo $url; ?>admin/mensalidades/index.php">:: Módulo Mensalidades</a></li>
                        <li><a href="<?php echo $url; ?>admin/precos/index.php">:: Módulo Preços</a></li>				
                        <li><a href="<?php echo $url; ?>admin/usuarios/index.php">:: Módulo Usuários</a></li>
                        <li><a href="<?php echo $url; ?>admin/modelos/listar_modelo.php">:: Módulo Veiculos</a></li>			
                        <li><a href="<?php echo $url; ?>admin/gerais/index.php">:: Configurações Gerais</a></li>
                    </ul>
                </li>
                <?php
            }
            ?>        
        </ul>
        <span style="text-align:right;float:right;font-size:small;">
            Olá, <strong> <?php echo $_SESSION['NOM_USUARIO']; ?> !</strong> <a href="<?php echo $url . 'logout.php'; ?>">Sair</a>
        </span>
        <br /><br />
    </div>
</div>
<div style="clear:both;"></div>
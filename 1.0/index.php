<?php
    include('includes/config.php');
    include_once($path_classes.'fla_usuarios.class.php');    
    $objUsuarios = new fla_usuarios();
    $arrUsuario = array();
    $msg = "";
    
    if (!empty($_POST)) {
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        
        $objUsuarios->set_des_login($login);
        $objUsuarios->set_des_senha($senha);
        
        // Pesquisando os dados do usuário na base e armazenando no array
        $arrUsuario = $objUsuarios->logaUsuario($objUsuarios);
        
        // Verifica se retornou algum valor no array 
        if (count($arrUsuario) > 0) {
            // Verifica se o usuário está ativo
            if ($arrUsuario[0]['ind_ativo'] == 1) {
                // Armazena o nome e o tipo de usuário em sessão
                session_start();
                $_SESSION['NOM_USUARIO']      = $arrUsuario[0]['nom_usuario'];
                $_SESSION['COD_TIPO_USUARIO'] = $arrUsuario[0]['cod_tipo'];
                $rotatividade = $url . "rotatividade/index.php";
                header("Location:$rotatividade");
            } else {
                // Se o usuário não estiver ativo, exibe uma mensagem ao usuário
                $msg = 'Desculpe, sua conta não está ativa no sistema';
            }
        } else {
            // Se o array voltou vazio, os dados preenchidos estão incorretos, então exibe uma mensagem ao usuário
            $msg = "Desculpe, login ou senha incorretos";
        }
    }
?>
<html>
	<head>
		<title><?php echo $titulo_pagina; ?> </title>
        <link href="./images/style.css" rel="stylesheet" type="text/css" />        
    </head>
    <body>
        <div class="content">
            <div class="data">  
            <h1 style="text-align:center;font-weight:bolder;">
                <?php echo $titulo_pagina; ?>
            </h1>
                <form name="login" action="index.php" method="POST">            
                <table id="pagina_login">                    
                    <tr>
                        <th colspan="2">Login de acesso</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="error"> 
                            <?php echo $msg; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="login">Usuário:</label> 
                        </td>
                        <td>
                            <input type="text" id="login" name="login" maxlength="20" size="20"> <br>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="senha">Senha: </label>
                        </td>
                        <td>
                            <input type="password" id="senha" name="senha" maxlength="20" size="20">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <input type="submit" name="acessar" value="Entrar"> 
                        </td>
                    </tr>
                </table>
                </form>
            </div>
<?php
            include_once($path_relative . 'rodape.php');
?>            
        </div>	                
	</body>
</html>
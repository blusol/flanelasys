<?php

  // Definindo constantes que definem a forma de uso da / nos endereços e caminhos
  define('DS', '/');
  define('PS', PATH_SEPARATOR);

  // Definindo a Url principal do sistema
  $url = "http://localhost/flanelasys" . DS;	
  
  // Definindo o caminho principal para o sistema
  $path_relative = $_SERVER['DOCUMENT_ROOT'] . DS . 'flanelasys'. DS; 
  
  $titulo_pagina = 'Flanela Sys - versão 1.0';

  // Definição de caminhos lógicos do sistema  
  $path_includes  = $path_relative . DS . 'includes' . DS;
  $path_images    = $path_relative . 'images' . DS;
  $path_libraries = $path_relative . 'libs' . DS;
  $path_admin = $path_relative . DS . 'admin' . DS;
  $path_classes = $path_relative . DS . 'classes' . DS;
  $path_nfes = $path_relative . 'nfes' . DS;
  $path_notablu = $path_nfes . 'notablu' . DS;
  
  // Defiinindo caminho lógicos das bibliotecas externas
  $path_lib_adodb = $path_libraries_relative . DS .'adodb' . DS;
  
  

  // Definindo a Url para o módulo de administração
  $url_gerenciador = $url . 'admin' . DS;  
  
  // Definindo o caminho via browser das bibliotecas externas
  $url_images = $url . 'images' . DS;

  // Definindo o caminho do jquery
  $url_lib_jquery = $url . 'libs' . DS . 'jquery' . DS;
  $url_includes   = $url . 'includes' . DS;
  $url_libs       = $url . 'libs' . DS ;
  
  // Setando o fuso horario manualmente
  ini_set('date.timezone', 'America/Sao_Paulo');
?>
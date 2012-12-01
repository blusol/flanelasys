34a35,41
>   `num_telefone` bigint(15) NOT NULL,
>   `num_celular` bigint(15) NOT NULL,
>   `ind_ativo` int(1) NOT NULL DEFAULT '1',
>   `des_observacao` text NOT NULL,
>   `tip_mensalidade` int(6) NOT NULL DEFAULT '0',
>   `dat_contratacao` date NOT NULL,
>   `dia_vencimento` int(2) NOT NULL,
275a283,319
> DROP TABLE IF EXISTS `fla_mensalidade`;
> /*!40101 SET @saved_cs_client     = @@character_set_client */;
> /*!40101 SET character_set_client = utf8 */;
> CREATE TABLE `fla_mensalidade` (
>   `cod_mensalidade` int(6) NOT NULL AUTO_INCREMENT,
>   `des_mensalidade` varchar(200) NOT NULL,
>   `val_mensalidade` float(5,2) NOT NULL,
>   `ind_ativo` int(1) NOT NULL DEFAULT '1',
>   `dat_criacao` date NOT NULL,
>   PRIMARY KEY (`cod_mensalidade`)
> ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
> /*!40101 SET character_set_client = @saved_cs_client */;
> 
> LOCK TABLES `fla_mensalidade` WRITE;
> /*!40000 ALTER TABLE `fla_mensalidade` DISABLE KEYS */;
> /*!40000 ALTER TABLE `fla_mensalidade` ENABLE KEYS */;
> UNLOCK TABLES;
> DROP TABLE IF EXISTS `fla_mensalidade_usuario`;
> /*!40101 SET @saved_cs_client     = @@character_set_client */;
> /*!40101 SET character_set_client = utf8 */;
> CREATE TABLE `fla_mensalidade_usuario` (
>   `cod_mensalidade_usuario` int(6) NOT NULL AUTO_INCREMENT,
>   `valor_pago` float(5,2) NOT NULL,
>   `periodo_inicial` date NOT NULL,
>   `periodo_final` date NOT NULL,
>   `data_pagamento` date NOT NULL,
>   `des_justificativa` varchar(200) NOT NULL,
>   `cod_cliente` int(6) NOT NULL,
>   `cod_mensalidade` int(6) NOT NULL,
>   PRIMARY KEY (`cod_mensalidade_usuario`)
> ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
> /*!40101 SET character_set_client = @saved_cs_client */;
> 
> LOCK TABLES `fla_mensalidade_usuario` WRITE;
> /*!40000 ALTER TABLE `fla_mensalidade_usuario` DISABLE KEYS */;
> /*!40000 ALTER TABLE `fla_mensalidade_usuario` ENABLE KEYS */;
> UNLOCK TABLES;
1625a1670
>   `cod_cliente` int(6) NOT NULL,
1626a1672
>   `cod_mensalidade_usuario` int(6) NOT NULL,
1629a1676
>   `nom_arquivo` varchar(100) NOT NULL,

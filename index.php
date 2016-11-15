<?php //namespace FatecFranca\ADS8N;
/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/
    //use \FatecFranca\ADS8;
    session_cache_expire(4); // Tempo da sessão de 4 minutos (padrão php = 10min)
    //session_cache_limiter('private');
    session_start(); // inicia a sessão
    //echo "Criada página padrão do projeto";
    
    // Exibe todos os erros
    error_reporting(E_ALL);
    
    require_once('./classes/Application.php');
    
    // Iniciando a aplicação
    $app = new Application('development');
    $app->run();   
    
?>
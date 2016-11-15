<?php
/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/
    // Parâmetros para o ambiente de desenvolvimento
    return [
        // Nome do servidor de banco de dados
        'db_host' => 'localhost',       
        
        // Porta do servidor de banco de dados
        'db_port' => 3306,              
        
        // Usuário do banco de dados
        'db_user' => 'root',            
        
        // Senha do banco de dados
        'db_password' => '123456',            
        
        // Nome do banco de dados
        'db_schema' => 'news_portal',   
        
        // Nome do banco de dados
        'default_controller' => 'site', 
        
        // Action padrão
        'default_action' => 'index',     
        
        // URL base da aplicação
        'base_url' => '/portal-noticias/',
        
        // Sal para encriptação de senhas
        'password_salt' => 'Batat1nhaQuandoNasceSeE$parramaPeloCha1'
    ];

?>
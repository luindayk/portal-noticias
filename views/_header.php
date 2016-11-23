<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta lang="pt-BR" />
        <title>O NOTICIOSO - Portal de Notícias
        <?php 
            if(isset($title)){
                echo "[$title]";
            }
        ?>
        </title>
        <link href="_styles/style.css" type="text/css" rel="stylesheet" />
    </head>
    
    <body>
        
        <header>
            <img src="_images/logo.png" alt="O NOTICIOSO: a verdade está aqui dentro." />
        </header>
        
        <nav>
            <ul>
                <li><a href="?user">Listar usuários</a></li>
                <li><a href="?news">Listar notícias</a></li>
            </ul>
        </nav>
        
        <section>
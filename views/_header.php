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
                <li><a href="?site">Página Inicial</a></li>
                <li><a href="?news">Notícias</a></li>
                <li><a href="?user">Usuários</a></li>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <li> [<?=$_SESSION['username'];?>] <a href="?site/logout"> (sair)</a></li>
                <?php } else { ?>
                    <li> <a href="?site/login">Fazer Login</a></li>
                <?php } ?>
            </ul>
        </nav>
        
        <section>
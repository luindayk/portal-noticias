<!--/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta lang="pt-BR" />
        <title>Nova notícia</title>
    </head>
    <body>
        
        <h1>Nova notícia</h1>
        
        <?php
            $action = '?news/new';
            include('views/news/_form.php');
        ?>
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
        <title>O NOTICIOSO - Portal de Notícias</title>
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
            <?php foreach($model as $instance): ?>
                <article>
                    <h1><?= $instance->getAttrValue('title'); ?></h1>
                    <h4>
                    <?php
                        // Obtém a data do BD em formato de string
                        $creationTime = $instance->getAttrValue('creation_time');
                        // Converte a string de data em data real
                        // e formata de acordo com o costume brasileiro
                        echo date('d/m/Y H:i', strtotime($creationTime));
                    ?>
                    </h4>
                    <?php
                        $body = $instance->getAttrValue('body');
                        
                        // Converte todos as quebras de linha em marcas
                        // de parágrafo HTML
                        $body = '<p>' . str_replace("\n", "</p>\n<p>", $body) . '</p>';
                        
                        echo $body;
                    ?>
                </article>
            <?php endforeach; ?>
        </section>
        <footer>
            Aqui é o rodapé
        </footer>
    </body>
    
</html>
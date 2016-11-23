<!--/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/-->
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
<!--/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/-->
<h1>Editando notícia #<?= $model->getAttrValue('news_id'); ?></h1>


<?php
    $action = '?news/edit/' . $model->getAttrValue('news_id');
    include('views/news/_form.php');
?>
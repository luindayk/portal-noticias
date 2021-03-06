<!--/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/-->
<h1>Excluir notícia #<?= $model->getAttrValue('news_id'); ?></h1>

<?php if($this->hasMessages()) : ?>
    <div style="color:darkgreen">
        <?php
            $messages = $this->getMessages(true);
            // Exibe a primeira mensagem disponível
            echo $messages[0];
        ?>
    </div>
<?php else: ?>

    <form method="post" action="?news/delete/<?= $model->getAttrValue('news_id'); ?>">
        <p>Deseja realmente excluir a notícia <strong>
            <?= $model->getAttrValue('title'); ?></strong>
            ?
        </p>
        <div>
            <input type="submit" name="_DELETE_" value="Confirmar" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="Cancel" value="Cancelar" />
        </div>
    </form>
    
<?php endif; ?>
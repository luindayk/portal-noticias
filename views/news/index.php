<!--/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/-->
<h1>Listagem de notícias</h1>
<p><a href="?site">Voltar ao Início</a></p>
<p><a href="?news/new">Criar nova notícia</a></p>
<?php if($this->hasMessages()) : ?>
        <div style="color:darkgreen">
            <?php
                $messages = $this->getMessages(true);
                // Exibe a primeira mensagem disponível
                echo $messages[0];
            ?>
        </div>
<?php endif; ?>
<table>
	<tr>
		<th>Código da Notícia</th>
		<th>Título</th>
		<th>Data/Hora</th>
		<th>Código do usuário</th>
		<th>EDITAR</th>
		<th>EXCLUIR</th>
	</tr>
	
	<?php foreach($model as $news) : ?>
		<tr>
			<td><?=$news->getAttrValue('news_id')?></td>
			<td><?=$news->getAttrValue('title')?></td>
			<td>
			<?php
                $creationTime = $news->getAttrValue('creation_time');
                echo date('d/m/Y H:i', strtotime($creationTime));
            ?>
            </td>
			<td><?=$news->getAttrValue('user_id')?></td>
			<td><a href="?news/edit/<?=$news->getAttrValue('news_id');?>">Editar</a></td>
			<td><a href="?news/delete/<?=$news->getAttrValue('news_id');?>">Excluir</a></td>
		</tr>
	<?php endforeach; ?>
</table>
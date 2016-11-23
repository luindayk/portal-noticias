<!--/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/-->
<h1>Listagem de usuários</h1>
<p><a href="?site">Voltar ao início</a></p>
<p><a href="?user/new">Criar novo usuário</a></p>
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
		<th>Código</th>
		<th>Primeiro Nome</th>
		<th>Sobrenome</th>
		<th>Nome de usuário</th>
		<th>EDITAR</th>
		<th>EXCLUIR</th>
	</tr>
	
	<?php foreach($model as $user) : ?>
		<tr>
			<td><?=$user->getAttrValue('user_id')?></td>
			<td><?=$user->getAttrValue('firstname')?></td>
			<td><?=$user->getAttrValue('lastname')?></td>
			<td><?=$user->getAttrValue('username')?></td>
			<td><a href="?user/edit/<?=$user->getAttrValue('user_id');?>">Editar</a></td>
			<td><a href="?user/delete/<?=$user->getAttrValue('user_id');?>">Excluir</a></td>
		</tr>
	<?php endforeach; ?>
</table>
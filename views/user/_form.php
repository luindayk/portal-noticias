<!--/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/-->
      <!--Se houver mensagens de erros exibe na tela -->
<?php if ($this->hasMessages()): ?>
    <div style="color:darkgreen">
        <?php
            $messages = $this->getMessages(true);
            // Exibe a primeira mensagem disponível
            echo $messages[0];
        ?>
    </div>
<?php endif ?>


<form name="user" action="<?= $action ?>" method="post">
    
    <div>
        <label for="f_firstname">Primeiro Nome</label><br />
        <input type="text" name="firstname" id="f_firstname" maxlength="30"
             value="<?= $model->getAttrValue('firstname'); ?>" />
        <?php $model->displayErrors('firstname') ?>
    </div>
    
    <div>
        <label for="f_lastname">Sobrenome</label><br />
        <input type="text" name="lastname" id="f_lastname" maxlength="30"
               value="<?= $model->getAttrValue('lastname'); ?>" />
        <?php $model->displayErrors('lastname') ?>
    </div>
    
    <div>
        <label for="f_username">Usuário</label><br />
        <input type="text" name="username" id="f_username" maxlength="20"
               value="<?= $model->getAttrValue('username'); ?>"/>
        <?php $model->displayErrors('username') ?>
    </div>
    
    <div>
        <label for="f_password">Senha</label><br />
        <input type="password" name="password" id="f_password" />
        <?php $model->displayErrors('password') ?>
    </div>
    
    <div>
        <label for="f_password2">Confirme a senha</label><br />
        <input type="password" name="password2" id="f_password2" />
        <?php $model->displayErrors('password2') ?>
    </div>
    
    <div>
        <input type="reset" value="Limpar" />
        <input type="submit" value="Salvar" />
    </div>
    
</form>
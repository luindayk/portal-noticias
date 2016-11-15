<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta lang="pt-BR" />
        <title>Acesso ao sistema</title>
    </head>
    <body>
        
        <h1>Acesso ao sistema</h1>

        <?='Usuário autenticado, id = ' . $_SESSION['user_id'] ?>
        
        <?php if ($this->hasMessages()): ?>
            <div style="color:darkgreen">
                <?php
                    $messages = $this->getMessages(true);
                    // Exibe a primeira mensagem disponível
                    echo $messages[0];
                ?>
            </div>
        <?php endif ?>
        
        
        <form name="user" action="?site/login" method="post">
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
                <input type="submit" value="Entrar" />
            </div>
            
        </form>
        
    </body>
</html>
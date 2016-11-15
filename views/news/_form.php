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
        
        
        <form name="news" action="<?= $action ?>" method="post">
            
            <div>
                <label for="f_title">Título da Notícia</label><br />
                <textarea id="f_title" name="title" rows="4" maxlength="200" style="resize:none;width:50%;"><?= $model->getAttrValue('title'); ?></textarea>
                <?php $model->displayErrors('title') ?>
            </div><br/><br/>
            
            <div>
                <label for="f_user_id">ID do usuário</label><br />
                <input type="text" name="user_id" id="f_user_id" maxlength="2"
                       value="<?= $model->getAttrValue('user_id') ;?>" />
                <?php $model->displayErrors('user_id') ?>
            </div><br/><br/>
            
            <div>
                <label for="f_body">Corpo da Notícia</label><br />
                <textarea type="text" id="f_body" name="body" rows="15" cols="60" style="resize:none;width:50%;" ><?= $model->getAttrValue('body'); ?></textarea>
                <?php $model->displayErrors('body') ?>
            </div>

            <div>
                <input type="reset" value="Limpar" />
                <input type="submit" value="Salvar" />
            </div>
            
        </form>
        
    </body>
</html>
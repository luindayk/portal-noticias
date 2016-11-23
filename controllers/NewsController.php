<?php
/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/
require_once('classes/BaseController.php');
require_once('models/News.php');
/*
    Esta classe é responsável por fazer a mediação entre o model e as views.
*/
class NewsController extends BaseController {
    
    // Método responsável por criar uma nova notícia
    public function actionNew() {
        
        $news = new News($this);    // Cria um novo objeto do modelo

        // Somente se o $_POST estiver preenchido
        if($_POST != []) {
            
            /* Carrega os dados em estado bruto de $_POST para
               os atributos do modelo recém-criado */
            $news->loadRawData();
            /* Tenta salvar os dados do modelo para o banco de
             * dados, passando antes pela validação
             */            
            if($news->save()) {
                // Adiciona uma mensagem para o usuário
                $this->addMessage('Notícia inserida com sucesso.');
                // renderiza para action padrão e termina a execução
                // da action atual
                $this->actionIndex();die;
            }            
        }        
        // renderiza a própria action com o mesmo model
        $this->render('new', $news);
    }
    
    public function requireLogin($action){
        $hasSession = isset($_SESSION['user_id']);

        // Será necessária a autenticação quando não houver sessão ativa
        // e a action especificada estiver no vetor de actions protegidos
        return !$hasSession && in_array($action, ['new', 'edit', 'delete', 'index']);
    }

    // Método responsável por atualizar uma notícia. Precisa de um id como parâmetro
    public function actionEdit($id) {
        
        $news = new News($this); // Cria um novo objeto do modelo
        
        if($news->findByPk($id)) {

            // Carrega os dados do formulário, caso existam
            if($_POST != []) {
                $news->loadRawData();
            }
            // Tenta atualizar os dados do modelo passando por uma validação
            if($news->save()) {
                // Adiciona uma mensagem para o usuário
                $this->addMessage('Notícia atualizada com sucesso.');
                // renderiza para action padrão e termina a execução
                // da action atual
                $this->actionIndex();die;
            }
            // renderiza a própria action com o mesmo model
            $this->render('edit', $news);    
        }
        else {
            // Não encontrou nenhum registro com o id especificado
            header('HTTP/1.0 404 Not Found');
            exit(1);
        }
    }
    
    // Método responsável por deletar uma notícia do BD. Recebe um id de parâmetro
    public function actionDelete($id) {
        $news = new News($this); // Cria um novo objeto do modelo
        
        // Faz uma consulta no BD usando o id 
        if($news->findByPk($id)) {
            
            // Somente se o $_POST estiver preenchido e o botão submit com name _DELETE_ 
            // for acionado
            if($_POST != [] && isset($_POST['_DELETE_'])) {
                // Se o delete der certo
                if($news->deleteByPk($id)) {
                    // Adiciona uma mensagem para o usuário
                    $this->addMessage('Notícia excluída com sucesso.');
                    // renderiza para action padrão e termina a execução
                    // da action atual
                    $this->actionIndex();die;
                }
            }
            else if($_POST != []) {
                // Esta linha será alterada quando a listagem de usuários
                // estiver pronta
                header('Location: ?news');
            }
            // renderiza a própria action com o mesmo model
            $this->render('delete', $news);    
        }
        else {
            // Não encontrou nenhum registro com o id especificado
            header('HTTP/1.0 404 Not Found');
            exit(1);
        } 
    }

    // Action padrão do controller 
    public function actionIndex() {
        $news = new News($this); // cria um novo objeto do modelo

        $newsList = $news->find(); // faz uma busca no BD de todos os registros

        $this->render('index', $newsList, 'Lista de usuários'); // Renderiza uma view com os dados da busca
    }
}

?>
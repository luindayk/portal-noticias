<?php
/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/
require_once('classes/BaseController.php');
require_once('models/User.php');

/*
    Esta classe é responsável por fazer a mediação entre o model e as views.
*/
class UserController extends BaseController {
    
    public function actionNew() {
        
        $user = new User($this);    // Cria um novo objeto do modelo

        // Somente se o $_POST estiver preenchido
        if($_POST != []) {
            
            /* Carrega os dados em estado bruto de $_POST para
               os atributos do modelo recém-criado */
            $user->loadRawData();
            /* Tenta salvar os dados do modelo para o banco de
             * dados, passando antes pela validação
             */
            
            if($user->save()) {
                // Adiciona uma mensagem para o usuário
                $this->addMessage('Usuário inserido com sucesso.');                
                // renderiza para action padrão e termina a execução
                // da action atual
                $this->actionIndex();die;
            }
        }
        // renderiza a própria action com o mesmo model
        $this->render('new', $user);
    }

    public function requireLogin($action){
        $hasSession = isset($_SESSION['user_id']);
        //var_dump($action);

        // Será necessária a autenticação quando não houver sessão ativa
        // e a action especificada estiver no vetor de actions protegidos
        return !$hasSession && in_array($action, ['actionNew', 'actionEdit', 'actionDelete', 'actionIndex']);
    }
    
    // Método responsável por atualizar uma notícia. Precisa de um id como parâmetro
    public function actionEdit($id) {
        
        $user = new User($this); // Cria um novo objeto do modelo
        
        if($user->findByPk($id)) {
            
            // Carrega os dados do formulário, caso existam
            if($_POST != []) {
                $user->loadRawData();
            }
            // Tenta atualizar os dados do modelo passando por uma validação
            if($user->save()) {
                // Adiciona uma mensagem para o usuário
                $this->addMessage('Usuário atualizado com sucesso.');
                // renderiza para action padrão e termina a execução
                // da action atual
                $this->actionIndex();die;                
            }
            // renderiza a própria action com o mesmo model
            $this->render('edit', $user);    
            
        }
        else {
            // Não encontrou nenhum registro com o id especificado
            header('HTTP/1.0 404 Not Found');
            exit(1);
        }
    }
    
    // Método responsável por deletar uma notícia do BD. Recebe um id de parâmetro
    public function actionDelete($id) {
        $user = new User($this); // Cria um novo objeto do modelo
        // Faz uma consulta no BD usando o id 
        if($user->findByPk($id)) {
            // Somente se o $_POST estiver preenchido e o botão submit com name _DELETE_ 
            // for acionado
            if($_POST != [] && isset($_POST['_DELETE_'])) {
                // Se o delete der certo
                if($user->deleteByPk($id)) {
                    // Adiciona uma mensagem para o usuário
                    $this->addMessage('Usuário excluído com sucesso.');
                    // renderiza para action padrão 
                    $this->actionIndex();
                }
            }
            else if($_POST != []) {
                // Esta linha será alterada quando a listagem de usuários
                // estiver pronta
                header('Location: ?user');
            }
            else{
                // renderiza a própria action com o mesmo model            
                $this->render('delete', $user);
            }    
        }
        else {
            // Não encontrou nenhum registro com o id especificado
            header('HTTP/1.0 404 Not Found');
            exit(1);
        } 
    }

    // Action padrão do controller
    public function actionIndex() {

        $user = new User($this); // cria um novo objeto do modelo

        $userList = $user->find(); // faz uma busca no BD de todos os registros

        $this->render('index', $userList); // Renderiza uma view com os dados da busca
    }
}
?>
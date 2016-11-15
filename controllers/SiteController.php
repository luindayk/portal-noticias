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
    require_once('classes/BaseModel.php');
    require_once('models/Login.php');
    
    /*
        Esta classe é responsável por fazer a mediação entre o model e as views.
    */
    class SiteController extends BaseController {
        // Action padrão do controller
        public function actionIndex() {
            $news = new News($this); // cria um novo objeto do modelo
            $newsList = $news->find(null, 'creation_time desc', 10); // faz uma busca no BD
            $this->render('index', $newsList); // Renderiza uma view com os dados da busca
        }
        
        public function actionTeste() {
            echo 'Isto é um teste';
        }

        public function requireLogin($action) {

            // As actions deste controller nunca precisam de autenticação
            return false;
        }

        public function actionLogin() {

            // criar uma instância do modelo login
            $login = new Login($this);
            
            // Verificar se dados foram digitados
            if($_POST != []){
                
                $login->loadRawData();

                // Invoca a validação de dados
                if($login->validateData()) {
                    $this->addMessage('Autenticação efetuada com sucesso.');
                    $login = new Login($this);
                }
                // Redirecionar para a rota desejada                
            }

            $this->render('login', $login);
        }
        
    }

?>
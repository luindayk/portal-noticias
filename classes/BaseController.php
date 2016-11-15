<?php
/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/
    
    /*
        Esta classe é responsável por configurar os nomes dos controllers e
        saber redirecionar corretamente as views
    */
    abstract class BaseController {

        private $_app; // Variável usada para saber qual controller está sendo usado
        
        /*
            Este método é responsável por configurar o nome do diretório de onde
            estão as views. Ela pega o nome do controller e (SiteController) transforma
            apenas no nome do diretório da view (site).
        */
        public function getControllerName() {
            return strtolower(str_replace('Controller', '', get_class($this)));
        }
        
        /*
            Este método é responsável por renderizar uma view. Ela recebe como parâmetros o nome
            de uma view e o conteúdo da view. 
        */
        public function render($view, $model) {
            $viewFilename = "views/{$this->getControllerName()}/$view.php";
            
            if(is_file($viewFilename)) {
                require_once($viewFilename);
            }
            else {
                throw new Exception("Arquivo de visualização '$viewFilename' não encontrado.");
            }
        }

        abstract function requireLogin($action);
        
        private $_messages = []; // array para mensagens
        
        /*
            Este método é responsável por verificar se contém alguma mensagem para exibição.
        */
        protected function hasMessages() {
            return count($this->_messages) > 0;
        }
        
        /*
            Este método é responsável por capturar a mensagem que foi digitada no controller.
        */
        protected function getMessages($clear = false) {
            $m = $this->_messages;
            if($clear) $this->_messages = [];
            return $m;
        }
        
        /*
            Este método é responsável por adicionar ao vetor uma mensagem.
        */
        protected function addMessage($message) {
            $this->_messages[] = $message;
        }
        
        /*
            Este método é o construtor da classe e recebe como parâmetro o nome da
            aplicação
        */
        public function __construct($app) {
            $this->_app = $app;    
        }
        
        /*
            Este método é responsável por retornar o nome da aplicação que está sendo usada.
        */
        public function getApp() {
            return $this->_app;
        }
        
    }

?>
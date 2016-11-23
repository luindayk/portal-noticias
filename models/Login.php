<?php 

require_once("classes/BaseModel.php");

class Login extends BaseModel {
    
    protected function initAttributes() {        
        $this->addAttribute('username', DataType::STRING, 'Usuário', 20);
        $this->addAttribute('password', DataType::STRING, 'Senha', 32);
    }

    protected function getTableName() {
        return 'tb_user';
    }
    // Este método recupera o id da tabela no BD
    protected function getPkName() {
        return 'user_id';
    }

    protected function getUserFromDb($username, $password) {
        $db = $this->getController()->getApp()->getDb();
        $password_salt = $this->getController()->getApp()->getParam('password_salt');

        $password_hash = md5($password_salt . $password);

        $cmd = $db->prepare(
            'select * from tb_user where username = :username and password_hash = :password_hash;'
        );
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 20);
        $cmd->bindParam(':password_hash', $password_hash, PDO::PARAM_STR, 32);
        $cmd->execute();

        // fetch() chama a próxima linha do resultado
        $result = $cmd->fetch(PDO::FETCH_ASSOC);

        // Se houver encontrado o usuário
        if($result) {
            // Guarda o id do usuário em uma variável de sessão
            $_SESSION['user_id'] = $result['user_id']; 
        }

        return $result;
    }

    public function validateData() {
       
       $this->clearErrors();
        // Username vazio
        if(trim($this->getAttrValue('username')) == '') {
            $this->setError('username', "O nome de usuário não pode ser vazio");
            
        }
        
        if(trim($this->getAttrValue('password')) == '') {
            $this->setError('password', 'Informe a senha.');
        }
                
        if(!$this->hasErrors()) {
            if(!$this->getUserFromDb($this->getAttrValue('username'), $this->getAttrValue('password'))) {
                $this->setError('password', 'Usuário ou senha inválidos');
            }
        }

        //$this->setAttrValue('password_hash', md5($password_salt . $this->getAttrValue('password')));
        
        return !$this->hasErrors();
        
    }
}
?>
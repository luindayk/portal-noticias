<?php //namespace FatecFranca\ADS8N;
/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/
require_once("classes/BaseModel.php");
/*
    Esta classe representa o model das notícias, ou seja, a regra de negócio 
    para as notícias
*/
class User extends BaseModel {
    // Este método inicializa o model. É o espelho da tabela do BD
    protected function initAttributes() {
        $this->addAttribute('user_id', DataType::INTEGER, 'Cód. Usuário');
        $this->addAttribute('firstname', DataType::STRING, 'Nome', 30);
        $this->addAttribute('lastname', DataType::STRING, 'Sobrenome', 30);
        $this->addAttribute('username', DataType::STRING, 'Usuário', 20);
        $this->addAttribute('password_hash', DataType::STRING, 'Hash da senha', 32);
        $this->addAttribute('password', DataType::VIRTUAL, 'Senha');
        $this->addAttribute('password2', DataType::VIRTUAL, 'Redigite a senha');
    }
    // Este método recupera o nome da tabela no BD
    protected function getTableName() {
        return 'tb_user';
    }
    // Este método recupera o id da tabela no BD
    protected function getPkName() {
        return 'user_id';
    }
    // Este método é responsável por verificar e validar os dados digitados pelo usuário
    // no formulário
    protected function validateData() {
       
       $this->clearErrors();
        
        // Firstname vazio
        if(trim($this->getAttrValue('firstname')) == '') {
            $this->setError('firstname', "O primeiro nome não pode ser vazio");
           
        }
        
        // Lastname vazio
        if(trim($this->getAttrValue('lastname')) == '') {
            $this->setError('lastname', "O sobrenome não pode ser vazio");
            
        }
        
        // Username vazio
        if(trim($this->getAttrValue('username')) == '') {
            $this->setError('username', "O nome de usuário não pode ser vazio");
            
        }
        
        // Username deve ter até 20 caracteres, deve começar com uma
        // letra e, nas demais posições, pode ter letras, dígitos ou sublinhado
        if(! preg_match('/^[a-zA-Z][a-zA-Z0-9_]{0,19}$/', $this->getAttrValue('username'))) {
            $this->setError('username', "O nome de usuário deve ter até 20 caracteres, começando uma
                letra e, nas demais posições, pode ter letras, dígitos ou sublinhado");
            
        }
        
        if(trim($this->getAttrValue('password')) == '') {
            $this->setError('password', 'Informe a senha.');
        }
        
        if(trim($this->getAttrValue('password2')) == '') {
            $this->setError('password2', 'Redigite a senha.');
        }
        
        if($this->getAttrValue('password2') != $this->getAttrValue('password')) {
            $this->setError('password2', 'As duas senhas digitadas não coincidem.');
        }
        
        // Ajusta o valor do atributo password_hash
        $password_salt = $this->getController()->getApp()->getParam('password_salt');
        
        $this->setAttrValue('password_hash', md5($password_salt . $this->getAttrValue('password')));
        
        return !$this->hasErrors();
        
    }

}

?>
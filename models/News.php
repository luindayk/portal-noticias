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
class News extends BaseModel {
    // Este método inicializa o model. É o espelho da tabela do BD
    protected function initAttributes() {
        $this->addAttribute('news_id', DataType::INTEGER, 'Cód. Notícia');
        $this->addAttribute('title', DataType::STRING, 'Manchete', 200);
        $this->addAttribute('creation_time', DataType::DATE_TIME, 'Data/Hora');
        $this->addAttribute('body', DataType::STRING, 'Corpo da notícia');
        $this->addAttribute('user_id', DataType::INTEGER, 'Cód. Usuário');
    }

    // Este método recupera o nome da tabela no BD
    protected function getTableName() {
        return 'tb_news';
    }

    // Este método recupera o id da tabela no BD
    protected function getPkName() {
        return 'news_id';
    }
    
    // Este método é responsável por verificar e validar os dados digitados pelo usuário
    // no formulário
    protected function validateData() {
        // limpa as mensagens de erro se houver
        $this->clearErrors();

        // Título não pode ser vazio
        if(trim($this->getAttrValue('title')) == '') {
            $this->setError('title', "O título não pode estar vazio.");
        }

        // Id do usuário preenchido (Esta validação ainda será reformulada)
        if(trim($this->getAttrValue('user_id')) == '') {
            $this->setError('user_id', "Este campo é obrigatório.");
        }

        // O corpo da notícia não pode ser vazio
        if(trim($this->getAttrValue('body')) == '') {
            $this->setError('body', "O corpo da notícia não pode estar vazio.");
        }

        // Retorna as mensagens de erro se houver
        return !$this->hasErrors();
    }
}

?>
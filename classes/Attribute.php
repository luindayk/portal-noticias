<?php //namespace FatecFranca\ADS8N;
/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/

/* 
    Este arquivo é para ser usado com as tabelas do BD. 
    De modo geral, é uma configuração para as tabelas do BD, sabendo que todas 
    contém atributos, tipos, limite de tamanho, etc.
*/

/* 
    Esta classe é para validação dos atributos das tabelas do BD
*/
class DataType /* extends SplEnum */ {
    const VIRTUAL = -1;     // Atributo que só existe no modelo lógico
    const INTEGER = 0;
    const STRING = 1;
    const DATE_TIME = 2;
}

class Attribute {

    private $_name; // nome do campo
    private $_dataType; // nome do tipo
    private $_length; // tamanho limite do campo, caso necessário
    private $_label;  // nome dado ao campo pelo model
    private $_value; // valor do campo

    /*
        Construtor da classe Attribute, recebe como pârametros obrigatoriamente um nome,
        um tipo e uma label. Tamanho limite e valor saõ opcionais
    */
    public function __construct(
        string $name,
        /*DataType*/ $dataType,
        string $label,
        int $length = null,
        $value = null
    ) {
        $this->_name = $name; // atribuindo nome
        $this->_dataType = $dataType; // atribuindo tipo
        $this->_length = $length; // atribuindo tamanho limite
        $this->_label = $label; // atribuindo uma label
        $this->_value = $value; // atribuindo uma valor
    }
    
    /*
        Este método é responsável por atribuir um valor à variável $_value do escopo.
        É obrigatório o pârametro. 
    */
    public function setValue($value) {
        $this->_value = $value;
    }
    
    /*
        Este método é responsável por capturar um valor que está na variável $_value.
        Ele tem como retorno um valor.
    */
    public function getValue() {
        return $this->_value;
    }
    
    /*
        Este método é responsável por capturar um tipo que está na variável $_dataType.
        Ele tem como retorno um tipo.
    */
    public function getDataType() {
        return $this->_dataType;
    }
    
    /*
        Este método é responsável por capturar um nome que está na variável $_name.
        Ele tem como retorno um nome.
    */
    public function getName() {
        return $this->_name;
    }

}

?>
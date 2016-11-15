<?php //namespace FatecFranca\ADS8N;
/***********************************************************************
Faculdade de Tecnologia de Franca “Doutor Thomaz Novelino”
PRIMEIRO PROJETO DE TÓPICOS ESPECIAIS EM INFORMÁTICA - 2016/2
Autor(es):
 WILLYAN LUINDAYK MACHADO <willyanluindayk@gmail.com> - RA 1090481413036
 GABRIEL LIBONI <gabriel_liboni@outlook.com> - RA 1090481411016
****************************************************************************/
require_once('Attribute.php');

/*
    Esta classe é responsável por cuidar da regra de negócio da aplicação, ou seja,
    é nela que se faz acesso ao banco de dados, operações, etc. 
*/
abstract class BaseModel {

    private $_attributes = [];  // Vetor vazio
    private $_controller; // Controller
    private $_errors = []; // Mensagens de erros

    protected function addAttribute(
        $name,
        /*DataType*/ $dataType,
        $label,
        $length = null,
        $value = null
    ) {
        $attr = new Attribute($name, $dataType, $label, $length, $value);
        $this->_attributes[$name] = $attr; //Adiciona o atributo ao vetor
    }

    abstract protected function initAttributes(); // Inicialização dos atributos da tabela do BD
    abstract protected function getTableName(); // Nome da tabela
    abstract protected function getPkName();    // Nome do campo chave primária
    abstract protected function validateData(); // Validação de dados do formulário

    /*
        Este é o construtor da classe. Recebe como parâmetro um controller e atribui à uma variável.
        Inicializa também os atributos de uma tabela do BD que foi estabelecida no model.
    */
    public function __construct($controller) {
        $this->initAttributes();
        $this->_controller = $controller;
    }
    
    /*
        Este método é responsável por retornar o controller que está sendo usado no momento.
    */
    public function getController() {
        return $this->_controller;
    }
    
    /*
        Este método é responsável por atribuir valores aos atributos da tabela do BD.
        Ele usa como parâmetros o nome do atributo e o valor que será dado a ele.     
    */
    public function setAttrValue(string $attrName, $value) {
        //echo '***************', $attrName, '<br />';
        if(key_exists($attrName, $this->_attributes)) {
            $this->_attributes[$attrName]->setValue($value);
        }
    }
    
    /*
        Este método é responsável por capturar um valor que está armazenado em um atributo. 
    */
    public function getAttrValue(string $attrName) {
        if(key_exists($attrName, $this->_attributes)) {
            return $this->_attributes[$attrName]->getValue();
        }
        else {
            return NULL;
        }
    }
    
    /*
     * Procura um registro no BD por chave primária
     */
    public function findByPk($pkValue) {
        // Obtendo uma nova conexão ao BD
        $db = $this->getController()->getApp()->getDb();
        // String para seleção de dados
        $rows = $db->query("select * from {$this->getTableName()} where
        {$this->getPkName()} = '{$pkValue}'");
        
        // Variável para controlar se o método vai executar.
        // Inicia com valor booleano 'false'
        $found = false;
        
        // Se a seleção obteve dados, preenche os atributos e torna a variável
        // de controle 'true'.
        if($rows) {
            foreach($rows as $row) {
                //var_dump($row);
                $fieldNames = array_keys($row);
                //var_dump($fieldNames);
                foreach($fieldNames as $fn) {
                    $this->setAttrValue($fn, $row[$fn]);
                }
                
                $found = true;
            }
        }
        return $found;
    }
    
    /*
        Este método é responsável por procurar vários registros no BD.
        Ele recebe como parâmetros até três tipos de filtros. 
    */
    public function find($where = null, $orderBy = null, $limit = null) {
        // Conexão com o BD
        $db = $this->getController()->getApp()->getDb();
        // Inicio da string de busca no BD, começando pelo nome da tabela
        $sql = "select * from {$this->getTableName()}";
        
        // verificando se o parâmetro foi preenchido
        if(isset($where)) {
            // concatenando à string
            $sql .= ' where ' . $where;
        }

        // verificando se o parâmetro foi preenchido
        if(isset($orderBy)) {
            // concatenando à string
            $sql .= ' order by ' . $orderBy;
        }

        // verificando se o parâmetro foi preenchido
        if(isset($limit)) {
            // concatenando à string
            $sql .= ' limit ' . $limit;
        }
        
        // Executando a busca no BD
        $rows = $db->query($sql);
        
        // Não encontrou nenhum registro
        if(! $rows) {
            return null;
        }
        
        // Se encontrou registros
        $instances = []; // Vetor vazio
        
        // Obtém o nome real da classe do modelo
        $className = get_class($this);
        
        foreach($rows as $row) {
            
            // Cria uma nova instância do modelo
            $instance = new $className($this->getController());
            
            // Preenche os valores dos atributos da nova instância
            // com os valores do registro correspondente no banco de dados
            $fieldNames = array_keys($row);
            foreach($fieldNames as $fn) {
                $instance->setAttrValue($fn, $row[$fn]);
            }
            
            // Adiciona a instância à coleção que será retornada
            $instances[] = $instance;
        }
        
        return $instances;
        
    }
    
    /*
        Este método é reponsável por salvar dados no BD
    */
    public function save($successMessage = null) {
        // Vaŕiavel de controle para saber se os dados digitados estão válidos
        $isValid = $this->validateData();

        // Se os dados estiverem válidos executa a inserção ou a atualização
        if($isValid) {
           
            // O valor da chave primária é nulo -> INSERT
            if($this->getAttrValue($this->getPkName()) == null) {
                return $this->insert();
            }
            else {
                return $this->update();
            }
            
        }
        return $isValid;
        
    }
    
    /*
        Este método é responsável pela atualização dos dados.
        Após uma seleção no BD ele preenche os campos do formulário
        para atualização. 
    */
    protected function update() {
        
        $fieldList = [];
        
        // Para cada um dos atributos do modelo
        foreach($this->_attributes as $attr) {
            
            if($attr->getDataType() != DataType::VIRTUAL) {
                
                $fieldname = $attr->getName();
                $value = $attr->getValue();
                
                if($value == null) {
                    $value = 'null';
                }
                else {
                    $value = "\"$value\""; // O valor entre aspas duplas
                }
                
                // campo = valor
                $fieldList[] = $fieldname . ' = ' . $value;
            }
            
        }        
        
        $setFields = implode(', ', $fieldList);
        
        $sql = "UPDATE {$this->getTableName()}
            SET $setFields
            WHERE {$this->getPkName()} = {$this->getAttrValue($this->getPkName())}";
            
        $db = $this->getController()->getApp()->getDb();
        
        return $db->exec($sql);            
        
    }
    
    // Este método é responsável por deletar um registro do BD
    public function deleteByPk($pk) {
        
        $sql = "DELETE FROM {$this->getTableName()}
            WHERE {$this->getPkName()} = $pk";
            
        $db = $this->getController()->getApp()->getDb();
        
        return $db->exec($sql);
        
    }
    
    /* Carrega dados em estado bruto da superglobal $_POST
     * para atributos homônimos do model
     */
    public function loadRawData() {
        foreach($_POST as $attrName => $attrValue) {
            $this->setAttrValue($attrName, $attrValue);
        }
    }
    
    // Este método é responsável por limpar as mensagens de erro
    protected function clearErrors() {
        $this->_errors = [];
    }
    
    // Este método é responsável por atribuir uma mensagem de erro
    public function setError($attrName, $message) {
        /* Se já existe uma mensagem de erro para o atributo,
         * adicionamos a nova mensagem de erro às já existentes
         */
        if(isset($this->_errors[$attrName])) {
            $this->_errors[$attrName] .= "<br />" . $message;
        }
        else {
            $this->_errors[$attrName] = $message;
        }
    }
    
    // Este método é reposnsável por capturar uma mensagem de erro existente
    protected function getError($attrName) {
        if(key_exists($attrName, $this->_errors)) {
            return $this->_errors[$attrName];
        }
        else {
            return NULL;
        }
    }
    
    // Este método é responsável por exibir os erros caso existam.
    // Ele recebe como parâmetro o atributo que será exibido o erro.
    public function displayErrors($attrName) {
        $error = $this->getError($attrName);
        
        if($error) {
            echo "<div style='color:red;font-size=85%'>$error</div>";
        }
    }
    
    // Este método é responsável por verificar se tem alguma mensagem de erro
    public function hasErrors() {
        return count($this->_errors) > 0;
    }
    
    /*
        Este método é responsável por realizar a inserção dos dados.
    */
    private function insert() {
            
        $fieldnames = [];
        $values = [];

        foreach($this->_attributes as $attr) {
            
            // echo $attr->getName(), " => ", $attr->getDataType(), "<br />";
            
            if($attr->getDataType() != DataType::VIRTUAL) {
                
                $fieldnames[] = $attr->getName();
                $value = $attr->getValue();
                
                if($value == null) {
                    $values[] = 'null';
                }
                else {
                    $values[] = "\"$value\""; // O valor entre aspas duplas
                }
            }
            
        }
        
        $sql = 'INSERT INTO ' . $this->getTableName() .
            '(' . implode(', ', $fieldnames) . ') VALUES (' .
                  implode(', ', $values) . ')';
            
        //echo "<pre>", $sql, "</pre>";
        $db = $this->getController()->getApp()->getDb();
        
        return $db->exec($sql);
    }

}

?>
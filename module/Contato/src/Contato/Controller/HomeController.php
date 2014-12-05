<?php
 
namespace Contato\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db;

class HomeController extends AbstractActionController
{
    public function indexAction()
    {
        /**
 * action index
 * @return ZendViewModelViewModel
 */
    /**
     * função anônima para var_dump estilizado
     */
    $myVarDump = function($nome_linha = "Nome da Linha", $data = null, $caracter = ' - ') {
                echo str_repeat($caracter, 100) . '<br/>' . ucwords($nome_linha) . '<pre><br/>';
                var_dump($data);
                echo '</pre>' . str_repeat($caracter, 100) . '<br/><br/>';
            };

    /**
     * conexão com banco
    $adapter = new Db\Adapter\Adapter(array(
        'driver'    => 'Pdo_Mysql',
        'database'  => 'agenda_contatos',
        'username'  => 'estudoZF',
        'password'  => 'estudozf'
    ));
 */
    $adapter = $this->getServiceLocator()->get('AdapterDb');
    /**
     * obter nome do sehema do nosso banco
     */
    $myVarDump(
            "Nome Schema", 
            $adapter->getCurrentSchema()
    );

    /**
     * contar quantidade de elementos da nossa tabela
     */
    $myVarDump(
            "Quantidade elementos tabela contatos", 
            $adapter->query("SELECT * FROM `contatos`")->execute()->count()
    );

    /**
     * montar objeto sql e executar
     */
    $sql        = new Db\Sql\Sql($adapter);
    $select     = $sql->select()->from('contatos');
    $statement  = $sql->prepareStatementForSqlObject($select);
    $resultsSql = $statement->execute();
    $myVarDump(
            "Objet Sql com Select executado",
            $resultsSql
    );

    /**
     * motar objeto resultset com objeto sql e mostrar resultado em array
     */
    $resultSet = new Db\ResultSet\ResultSet;
    $resultSet->initialize($resultsSql);
    $myVarDump(
            "Resultado do Objeto Sql para Array ",
            $resultSet->toArray()
    );
    die();
}
     /**   $texto = "Eu fui definido no controller, mas vou aparecer na view";
 
        return new ViewModel(array(
            'exemplo' => $texto,
        ));
    }*/
    public function sobreAction()
    {
        return new ViewModel();
    }
}
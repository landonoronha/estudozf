<?php
 
namespace Contato;
 
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Contato\View\Helper\MenuAtivo;
use Contato\View\Helper\Message;
// import ModelContato
use Contato\Model\Contato,
    Contato\Model\ContatoTable;

// import ZendDb
use Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;
 
class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
 
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
 
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    /**
 * Register Services
 */
public function getServiceConfig()
{
    return array(
        'factories' => array(
            'ContatoTableGateway' => function ($sm) {
                // obter adapter db atraves do service manager
                $adapter = $sm->get('Zend\Db\Adapter\Adapter');//AdapterDb');

                // configurar ResultSet com nosso model Contato
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Contato());

                // return TableGateway configurado para nosso model Contato
                return new TableGateway('contatos', $adapter, null, $resultSetPrototype);
            },
                'ModelContato' => function ($sm) {
                // return instacia Model ContatoTable
                return new ContatoTable($sm->get('ContatoTableGateway'));
            }
        )
    );
}
  /**
     * Register View Helper
     */
    
    
    public function getViewHelperConfig()
    {
        return array(
 
            'invokables' => array (
                    'formataCPF' => new View\Helper\FormataCPF()
 ),
                # registrar View Helper com injecao de dependecia
            # registrar View Helper com injecao de dependecia
            'factories' => array(
                'menuAtivo'  => function($sm) {
                    return new MenuAtivo($sm->getServiceLocator()->get('Request'));
                },
                'message' => function($sm) {
                return new Message($sm->getServiceLocator()->get('ControllerPluginManager')->get('flashmessenger'));
            },        
            ),
        );
    }
    
    }
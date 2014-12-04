<?php
 
namespace Contato;
 
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Contato\View\Helper\MenuAtivo;
use Contato\View\Helper\Message;
 
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
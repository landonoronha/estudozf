<?php
 
namespace Contato\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
 
class HomeController extends AbstractActionController
{
    public function indexAction()
    {
        $texto = "Eu fui definido no controller, mas vou aparecer na view";
 
        return new ViewModel(array(
            'exemplo' => $texto,
        ));
    }
}
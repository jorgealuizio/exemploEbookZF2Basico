<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Controlador que gerencia os posts
 *
 * @category Application
 * @package Controller
 * @author Elton Minetto <eminetto@coderockr.com>
 */
class PostController extends AbstractActionController
{
    /**
     * Mostra os posts cadastrados
     * @return void
     */
    public function indexAction()
    {
        $tableGateway = $this->getServiceLocator()->get('Application\Model\PostTableGateway');
        $posts = $tableGateway->fetchAll();
        return new ViewModel(array(
            'posts' => $posts
        ));
    }
}
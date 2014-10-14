<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Controlador que gerencia os comments
 *
 * @category Application
 * @package Controller
 * @author Elton Minetto <eminetto@coderockr.com>
 */
class CommentController extends AbstractActionController
{
    /**
     * Mostra os comments cadastrados
     * @return void
     */
    public function indexAction()
    {
        $tableGateway = $this->getServiceLocator()->get('Application\Model\CommentTableGateway');
        $comments = $tableGateway->fetchAll();
        return new ViewModel(array(
            'comments' => $comments
        ));
    }
}
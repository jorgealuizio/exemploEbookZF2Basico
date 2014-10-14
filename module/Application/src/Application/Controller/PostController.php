<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\Post as PostForm;
use Application\Model\Post as PostModel;

class PostController extends AbstractActionController
{
    private $tableGateway;

    private function getTableGateway()
    {
        if (!$this->tableGateway) {
            $this->tableGateway = $this->getServiceLocator()
                ->get('Application\Model\PostTableGateway');
        }
        return $this->tableGateway;
    }

    public function indexAction()
    {
        $tableGateway = $this->getTableGateway();
        $posts = $tableGateway->fetchAll();
        return new ViewModel(array(
            'posts' => $posts
        ));
    }

    public function saveAction()
    {
        $form = new PostForm();
        $tableGateway = $this->getTableGateway();
        $request = $this->getRequest();
        /* se a requisição é post os dados foram enviados via formulário*/
        if ($request->isPost()) {
            $post = new PostModel;
            /* configura a validação do formulário com os filtros e validators da entidade*/
            $form->setInputFilter($post->getInputFilter());
            /* preenche o formulário com os dados que o usuário digitou na tela*/
            $form->setData($request->getPost());
            /* faz a validação do formulário*/
            if ($form->isValid()) {
                /* pega os dados validados e filtrados */
                $data = $form->getData();
                /* armazena a data de inclusão do post*/
                $data['post_date'] = date('Y-m-d H:i:s');
                /* preenche os dados do objeto Post com os dados do formulário*/
                $post->exchangeArray($data);
                /* salva o novo post*/
                $tableGateway->save($post);
                /* redireciona para a página inicial que mostra todos os posts*/
                return $this->redirect()->toUrl('/post');
            }
        }
        /* essa é a forma de recuperar um parâmetro vindo da url como: http://iniciando-zf2.dev/post/save/1 */
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            /* busca a entidade no banco de dados*/
            $post = $tableGateway->get($id);
            /* preenche o formulário com os dados do banco de dados*/
            $form->bind($post);
            /* muda o texto do botão submit*/
            $form->get('submit')->setAttribute('value', 'Edit');
        }
        return new ViewModel(
            array('form' => $form)
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id == 0) {
            throw new \Exception("Código obrigatório");
        }
        $tableGateway = $this->getTableGateway()->delete($id);
        return $this->redirect()->toUrl('/post');
    }
}
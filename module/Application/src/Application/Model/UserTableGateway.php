<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTableGateway
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function get($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não encontrado id $id");
        }
        return $row;
    }

    public function save(User $user)
    {
        $data = array(
            'username' => $user->username,
            'password' => $user->password,
            'name' => $user->name,
            'valid' => $user->valid,
            'role' => $user->role,
        );

        $id = (int) $user->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->get($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Usuário não existe');
            }
        }
    }

    public function delete($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
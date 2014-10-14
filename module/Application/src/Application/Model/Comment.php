<?php

namespace Application\Model;

class Comment
{
    public $id;
    public $post_id;
    public $description;
    public $name;
    public $email;
    public $webpage;
    public $comment_date;

//usado pelo TableGateway
    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->post_id = (!empty($data['post_id'])) ? $data['post_id'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->webpage = (!empty($data['webpage'])) ? $data['webpage'] : null;
        $this->comment_date = (!empty($data['comment_date'])) ? $data['comment_date'] : null;
    }
}
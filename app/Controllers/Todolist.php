<?php

namespace App\Controllers;
use CodeIgniter\Controller;


class Todolist extends BaseController
{
    //db connection
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->Todos_Model = model('App\Models\Todos_Model');
    }

    //pages
    public function getTodos()
    {
        $pageData = $this->Todos_Model->getTodos();
        echo view('index', ['pageData' => $pageData]);
        
        return $pageData;
    }

    //functions
    public function insertTodos()
    {
        $postData = $this->request->getVar();
        
        $pageData = $this->Todos_Model->insertTodos($postData);
    }

    public function updateTodos(){
        $postData = $this->request->getVar();

        $pageData = $this->Todos_Model->updateTodos($postData);
    }

    public function deleteTodos(){
        $postData = $this->request->getVar();

        $pageData = $this->Todos_Model->deleteTodos($postData);
    }
}

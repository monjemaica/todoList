<?php

namespace App\Models;

use CodeIgniter\Model;

class Todos_Model extends Model
{
    public function getTodos()
    {
        $sql = "SELECT * FROM todos WHERE is_deleted = 0";
        $query = $this->db->query($sql);
        $results = $query->getResultArray();

        foreach ($results as $res) {
            $data[] = [
                "id" => $res['id'],
                "title" => $res['title'],
                "description" => $res['description'],
                "is_done" => $res['is_done'],
                "date_created" => $res['date_created']
            ];
        }
        
        return $data;
    }

    public function insertTodos($postData)
    {
        $sql = "INSERT INTO todos (title) VALUES (?)";

        $add = $this->db->query($sql, [ $postData['title']]);
    }

    public function updateTodos($postData)
    {
        $sql = "UPDATE todos SET is_done = ? WHERE id = ?";

        $update = $this->db->query($sql, [ 
            $postData['is_checked'],
            $postData['id']
        ]);
    }

    public function deleteTodos($postData)
    {
        $sql = "UPDATE todos SET is_deleted = ? WHERE id = ?";

        $update = $this->db->query($sql, [ 
            $postData['is_deleted'],
            $postData['id']
        ]);
    }



}

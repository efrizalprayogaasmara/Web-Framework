<?php

namespace App\Models;

use CodeIgniter\Model;

class DataClient extends Model
{
    protected $table = 'dataclient'; // Ensure this matches your table name
    protected $primaryKey = 'id'; // Assuming 'id' is the primary key
    protected $allowedFields = ['name', 'email', 'messages']; // Define allowed fields

    // Method to fetch all data, ordered by id in descending order
    public function getdata()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }

    // Method to insert data into the table
    public function send($data)
    {
        $this->db->table($this->table)->insert($data);
    
        return true;
    }
    
}

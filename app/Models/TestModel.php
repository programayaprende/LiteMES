<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class TestModel extends Model
{
    protected $table = 'testing';    
    protected $primaryKey  = 'user_name';
    protected $returnType     = 'array';
    protected $allowedFields = ['user_name','first_name','last_name',];
    //protected $beforeInsert = ['beforeInsert'];
    //protected $beforeUpdate = ['beforeUpdate'];

    /*
    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data){
        //if(!isset())

        return $data;
    }
    */
}
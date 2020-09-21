<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class UserModel extends Model
{
    protected $table = 'ma_users';
    protected $primaryKey = 'user_name';                    
    protected $allowedFields = [
        'user_name',
        'email',
        'first_name',
        'last_name',
        'password',
        'locked',
        'approved',
        'last_login',
        'login_attempts',
        'created_at',
        'updated_at',
        'job_description',
        'contact_phone',        
    ];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    
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
    
}
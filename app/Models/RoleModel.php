<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class RoleModel extends Model
{
    protected $table = 'ma_roles';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}
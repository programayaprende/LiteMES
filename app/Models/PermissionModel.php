<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class PermissionModel extends Model
{
    protected $table = 'ma_permissions';
    protected $primaryKey = 'id';                    
    protected $allowedFields = [
        'description_location',        
    ];   
    
}
<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class PermitModel extends Model
{
    protected $table = 'ma_permits';
    protected $primaryKey = 'id';                    
    protected $allowedFields = [
        'description_location',        
    ];   
    
}
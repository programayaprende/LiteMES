<?php

namespace App\Validation;
use App\Models\UserModel;

class UserRules{

    public function validateUser(string $str, string $fields, array $data){
        $model = new UserModel();

        $user = $model->where('email',$data['email'])
        ->first();

        if(!$user){
            return false;
        }

        /*
        if(md5($data['password']) != $user['password']){
            return false;
        }
        */
        if($data['password'] != $user['password']){
            return false;
        }

        return true;
    }
}
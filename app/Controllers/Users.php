<?php namespace App\Controllers;

class Users extends SecureController{

    public function index(){
        $data = [];
        $data['page_title']= "Dashboard";
        
        echo view("templates/header",$data);
        echo view("users/user_form",$data);
        echo view("templates/footer",$data);

    }
}
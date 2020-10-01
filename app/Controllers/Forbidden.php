<?php namespace App\Controllers;

class Forbidden extends SecureController{

    public function index(){
        $data = [];
        $data['page_title']= "Forbidden";
        
        echo view("templates/header",$data);
        echo view("templates/forbidden",$data);
        echo view("templates/footer",$data);

    }
}
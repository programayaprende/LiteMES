<?php namespace App\Controllers;

class Dashboard extends SecureController{

    public function index(){
        $data = [];
        $data['page_title']= "Dashboard";
        
        echo view("templates/header",$data);
        echo view("dashboard",$data);
        echo view("templates/footer",$data);

    }
}
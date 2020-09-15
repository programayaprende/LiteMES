<?php namespace App\Controllers;

class Dashboard extends SecureController{

    public function index(){
        $data = [];
        
        echo view("dashboard",$data);
    }
}
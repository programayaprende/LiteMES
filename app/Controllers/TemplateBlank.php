<?php namespace App\Controllers;

class TemplateBlank extends SecureController{

    public function index(){
        $data = [];

        $data['page_title'] = "Page Title";

        echo view("templates/header",$data);
        echo view("templates/templateblank",$data);
        echo view("templates/footer",$data);
    }
}
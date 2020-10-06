<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Approvals extends SecureController{

    use ResponseTrait;

    public function index(){
        header("Location: ".base_url("/Approvals/List"));
		die();
    }

    public function List(){
        $data = [];
        $data['page_title']= "Query Roles";

        $data['js_files'][] = '<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>';        
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/role/role-list.js"></script>';
       
        echo view("templates/header",$data);
        
        echo view("templates/footer",$data);
    }

    public function New(){      
                
        //Informacion para el desplegado de la pagina
        $data['page_title']= "Approvals | New";
        $data['style_files'][] = '';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "new"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/approvals/inbox.js"></script>';
        
        echo view("templates/header",$data);
        echo view("approvals/approvals_inbox",$data);
        echo view("templates/footer",$data);

    }
}
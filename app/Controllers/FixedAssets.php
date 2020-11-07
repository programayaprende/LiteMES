<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class FixedAssets extends SecureController{
    
    public function index(){
        header("Location: ".base_url("/FixedAssets/List"));
		die();
    }

    public function List(){
        $data = [];
        $data['page_title']= "Query Fixed Assets";

        $data['js_files'][] = '<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>';                
        $data['js_files'][] = '<script src="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.js"></script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/fixed-assets/fixed-assets-list.js"></script>';

        echo view("templates/header",$data);
        echo view("fixed_assets/fixed_assets_list.php",$data);
        echo view("templates/footer",$data);
    }

    public function GetFixedAssets(){
        
        $db = db_connect();

        $json = [];

        try {

            $start = $_POST['start'] ? $_POST['start'] : 0;
            $length = $_POST['length'] ? $_POST['length'] : 10;

            $select = "
                select 
                    SQL_CALC_FOUND_ROWS a.*
                from ma_fixed_assets a left join ma_users b on a.updated_by = b.user_name 
                where                     
                    a.fixed_assets_status not in ('Deleted')                    
                limit ".$start." , ".$length;
            
            $query = $db->query($select);

            $data = [];

            foreach($query->getResultArray() as $row){
                $data[] = $row;
            }

            //Calcular el total de registros
            $select = "SELECT FOUND_ROWS() as found_rows;";            
            $query = $db->query($select);
            $found_rows_result = $query->getRowArray();
            $recordsTotal = $found_rows_result['found_rows'];


            $json['start'] = $start;
            $json['length'] = $length;
            $json['recordsTotal'] = $recordsTotal;
            $json['recordsFiltered'] = $recordsTotal;
            $json['data'] = $data;

            return $this->respond($json, 200);

        } catch(Exceptions $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error getting fixed assets list";
            $json['error']=1;
            return $this->respond($json, 500);
        }

    }

    public function New(){
        $db = db_connect();

        $json = [];
        $json['error']=0;
        
        //Si no envio por post rechazar la solicitud
        if($this->request->getMethod()!="post"){                
            $json['message'] = "Invalid method";
            $json['error']=1;
            return $this->respond($json, 500);
        }

        try {

            helper(['form']);
            
            $rules = [
                'description' => 'required|min_length[3]|max_length[150]',
                'part_number' =>  'required|min_length[3]|max_length[25]',
                'brand' =>  'required|min_length[3]|max_length[25]',                
                'model' =>  'required|min_length[3]|max_length[25]',
                'serial_no' =>  'required|min_length[3]|max_length[30]',
                'import_petition' => 'min_length[3]|max_length[50]',                
                'tariff_heading' => 'min_length[1]|max_length[3]',
                'key' => 'min_length[1]|max_length[15]',
            ];

            /*
            $errors = [
                'user_name' => [
                    'is_unique' => 'Username already exists'
                ]
            ];
            */

            if(!$this->validate($rules,$errors)){                
                $json['error'] = 1;
                $json['errors'] = $this->validator->getErrors();
                $json['lists_errors'] = $this->validator->listErrors();
            } else {
                //Save user in DB
                $user = new UserModel();

                $userData = [
                    "user_name" => $this->request->getVar('user_name'),
                    "first_name" => $this->request->getVar('first_name'),
                    "last_name" => $this->request->getVar('last_name'),
                    "job_description" => $this->request->getVar('job_description'),
                    "email" => $this->request->getVar('email'),
                    "password" => $this->request->getVar('password'),
                    "contact_phone" => $this->request->getVar('contact_phone'),
                ];
                
                $user->insert($userData);
                
                //Verify the insert
                $userInserted = $user->find($userData['user_name']);

                if(!$userInserted){
                    $json['error'] = 1;
                    $json['errors'] = array('user_name'=> 'Error Creating a new user');
                    $json['lists_errors'] = "<ul><li>Error creating a new user</li></ul>";
                } else {
                    $json['user_name'] = $userInserted['user_name'];
                    $json['message'] = "New user added succesfully";
                }
                
            }   



        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error saving new fixed assets";
            $json['error']=1;
            return $this->respond($json, 500);
        }
    }


}

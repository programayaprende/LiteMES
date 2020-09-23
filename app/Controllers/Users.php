<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\TestModel;

class Users extends SecureController{

    use ResponseTrait;

    public function index(){
        $data = [];
        $data['page_title']= "Users";

        $data['js_files'][] = '<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/user/list-datatable.js"></script>';

        echo view("templates/header",$data);
        echo view("users/user_list.php",$data);
        echo view("templates/footer",$data);
        
    }

    public function GetUsers(){
        
        $model = new UserModel();
        
        $data = $alldata = $model->findAll();

        //Datos enviados por DataTable
        $datatable = array_merge(array('pagination' => array(), 'sort' => array(), 'query' => array()), $_REQUEST);

        // Se mando un filtro desde la cabecera del modulo
        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch']) ? $datatable['query']['generalSearch'] : '';
        if (!empty($filter)) {
        
            unset($datatable['query']['generalSearch']);
        }

        //$_REQUEST['query']['generalSearch'] es para la busqueda rapida de la cabecera de la pagina
        //$_REQUEST['pagination']['page'] page requerida
        //$_REQUEST['pagination']['pages'] total de pagina
        //$_REQUEST['pagination']['perpage'] rows por pagina
        //$_REQUEST['pagination']['total'] rows totales
        //$_REQUEST['sort']['field'] campo para sortear
        //$_REQUEST['sort']['sort'] orden del sorteo


        $result = array(
            'REQUEST' => $_REQUEST,
            'data' => $data
        );
        
        echo json_encode($result, JSON_PRETTY_PRINT);

    }

    public function GetUserData($user_name){
        
        if($this->request->getMethod()=="post"){
            
            $json['error'] = 0;

            if($_SERVER['CI_ENVIRONMENT']=="development"){
                $json['_POST'] = $_POST;
                $json['_FILES'] = $_FILES;
            }

            if(!$user_name){
                $json['error'] = 0;
                $json['errors'] = [
                    'user_name' => 'Please provide a valid user_name',
                ];
                $json['lists_errors'] = '<ul><li>'.'Please provide a valid user_name'.'</li></ul>';                
            } else {
                $user = new UserModel();                
                $userData = $user->find($user_name);                
                if(!$userData){
                    $json['error'] = 1;
                    $json['errors'] = [
                        'user_name' => 'Please provide a valid user_name',
                    ];
                    $json['lists_errors'] = '<ul><li>'.'Please provide a valid user_name'.'</li></ul>';
                } else {
                    unset($userData['password']);
                    $json['user_data'] = $userData;
                }
            }

            return $this->respond($json, 200);
        }
    }

    public function Edit($user_name){
        
        if($this->request->getMethod()=="post"){
            
            $json['error'] = 0;

            if($_SERVER['CI_ENVIRONMENT']=="development"){
                $json['_POST'] = $_POST;
                $json['_FILES'] = $_FILES;
            }

            //Revisar que se haya enviado el usario
            if(!$this->request->getVar('user_name')){
                $json['error'] = 1;
                $json['errors'] = [
                    'user_name' => 'Please provide a valid user_name',
                ];
                $json['lists_errors'] = '<ul><li>'.'Please provide a valid user_name'.'</li></ul>';                
            } else {
                $user = new UserModel();
                $userData = $user->find($this->request->getVar('user_name'));
                if(!$userData){
                    $json['error'] = 1;
                    $json['errors'] = [
                        'user_name' => 'Please provide a valid user_name',
                    ];
                    $json['lists_errors'] = '<ul><li>'.'Please provide a valid user_name'.'</li></ul>';
                } else {
                    
                    $rules = [
                        'first_name' => 'required|min_length[3]|max_length[20]',
                        'last_name' =>  'required|min_length[3]|max_length[20]',
                        'job_description' =>  'required|min_length[3]|max_length[20]',                
                        'email' =>  'required|min_length[6]|max_length[50]|valid_email|is_unique[ma_users.email,user_name,{user_name}]',
                    ];

                    if($this->request->getVar('password_new')){
                        $rules['password_new'] = 'required|min_length[8]|max_length[20]';
                        $rules['password_new_verify'] = 'matches[password_new]';
                    }

                    if(!$this->validate($rules)){                
                        $json['error'] = 1;
                        $json['errors'] = $this->validator->getErrors();
                        $json['lists_errors'] = $this->validator->listErrors();
                    } else {
                        
                        //Paso las validaciones
                        //Revisar que datos se pueden actualizar
                        $userNewData = [                            
                            "first_name" => $this->request->getVar('first_name'),
                            "last_name" => $this->request->getVar('last_name'),
                            "job_description" => $this->request->getVar('job_description'),
                            "email" => $this->request->getVar('email'),                            
                            "contact_phone" => $this->request->getVar('contact_phone'),
                        ];

                        //Si se envio un nuevo password agregarlo a los campos para actualizar
                        if($this->request->getVar('password_new')){
                            $userNewData['password'] = $this->request->getVar('password_new');
                        }
                    
                        //Actualizar el registro
                        $user->update($this->request->getVar('user_name'),$userNewData);
                        
                        //Mensaje de retorno y user_name actualizado
                        $json['user_name'] = $this->request->getVar('user_name');
                        $json['message'] = "User update succesfully";
                        
                    }
                }
            }

            return $this->respond($json, 200);
        }

        $data['page_title']= "Users | Edit ( ".$user_name." )";
        $data['style_files'][] = '<link href="'.base_url().'/assets/css/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "edit"; </script>';
        $data['js_files'][] = '<script> var REQUEST_USER_NAME = "'.$user_name.'"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/user/user-form.js"></script>';


        echo view("templates/header",$data);
        echo view("users/user_form",$data);
        echo view("templates/footer",$data);

    }

    public function New(){        
        
        //Intento de insert de un nuevo usuario
        if($this->request->getMethod()=="post"){
            
            if($_SERVER['CI_ENVIRONMENT']=="development"){
                $json['_POST'] = $_POST;
                $json['_FILES'] = $_FILES;
            }

            helper(['form']);

            $json['error'] = 0;
            
            $rules = [
                'first_name' => 'required|min_length[3]|max_length[20]',
                'last_name' =>  'required|min_length[3]|max_length[20]',
                'job_description' =>  'required|min_length[3]|max_length[20]',                
                'email' =>  'required|min_length[6]|max_length[50]|valid_email|is_unique[ma_users.email]',
                'password' =>  'required|min_length[8]|max_length[20]',
                'password_confirm' => 'matches[password]',
                'user_name' => 'required|min_length[3]|max_length[20]|is_unique[ma_users.user_name]',
            ];

            $errors = [
                'user_name' => [
                    'is_unique' => 'Username already exists'
                ]
            ];

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

            return $this->respond($json, 200);
        }

        //Informacion para el desplegado de la pagina
        $data['page_title']= "Users | New";        
        $data['style_files'][] = '<link href="'.base_url().'/assets/css/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "new"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/user/user-form.js"></script>';


        echo view("templates/header",$data);
        echo view("users/user_form",$data);
        echo view("templates/footer",$data);

    }
}
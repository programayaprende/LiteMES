<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Users extends SecureController{

    use ResponseTrait;

    public function index(){
        header("Location: ".base_url("/Users/List"));
		die();
    }

    public function List(){
        $data = [];
        $data['page_title']= "Query Users";

        $data['js_files'][] = '<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>';        
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/user/user-list.js"></script>';

        echo view("templates/header",$data);
        echo view("users/user_list.php",$data);
        echo view("templates/footer",$data);
    }

    public function Approve($user_name){

        $json['error'] = 0;
        $json['message'] = "";

        $userModel = new UserModel();
        $user = $userModel->find($user_name);

        if(!$user){
            $json['error'] = 1;
            $json['message'] = "User name not found";
        } else {
            
            $result = $userModel->update($user_name, ['approved'=>'1']);

            if($result){
                $json['message'] = "User account has been approved";
            } else {
                $json['message'] = "Error approving the user account, please try again later";
            }
        }

        return $this->respond($json, 200);
    }

    public function Lock($user_name){

        $json['error'] = 0;
        $json['message'] = "";

        $userModel = new UserModel();
        $user = $userModel->find($user_name);

        if(!$user){
            $json['error'] = 1;
            $json['message'] = "User name not found";
        } else {
            
            $result = $userModel->update($user_name, ['locked'=>'1']);

            if($result){
                $json['message'] = "User account has been lock";
            } else {
                $json['message'] = "Error locking the user account, please try again later";
            }
        }

        return $this->respond($json, 200);
    }

    public function Unlock($user_name){

        $json['error'] = 0;
        $json['message'] = "";

        $userModel = new UserModel();
        $user = $userModel->find($user_name);

        if(!$user){
            $json['error'] = 1;
            $json['message'] = "User name not found";
        } else {
            
            $result = $userModel->update($user_name, ['locked'=>'0']);

            if($result){
                $json['message'] = "User account has been unlock";
            } else {
                $json['message'] = "Error unlocking the user account, please try again later";
            }
        }

        return $this->respond($json, 200);
    }

    public function GetUsers(){
        
        $userModel = new UserModel();
        $extra = [];
        //$extra['header'] =  $this->request->getHeaderLine('X-Requested-With');
        //$extra['header'] =  $this->request->getHeaders();
        //$extra['segment'] = $this->request->uri->getSegments();
        
        $data = $alldata = $userModel->findAll();

        //Datos enviados por DataTable
        $datatable = array_merge(array('pagination' => array(), 'sort' => array(), 'query' => array()), $_REQUEST);

        //Inicializar el constructor del query
        $dataBuilder = $userModel->builder();
        $dataBuilder->select('user_name,email,first_name,last_name,locked,approved,last_login,date(created_at) as created_at,job_description,contact_phone');

        // Se mando un filtro desde la cabecera del modulo
        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch']) ? $datatable['query']['generalSearch'] : '';
        if (!empty($filter)) {
            $dataBuilder->orLike('user_name',$filter);
            $dataBuilder->orLike('first_name',$filter);
            $dataBuilder->orLike('last_name',$filter);            
            unset($datatable['query']['generalSearch']);
        } else {
            foreach($_REQUEST as $field=>$value){
                
                if(substr($field,0,7)!="filter_" or $value==""){
                    continue;
                }
                switch($field){
                    case "filter_registrationRange":                        
                        if(strlen($value)==23){                            
                            $startDate = substr($value,0,10);
                            $endDate = substr($value,13,10);
                            $dataBuilder->where('date(created_at) >=',$startDate);
                            $dataBuilder->where('date(created_at) <=',$endDate);
                        }                         
                        break;
                    case "filter_name":
                        $condition = "(first_name like '%".$value."%' or last_name like '%".$value."%')";
                        $dataBuilder->where($condition);
                        break;
                    case "filter_approved":
                        $dataBuilder->where('approved',$value);
                        break;
                    case "filter_locked":
                        $dataBuilder->where('locked',$value);
                        break;
                }
            }
        }

        //Revisar si se aplicaron filtros



        // Si se mandan filstros por columnas
        $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
        if (is_array($query)) {
            $query = array_filter($query);
            foreach ($query as $key => $val) {
                $dataBuilder->like($key,$val);
            }
        }

        //Checar si se mando info para el sort
        $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
        $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'user_name';

        //Aplicar el sort en el query
        $dataBuilder->orderBy($field, $sort);

        //Revisar que pagina quieren ver        
        $page = !empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
        //Revisar cuantos items por pagina
        $perpage = !empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $pages = 1;
        $total = $dataBuilder->countAllResults(false);

        if ($perpage > 0) {
            $pages = ceil($total / $perpage); // calculate total pages
            $page = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
            $page = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
            $offset = ($page - 1) * $perpage;
            if ($offset < 0) {
                $offset = 0;
            }                        
            $selectQuery = $dataBuilder->limit($perpage, $offset);
        }

        $selectQuery =  $dataBuilder->getCompiledSelect(false);

        $data = [];
        $data = $dataBuilder->get()->getResultArray();;

        $meta = array(
            'page' => $page,
            'pages' => $pages,
            'perpage' => $perpage,
            'total' => $total,
        );     

        $result = array(            
            'select' => $selectQuery, 
            'extra' => $extra,           
            'REQUEST' => $_REQUEST,            
            'meta' => $meta + array(
                'sort' => $sort,
                'field' => $field,
            ),
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
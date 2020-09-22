<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\TestModel;

class Users extends SecureController{

    use ResponseTrait;

    public function index(){
        $data = [];
        $data['page_title']= "Dashboard";
        
        echo view("templates/header",$data);
        //echo view("users/user_form",$data);
        echo view("templates/footer",$data);
        
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
                        'email' =>  'required|min_length[6]|max_length[50]|valid_email',
                    ];

                    if(!$this->validate($rules)){                
                        $json['error'] = 1;
                        $json['errors'] = $this->validator->getErrors();
                        $json['lists_errors'] = $this->validator->listErrors();
                    } else {
                                               
                        $userNewData = [                            
                            "first_name" => $this->request->getVar('first_name'),
                            "last_name" => $this->request->getVar('last_name'),
                            "job_description" => $this->request->getVar('job_description'),
                            "email" => $this->request->getVar('email'),                            
                            "contact_phone" => $this->request->getVar('contact_phone'),
                        ];
                    
                        //Paso la validacion
                        $user->update($this->request->getVar('user_name'),$userNewData);
                        
                        $json['user_name'] = $this->request->getVar('user_name');
                        $json['message'] = "New user added succesfully";
                        
                    }
                    
                    
                }
            }

            return $this->respond($json, 200);
        }

        $data['page_title']= "Users";        
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
        $data['page_title']= "Users";        
        $data['style_files'][] = '<link href="'.base_url().'/assets/css/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "new"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/user/user-form.js"></script>';


        echo view("templates/header",$data);
        echo view("users/user_form",$data);
        echo view("templates/footer",$data);

    }
}
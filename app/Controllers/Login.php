<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
    
    use ResponseTrait;
    
    public function index()
	{
        if(!session()->get('loc')){
            $temp_data['loc'] = "es";
            session()->set($temp_data);
        }
        
        if(session()->get('isLoggedIn')){
            header("Location: ".base_url('/Dashboard'));
            exit;
        }
        return view('login');
    }
    
    public function authenticating()
    {
        $data = [];

        $data['error'] = 0;

        helper(['form']);

        if($this->request->getMethod() == "post"){
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[50]|validateUser[email,password]',
            ];

            
            //Custom error messages
            $errors = [
                'password' => [
                    'validateUser' => 'Email or Password do not match'
                ]
            ];

            if(!$this->validate($rules,$errors)){
                $data['errors'] = $this->validator->listErrors();
                $data['error'] = 1;
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();
                $user = $model->where('email',$this->request->getVar('email'))
                        ->first();
                $this->createSession($user);
                
            }

            return $this->respond($data, 200);
        }
    }

    public function CloseSession(){
        if(session()->get('isLoggedIn')){
            $data['loc'] = session()->get('loc');
        } else {
            $data['loc'] = "en";
        }
        session()->destroy();
        session()->set($data);

        header("Location: ".base_url('/Login'));
        die();
    }

    private function createSession($user){
        $data = [
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'isLoggedIn' => true,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'loc' => session()->get('loc'),
        ];

        session()->set($data);
        return true;

    }

	//--------------------------------------------------------------------

}

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

    public function AddToPath(){
        
        $db = db_connect();

        $json['error'] = 0;
        $json['message'] = "";

        try {

            //Obtener el ID del approval y revisar que este en modo draft y que sea del usuario actual
            $select = "select * from md_approvals where approval_hash=? and drafter=? and status='Draft'";
            
            $query = $db->query($select,[$this->request->getVar('approval_hash'),session()->get('user_name')]);

            $approval = $query->getRowArray();

            if(!isset($approval)){
                $json['message'] = "Approval not found...";
                $json['error']=1;
                return $this->respond($json, 200);
            }            

            //Revisar que no exista el usuario ya en la ruta de aprobacion
            $select = "select count(user_name) as user_exists from md_approvals_users where id_approval=? and user_name=?";
            
            $query = $db->query($select,[$approval['id_approval'],$this->request->getVar('user_name')]);

            $result = $query->getRowArray();

            if($result['user_exists']>0){
                $json['message'] = "User already in the path";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            //Obtener el numero de secuencia            
            $select = "select count(user_name) as user_count from md_approvals_users where id_approval=?";
            
            $query = $db->query($select,[$approval['id_approval']]);

            $result = $query->getRowArray();

            $seq = $result['user_count'] + 1;

            //Insertar el usuario en la ruta de aprobacion
            $insert = "insert into md_approvals_users(id_approval,user_name,approval_type,status,seq)
            values (?,?,?,?,?)";
            
            $insert = $db->query($insert,[$approval['id_approval'],session()->get('user_name'),'Approval','-',$seq]);

            //Verificar que se inserto
            $select = "select count(user_name) as user_exists from md_approvals_users where id_approval=? and user_name=?";
            
            $query = $db->query($select,[$approval['id_approval'],$this->request->getVar('user_name')]);

            $result = $query->getRowArray();

            if($result['user_exists']==0){
                $json['message'] = "Error inserting new user";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            $json['message'] = "User successfully added to the approval path";
            return $this->respond($json, 200);
            

        } catch (Exception $e) {
            $json['message'] = "Error creating a new Approval";
            $json['error']=1;
            return $this->respond($json, 200);
        }
        
    }

    public function CreateDraft(){
        $db = db_connect();

        $json['error'] = 0;
        $json['message'] = "";

        try {
            $insert = "insert into md_approvals(drafter,status,created_at)
            values (?,'Draft',now())";
            $insert = $db->query($insert,[session()->get('user_name')]);
            
            $json['id_approval'] = $id_approval = $db->insertID();
            $json['approval_hash'] = $approval_hash = md5("approval_hash_".$id_approval);

            $update = "update md_approvals set approval_hash=? where id_approval = ?";
            $db->query($update,[$approval_hash,$id_approval]);
        } catch (Exception $e) {
            $json['message'] = "Error creating a new Approval";
            $json['error']=1;
            return $this->respond($json, 200);
        }
        

        return $this->respond($json, 200);

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
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
        $data['page_title']= "Approval";

        $data['js_files'][] = '<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>';        
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/role/role-list.js"></script>';
       
        echo view("templates/header",$data);
        
        echo view("templates/footer",$data);
    }

    public function Sent(){
        //Informacion para el desplegado de la pagina
        $data['page_title']= "Approvals | Sent";
        $data['style_files'][] = '';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "sent"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/approvals/inbox.js"></script>';
        
        echo view("templates/header",$data);
        echo view("approvals/approvals_inbox",$data);
        echo view("templates/footer",$data);
    }

    public function info(){
        echo phpinfo();
        return;
    }

    public function GetApprovals(){
        $db = db_connect();

        $json['error'] = 0;
        $json['message'] = "";

        $json['codition'] = $this->request->getVar('condition');
        $json['sort'] = $this->request->getVar('sort');
        

        try {

            //Contruir el query
            if($this->request->getVar('condition')=="sent"){                
                $select = "
                select 
                    a.*,
                    b.first_name,
                    b.last_name,
                    b.job_description 
                from md_approvals a left join ma_users b on a.drafter = b.user_name 
                where 
                    drafter = ".$db->escape(session()->get('user_name'))." 
                    and status not in ('Draft')
                order by submit_at ".$this->request->getVar("sort");
            }

            $page = (!isset($_POST['page'])) ? 1 : $_POST['page'];

            $json['page'] = $page;

            $perPage = 50;

            $offSet = 50 * ($page-1);

            $select .= " limit $offSet, $perPage";
            
            $query = $db->query($select);

            $rows = [];

            foreach($query->getResultArray() as $row){
                $row['submit_at_str'] = date("M d, Y h:i:s a",strtotime($row['submit_at']));
                $rows[] = $row;                
            }

            $json['rows'] = $rows;

            return $this->respond($json, 200);
        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error getting approvals list";
            $json['error']=1;
            return $this->respond($json, 200);
        }
    }

    public function UpdateActionRequest(){
        $db = db_connect();

        $json['error'] = 0;
        $json['message'] = "";

        try {

            //Revisar si el approval existe y esta en modo Draft            
            $select = "select * from md_approvals where approval_hash=? and drafter=? and status='Draft'";
            
            $query = $db->query($select,[$this->request->getVar('approval_hash'),session()->get('user_name')]);

            $approval = $query->getRowArray();

            if(!isset($approval)){
                $json['message'] = "Approval not found...";
                $json['error']=1;
                return $this->respond($json, 200);
            }  

            //Actualizar el approval row
            $update = "update md_approvals_users set approval_type=? where id_approval=? and seq=?";
            $query = $db->query($update,[
                $this->request->getVar('approval_type'),
                $approval['id_approval'],
                $this->request->getVar('seq'),
            ]) ;

            $json['message'] = "Successfully update";
            return $this->respond($json, 200);

        }catch(Exception $e){
            $json['message'] = "Error creating a new Approval";
            $json['error']=1;
            return $this->respond($json, 200);
        }
    }

    public function Send(){
        $db = db_connect();

        $json['error'] = 0;
        $json['message'] = "";

        if($_SERVER['CI_ENVIRONMENT']=="development"){
            $json['_POST'] = $_POST;            
        }

        try {           
            
            //Validaciones del formulario
            $rules = [
                'compose_subject' => 'required|min_length[3]|max_length[100]',
                'approval_hash' =>  'required|min_length[32]|max_length[32]',
                'messageText' =>  'required|min_length[10]',
            ];

            $errors = [
                'compose_subject' => [
                    'label' => 'Subject'
                ],
                'messageText' => [
                    'label' => 'Message'
                ],

            ];

            if(!$this->validate($rules,$errors)){                
                $json['errors'] = $this->validator->getErrors();
                $json['lists_errors'] = $this->validator->listErrors();
                $json['error']=1;
                return $this->respond($json, 200);    
            }

            //Revisar que el approval exista y este en modo Draft            
            $select = "select * from md_approvals where approval_hash=? and drafter=? and status='Draft'";
            
            $query = $db->query($select,[$this->request->getVar('approval_hash'),session()->get('user_name')]);

            $approval = $query->getRowArray();

            if(!isset($approval)){
                $json['errors'] = $json['message'] = "Approval not found...";                 
                $json['lists_errors'] = "<ul>".$json['errors']."</ul>";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            //Revisar que el path de aprobacion tenga minimo un usuario
            $select = "select count(*) as users_count from md_approvals_users where id_approval=?";
            $query = $db->query($select,[$approval['id_approval']]);

            $result = $query->getRowArray();
            
            if($result['users_count']==0){
                $json['errors'] = $json['message'] = "Please add users to the approval path";
                $json['lists_errors'] = "<ul>".$json['errors']."</ul>";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            //Paso las validaciones, cambiar el status del documento a Pending, guardar el subject y el body y submit_at
            $update = "update md_approvals set status='Pending', subject=?, body=?, submit_at = now() where id_approval=?";

            $query = $db->query($update,[
               $this->request->getVar("compose_subject"),
               $this->request->getVar("messageBody"),
               $approval['id_approval'],
            ]);

            if($db->affectedRows()==0){
                $json['errors'] = $json['message'] = "Error sending the approval";
                $json['lists_errors'] = "<ul>".$json['errors']."</ul>";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            $json['message'] = "Successfully send";            
            return $this->respond($json, 200);

        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error submitting the approval";
            $json['error']=1;
            return $this->respond($json, 200);
        }
    }

    public function RemoveFromPath(){
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

            $delete = "delete from md_approvals_users where id_approval=? and seq=?";
            $query = $db->query($delete,[
                $approval['id_approval'],
                $_POST['seq'],
            ]);

            $json['message'] = "User successfully removed";

            return $this->respond($json, 200);

        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error message";
            $json['error']=1;
            return $this->respond($json, 200);
        }
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

            //Traer los datos de usuario
            //Revisar que no exista el usuario ya en la ruta de aprobacion
            $select = "select * from ma_users where user_name=? limit 1";
            
            $query = $db->query($select,[$this->request->getVar('user_name')]);

            $user = $query->getRowArray();

            if(!isset($user)){
                $json['message'] = "User not found";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            //Obtener el numero de secuencia            
            $select = "select ifnull(max(seq),0) as max_seq from md_approvals_users where id_approval=?";
            
            $query = $db->query($select,[$approval['id_approval']]);

            $result = $query->getRowArray();

            $seq = $result['max_seq'] + 1;

            //Insertar el usuario en la ruta de aprobacion
            $insert = "insert into md_approvals_users(id_approval,user_name,approval_type,status,seq,first_name,last_name,job_description)
            values (?,?,?,?,?,?,?,?)";
            
            $insert = $db->query(
                $insert,
                [
                    $approval['id_approval'],
                    $this->request->getVar('user_name'),
                    $this->request->getVar('approval_type'),
                    '-',
                    $seq,
                    $user['first_name'],
                    $user['last_name'],
                    $user['job_description'],
                ]
            );

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
            $json['e'] = $e->getMessage();
            $json['message'] = "Error creating a new Approval";
            $json['error']=1;
            return $this->respond($json, 200);
        }
        
    }

    public function PreviewPath(){

        
        $json['message'] = "";
        $json['error']=0;

        try{
            $db = db_connect();

            $json['approval_hash'] = $approval_hash = $this->request->getVar('approval_hash');

            //Ver si el approval existe y estan en modo draft
            $select = "select * from md_approvals where approval_hash=? and status='Draft' limit 1";
            $query = $db->query($select,[$approval_hash]);
            $approval = $query->getRowArray();

            if(!isset($approval)){
                $json['error'] = 1;
                $json['message'] = "Approval not found or was submitted";
                return $this->respond($json, 200);    
            }

            //Como si existe el approval vamos a traer los usuarios ya en el listado
            $select = "
            select 
                a.*                
            from 
                md_approvals_users a
            where 
                id_approval = ? 
            order by seq";
            $query = $db->query($select,[$approval['id_approval']]);

            $json['steps'] = [];
            $json['steps_count'] = 0;

            foreach($query->getResultArray() as $row){
                $json['steps'][] = $row;
                $json['steps_count']++;
            }

            return $this->respond($json, 200);

        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error getting approval path preview";
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

    public function RemoveFile(){
        $json['error'] = 0;
        $json['message'] = "";

        $db = db_connect();

        try{
            //Revisar si el approval existe y esta en modo Draft
            $select = "select * from md_approvals where approval_hash=? and drafter=? and status='Draft'";
            
            $query = $db->query($select,[$this->request->getVar('approval_hash'),session()->get('user_name')]);

            $approval = $query->getRowArray();

            if(!isset($approval)){
                $json['message'] = "Approval not found...";
                $json['error']=1;
                return $this->respond($json, 500);
            }

            //Remover de la base de datos el archivo

            $delete = "delete from md_approvals_files where id_approval=? and file_name=?";
            $query = $db->query(
                $delete,
                [
                    $approval['id_approval'],
                    $this->request->getVar('file_name')
                ]
            );

            $json['message'] = "Successfully remove file from server";
            return $this->respond($json, 200);

        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error uploading the file";
            $json['error'] = 1;
            return $this->respond($json, 500);
        }
    }

    public function FileUpload(){
        $json['error'] = 0;
        $json['message'] = "";

        $db = db_connect();

        try{

            //Revisar si el approval existe y esta en modo Draft
            $select = "select * from md_approvals where approval_hash=? and drafter=? and status='Draft'";
            
            $query = $db->query($select,[$this->request->getVar('approval_hash'),session()->get('user_name')]);

            $approval = $query->getRowArray();

            if(!isset($approval)){
                $json['message'] = "Approval not found...";
                $json['error']=1;
                return $this->respond($json, 500);
            }

            //Revisar que el archivo se subio bien
            $file = $this->request->getFile('file');
                            
            if (! $file->isValid())
            {
                $json['error'] = "Invalid file...";
                $json['message'] = "Invalid file";
                return $this->respond($json, 500);
            }
    
            $name = $file->getName();
            $clientName = $file->getClientName();
            $tempName = $file->getTempName();
            $ext = $file->getClientExtension();
            $type = $file->getClientMimeType();
            $fileSize = 0;

            //Revisar que no exista el archivo ya en la tabla
            $select = "select * from md_approvals_files where id_approval=? and file_name=?";
            
            $query = $db->query($select,[$approval['id_approval'],$clientName]);

            $exists = $query->getRowArray();

            if(isset($exists)){
                $json['message'] = "File name already exists";
                $json['error']= "File name already exists";
                return $this->respond($json, 500);
            }             

            //Insertar en la tabla del modulo donde se guardan los archivos
            $insert = "
            insert into md_approvals_files(id_approval,file_name,file_type,file_size,upload_status)
            values (?,?,?,?,?)
            ";

            $query = $db->query($insert,[
                $approval['id_approval'],
                $clientName,
                $type,
                $fileSize,
                'NEW'
            ]);

            if(!$query){
                $json['error'] = "Error creating DB record";
                $json['message'] = "Error creating DB record";
                return $this->respond($json, 500);
            }

            $id_file = $db->insertID();

            if(!$id_file){
                $json['error'] = "Error getting file ID";
                $json['message'] = "Error getting file ID";
                return $this->respond($json, 500);
            }
    
            $sys_file_name = $id_file."_".$clientName;

            $year = date("Y");
            $month = date("m");


            $file->move(WRITEPATH.'uploads/approvals/'.$year.'/'.$month.'/'.$id_file,$sys_file_name);
            
            if(!file_exists(WRITEPATH.'uploads/approvals/'.$year.'/'.$month.'/'.$id_file.'/'.$sys_file_name)){
                $json['error'] = "Error storing the file";
                $json['message'] = "Error storing the file";
                return $this->respond($json, 500);
            }

            $file_path = WRITEPATH.'uploads/approvals/'.$year.'/'.$month.'/'.$id_file.'/'.$sys_file_name;

            $file_size = filesize($file_path);

            //Actualizar el registro como UPLOADED
            $update = "update md_approvals_files set upload_status='UPLOADED', file_path=?, file_size=? where id_file=?";
            $query = $db->query(
                $update,
                [
                    $file_path,
                    $file_size,
                    $id_file
                ]
            );
            
            $json['id_file'] = $id_file;
            $json['success'] = "File successfully upload";
            $json['message'] = "File successfully upload";

            return $this->respond($json, 200);
        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error uploading the file";
            $json['error'] = 1;
            return $this->respond($json, 500);
        }
        
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
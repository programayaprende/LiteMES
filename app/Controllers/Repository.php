<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Repository extends SecureController{

    use ResponseTrait;
  

    public function index(){
        header("Location: ".base_url("/Repository/Explorer"));
		die();
    }

    public function Explorer(){
        $data = [];
        $data['page_title']= "File Repository";

        $data['js_files'][] = '<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>';
        
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/crud/file-upload/repository-explorer.js"></script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/repository/repository-explorer.js"></script>';
        
        
       
        echo view("templates/header",$data);
        echo view("repository/repository_explorer.php",$data);
        echo view("templates/footer",$data);
    }

    public function FileUpload(){

        $id_grp = time();
                
        $json['error'] = 0;
        $json['message'] = '';

        $db = db_connect();

        if(!$_POST['files_id']){
            $json['error'] = "1";
            $json['message'] = "No files have been found to save";
            return $this->respond($json, 200);    
        }

        foreach($_POST['files_id'] as $id_file){
            $sql = "
            select 
                a.*, 
                year(upload_dt) as upload_year,
                month(upload_dt) as upload_month,
                day(upload_dt) as upload_day 
            from 
                sys_files_upload_tmp a where id = ?
            ";
            $query = $db->query($sql,[$id_file]);

            $row = $query->getRowArray();

            if(!$row){
                continue;
            }

            //Mover a su locacion final
            $newPath = WRITEPATH.'uploads\\repository\\'.$row['upload_year'].'\\'.$row['upload_month'].'\\'.$row['id'];

            mkdir($newPath,0777,true);

            $newFullPath = $newPath.'\\'.$row['sys_file_name'];

            rename($row['tmp_file_path'],$newFullPath);

            $insert = "
            insert into sys_files_upload(id,file_name,file_type,file_size,upload_dt,user_name,sys_file_name,file_path,description,id_grp,tags)
            values
            (
                ".$db->escape($row['id']).",
                ".$db->escape($row['file_name']).",
                ".$db->escape($row['file_type']).",
                ".$db->escape($row['file_size']).",
                now(),
                ".$db->escape($row['user_name']).",
                ".$db->escape($row['sys_file_name']).",
                ".$db->escape($newFullPath).",
                ".$db->escape($_POST['filesDescription']).",
                ".$db->escape($id_grp).",
                ".$db->escape($_POST['filesTags'])."
            )
            ";          

            $query = $db->query($insert);
        }
        $json['message'] = 'Files successfully upload';
        return $this->respond($json, 200);
    }

    public function TempFileUpload(){
        $json['error'] = 0;
        $json['message'] = "";
        $file = $this->request->getFile('file');

        $time = time();
                        
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

        $sys_file_name = $time."_".$clientName;
        $file->move(WRITEPATH.'uploads/'.session_id(),$sys_file_name);
        
        if(!file_exists(WRITEPATH.'uploads\\'.session_id()."\\".$sys_file_name)){
            $json['error'] = "Error saving the file";
            $json['message'] = "Error saving the file";
            return $this->respond($json, 500);
        }

        //Guardar en base de datos

        $db = db_connect();

        $sql = "
        insert into sys_files_upload_tmp(file_name,file_type,file_size,upload_dt,user_name,sys_file_name,tmp_file_path)
        values (?,?,?,now(),?,?,?)
        ";

        $query = $db->query($sql,[$clientName,$type,0,session()->get('user_name'),$sys_file_name,WRITEPATH.'uploads\\'.session_id()."\\".$sys_file_name]);

        $json['id'] = $db->insertID();
        $json['success'] = "File successfully store in the server";
        $json['message'] = "File successfully store in the server";
        return $this->respond($json, 200);

    }

    public function AddUser($id_role,$user_name){

        $json['error'] = 0;
        $json['message'] = "";
        $json['id_role'] = $id_role;
        $json['user_name'] = $user_name;

        $db = db_connect();

        $sql = "
        select count(*) as CNT from lnk_users_roles where id_role = ? and user_name = ?
        ";

        $query = $db->query($sql,[$id_role,$user_name]);

        $result = $query->getRowArray();

        if($result['CNT']>0){
            $json['error'] = 1;
            $json['message'] = "User already in this role user list";
        } else {
            $sql = "
            insert into lnk_users_roles(id_role,user_name,created_at) values (?,?,now())
            ";
            $query = $db->query($sql,[$id_role,$user_name]);
            $json['message'] = "User successfully add to this role";
        }
        
        return $this->respond($json, 200);
    }
    
    
    public function RemoveUser($id_role,$user_name){

        $json['error'] = 0;
        $json['message'] = "";
        $json['id_role'] = $id_role;
        $json['user_name'] = $user_name;

        $db = db_connect();

        $sql = "
        select count(*) as CNT from lnk_users_roles where id_role = ? and user_name = ?
        ";

        $query = $db->query($sql,[$id_role,$user_name]);

        $result = $query->getRowArray();

        if($result['CNT']==0){
            $json['error'] = 1;
            $json['message'] = "User not found assigned to this role";
        } else {
            $sql = "
            delete from lnk_users_roles where id_role = ? and user_name = ?
            ";
            $query = $db->query($sql,[$id_role,$user_name]);
            $json['message'] = "User successfully remove from this role";
        }
        
        return $this->respond($json, 200);
    }

    public function GetUsers($id_role){ //NO ESTA EN USO
        
        $db = db_connect();
        
        $extra = [];
        
        //Datos enviados por DataTable
        $datatable = array_merge(array('pagination' => array(), 'sort' => array(), 'query' => array()), $_REQUEST);

        //Inicializar el constructor del query        
        $sql = "
        select user_name,email,first_name,last_name,locked,approved,last_login,date(created_at) as created_at,job_description,contact_phone from ma_users 
        where user_name in (select user_name from lnk_users_roles where id_role=".$db->escape($id_role).")
        ";

        // Se mando un filtro desde la cabecera del modulo
        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch']) ? $datatable['query']['generalSearch'] : '';
        if (!empty($filter)) {
            $sql .= "
            and (name like '%".$db->escapeLikeString($filter)."%' or description like '%".$db->escapeLikeString($filter)."%')
            ";
            unset($datatable['query']['generalSearch']);
        } else {
            foreach($_REQUEST as $field=>$value){
                
                if(substr($field,0,7)!="filter_" or $value==""){
                    continue;
                }
                switch($field){
                    case "filter_name":
                        $sql .= "(first_name like '%".$db->escapeLikeString($value)."%' or last_name like '%".$db->escapeLikeString($value)."%')";                        
                        break;                    
                }
            }
        }
        
        //Checar si se mando info para el sort
        $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
        $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'first_name';

        //Aplicar el sort en el query
        $sql.= "
        order by $field $sort
        ";

        //Revisar que pagina quieren ver        
        $page = !empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
        //Revisar cuantos items por pagina
        $perpage = !empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $pages = 1;
        $total = 100;

        if ($perpage > 0) {
            $pages = ceil($total / $perpage); // calculate total pages
            $page = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
            $page = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
            $offset = ($page - 1) * $perpage;
            if ($offset < 0) {
                $offset = 0;
            }                                    
            $sql .= "
            limit $offset , $perpage
            ";
        }
                
        $extra['sql'] = $sql;

        $data = [];

        $query = $db->query($sql);
        foreach ($query->getResultArray() as $row)
        {
            $data[] = $row;
        }

        $meta = array(
            'page' => $page,
            'pages' => $pages,
            'perpage' => $perpage,
            'total' => $total,
        );     

        $result = array(
            'extra' => $extra,
            'meta' => $meta + array(
                'sort' => $sort,
                'field' => $field,
            ),
            'data' => $data
        );
        
        echo json_encode($result, JSON_PRETTY_PRINT);

    }

    public function GetFiles(){
        
        $roleModel = new RoleModel();
        $extra = [];
        
        //Datos enviados por DataTable
        $datatable = array_merge(array('pagination' => array(), 'sort' => array(), 'query' => array()), $_REQUEST);

        //Inicializar el constructor del query
        $dataBuilder = $roleModel->builder();
        $dataBuilder->select('id,name,description,date(created_at) as created_at');

        // Se mando un filtro desde la cabecera del modulo
        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch']) ? $datatable['query']['generalSearch'] : '';
        if (!empty($filter)) {
            $dataBuilder->orLike('name',$filter);
            $dataBuilder->orLike('description',$filter);            
            unset($datatable['query']['generalSearch']);
        } else {
            foreach($_REQUEST as $field=>$value){
                
                if(substr($field,0,7)!="filter_" or $value==""){
                    continue;
                }
                switch($field){
                    case "filter_name":
                        $condition = "(name like '%".$value."%' or description like '%".$value."%')";
                        $dataBuilder->where($condition);
                        break;                    
                }
            }
        }
        
        //Checar si se mando info para el sort
        $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
        $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'name';

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
            'meta' => $meta + array(
                'sort' => $sort,
                'field' => $field,
            ),
            'data' => $data
        );
        
        echo json_encode($result, JSON_PRETTY_PRINT);

    }

    public function GetRoleData($id){
        
        if($this->request->getMethod()=="post"){
            
            $json['error'] = 0;

            if($_SERVER['CI_ENVIRONMENT']=="development"){
                $json['_POST'] = $_POST;
                $json['_FILES'] = $_FILES;
            }

            if(!$id){
                $json['error'] = 0;
                $json['message'] = 'Please provide a valid role ID';
                $json['errors'] = [
                    'id' => 'Please provide a valid role ID',
                ];
                $json['lists_errors'] = '<ul><li>'.'Please provide a valid role ID'.'</li></ul>';                
            } else {
                $role = new RoleModel();
                $roleData = $role->find($id);
                if(!$roleData){
                    $json['error'] = 1;
                    $json['message'] = "Please provide a valid ID";
                    $json['errors'] = [
                        'id' => 'Please provide a valid ID',
                    ];
                    $json['lists_errors'] = '<ul><li>'.'Please provide a valid ID'.'</li></ul>';
                } else {                    
                    $json['role_data'] = $roleData;

                    $db = db_connect();

                    //Traer todos los permisos que tiene actualmente el role
                    $sql = "
                    select id_permission,type from lnk_roles_permissions where id_role = ?
                    ";
                    $query = $db->query($sql,[$id]);
                    foreach($query->getResultArray() as $row){
                        $json['permissions'][] = $row;
                    }
        
                    $extra = [];
                                        
                    //Traer los usuarios que usan este rol
                    $sql = "
                    select user_name,email,first_name,last_name,locked,approved,last_login,date(created_at) as created_at,job_description,contact_phone from ma_users 
                    where user_name in (select user_name from lnk_users_roles where id_role=".$db->escape($id).")
                    ";

                    $sql.= "
                    order by first_name 
                    ";

                    $data = [];
                    $users = [];

                    $query = $db->query($sql);
                    foreach ($query->getResultArray() as $row)
                    {
                        $users[] = array(
                            $row['user_name'],
                            $row['first_name'],
                            $row['last_name'],
                            $row['email'],
                            $row['job_description'],
                            "-",
                        );
                    }

                    $json['users'] = $users;

                }
            }

            return $this->respond($json, 200);
        }
    }

    public function Edit($id){
        
        if($this->request->getMethod()=="post"){
            
            $json['error'] = 0;

            if($_SERVER['CI_ENVIRONMENT']=="development"){
                $json['_POST'] = $_POST;
                $json['_FILES'] = $_FILES;
            }

            //Revisar que se haya enviado el usario
            if(!$this->request->getVar('id')){
                $json['error'] = 1;
                $json['message'] = "Please provide a valid ID";
                $json['errors'] = [
                    'id' => 'Please provide a valid ID',
                ];
                $json['lists_errors'] = '<ul><li>'.'Please provide a valid ID'.'</li></ul>';                
            } else {
                $role = new RoleModel();
                $roleData = $role->find($this->request->getVar('id'));
                if(!$roleData){
                    $json['error'] = 1;
                    $json['message'] = "Please provide a valid ID";
                    $json['errors'] = [
                        'id' => 'Please provide a valid ID',
                    ];
                    $json['lists_errors'] = '<ul><li>'.'Please provide a valid ID'.'</li></ul>';
                } else {
                    
                    $rules = [
                        'id' => 'required',
                        'name' => 'required|min_length[3]|max_length[20]|is_unique[ma_roles.name,id,{id}]',
                        'description' =>  'required|min_length[3]|max_length[20]',
                    ];
                    
                    if(!$this->validate($rules)){                
                        $json['error'] = 1;
                        $json['message'] = "Validation errors";
                        $json['errors'] = $this->validator->getErrors();
                        $json['lists_errors'] = $this->validator->listErrors();
                    } else {                        
                        //Paso las validaciones
                        //Revisar que datos se pueden actualizar
                        $roleNewData = [                            
                            "name" => $this->request->getVar('name'),
                            "description" => $this->request->getVar('description'),                            
                        ];
                        
                        //Actualizar el registro
                        $role->update($this->request->getVar('id'),$roleNewData);
                        
                        //Mensaje de retorno y id actualizado
                        $json['id'] = $this->request->getVar('id');
                        $json['message'] = "Role update succesfully";
                        
                    }

                    
                    $id_role = $this->request->getVar('id');

                    //Extraer todos los ID de permisos que existen                    
                    $db = db_connect();

                    $sql  = "
                    SELECT
                    id 
                    FROM
                    ma_permissions a
                    order by a.controller 
                    ";
                    $json['sql'][] = $sql;
                    $query = $db->query($sql);

                    foreach ($query->getResultArray() as $row)
                    {
                        $permissions[] = $row['id'];
                    }

                    foreach($permissions as $id_permission){
                        //Revisar si se envio el informacion sobre el permiso
                        if($new_action = $this->request->getVar('permission_'.$id_permission)){
                            //Revisar si ya existe el record en base de datos
                            $sql = "
                            select * from lnk_roles_permissions where id_permission = ? and id_role = ?
                            ";
                            $json['sql'][] = $sql;
                            $query = $db->query($sql,[$id_permission,$id_role]);

                            if($row = $query->getRowArray()){                                
                                //Si la nueva action es DEFAULT borrar el record de la tabla
                                if($new_action=="DEFAULT"){
                                    $sql = "
                                    delete from lnk_roles_permissions where id_permission = ? and id_role = ?
                                    ";
                                    $json['sql'][] = $sql;
                                    $query = $db->query($sql,[$id_permission,$id_role]);
                                } else {
                                    //Si el valor es distinto al nuevo hacer un update
                                    if($row['type']!=$new_action){
                                        $sql = "
                                        update lnk_roles_permissions set type = ? where id_permission = ? and id_role = ?
                                        ";
                                        $json['sql'][] = $sql;
                                        $query = $db->query($sql,[$new_action,$id_permission,$id_role]);
                                    }
                                }                                
                            } else if($new_action!="DEFAULT"){
                                //Si no existe el record y la nueva accion es diferente de DEFAULT
                                //crear un nuevo registro
                                $sql = "
                                insert into lnk_roles_permissions
                                (id_role,id_permission,type,created_at)
                                values 
                                (?      ,?            ,?   ,now())
                                ";
                                $json['sql'][] = $sql;
                                $query = $db->query($sql,[$id_role,$id_permission,$new_action]);
                            }
                            
                        }
                    }
                    

                    
                }
            }

            return $this->respond($json, 200);
        }

        $data['page_title']= "Roles | Edit ( ".$id." )";
        $data['style_files'][] = '<link href="'.base_url().'/assets/css/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />';
        $data['style_files'][] = '<link href="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "edit"; </script>';
        $data['js_files'][] = '<script> var REQUEST_ID = "'.$id.'"; </script>';        
        $data['js_files'][] = '<script src="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.js"></script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/role/role-form.js"></script>';

        $db = db_connect();
        
        $sql  = "
        SELECT
        * 
        FROM
        ma_permissions a
        left join (select * from  lnk_roles_permissions where id_role=?) b
        on a.id = b.id_permission
        order by a.controller 
        ";
        
        $query = $db->query($sql, [$id]);

        foreach ($query->getResultArray() as $row)
        {
            $permission[$row['controller']][] = $row;            
        }

        $controllers = array_keys($permission);

        $data['permissions'] = $permission;
        $data['controllers'] = $controllers;


        echo view("templates/header",$data);
        echo view("roles/role_form",$data);
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
                'name' => 'required|min_length[3]|max_length[20]|is_unique[ma_roles.name]',
                'description' =>  'required|min_length[3]|max_length[20]',                
            ];

            if(!$this->validate($rules)){                
                $json['error'] = 1;
                $json['message'] = "Validation Errors";
                $json['errors'] = $this->validator->getErrors();
                $json['lists_errors'] = $this->validator->listErrors();
            } else {
                //Save role in DB
                $role = new RoleModel();

                $roleData = [
                    "name" => $this->request->getVar('name'),
                    "description" => $this->request->getVar('description'),
                ];
                
                $role->insert($roleData);
                
                //Verify the insert
                $roleInserted = $role->insertID();

                if(!$roleInserted){
                    $json['error'] = 1;
                    $json['message'] = "Error creating a new role";
                    $json['errors'] = array('id'=> 'Error Creating a new role');
                    $json['lists_errors'] = "<ul><li>Error creating a new role</li></ul>";
                } else {
                    $json['id'] = $roleInserted;
                    $json['message'] = "New role added succesfully";
                }

                //Grabar los permisos

                
            }

            return $this->respond($json, 200);
        }

        //Informacion para el desplegado de la pagina
        $data['page_title']= "Roles | New";
        $data['style_files'][] = '<link href="'.base_url().'/assets/css/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "new"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/role/role-form.js"></script>';

        $db = db_connect();
        
        $sql  = "
        SELECT
        a.*, null as type 
        FROM
        ma_permissions a        
        order by a.controller 
        ";
        
        $query = $db->query($sql);

        foreach ($query->getResultArray() as $row)
        {
            $permission[$row['controller']][] = $row;            
        }

        $controllers = array_keys($permission);

        $data['permissions'] = $permission;
        $data['controllers'] = $controllers;


        echo view("templates/header",$data);
        echo view("roles/role_form",$data);
        echo view("templates/footer",$data);

    }
}
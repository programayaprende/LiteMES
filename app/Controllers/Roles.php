<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\RoleModel;

class Roles extends SecureController{

    use ResponseTrait;

    public function index(){
        header("Location: ".base_url("/Roles/List"));
		die();
    }

    public function List(){
        $data = [];
        $data['page_title']= "Query Roles";

        $data['js_files'][] = '<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>';        
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/role/role-list.js"></script>';

        echo view("templates/header",$data);
        echo view("roles/role_list.php",$data);
        echo view("templates/footer",$data);
    }

    public function GetRoles(){
        
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
                        'name' => 'required|min_length[3]|max_length[20]||is_unique[ma_roles.name,id,{id}]',
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
                }
            }

            return $this->respond($json, 200);
        }

        $data['page_title']= "Roles | Edit ( ".$id." )";
        $data['style_files'][] = '<link href="'.base_url().'/assets/css/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "edit"; </script>';
        $data['js_files'][] = '<script> var REQUEST_ID = "'.$id.'"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/role/role-form.js"></script>';


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
                'id' => 'required|is_unique[ma_users.id]',
            ];

            $errors = [
                'id' => [
                    'is_unique' => 'ID already exists'
                ]
            ];

            if(!$this->validate($rules,$errors)){                
                $json['error'] = 1;
                $json['message'] = "Validation Errors";
                $json['errors'] = $this->validator->getErrors();
                $json['lists_errors'] = $this->validator->listErrors();
            } else {
                //Save role in DB
                $role = new RoleModel();

                $roleData = [
                    "id" => $this->request->getVar('id'),
                    "name" => $this->request->getVar('name'),
                    "description" => $this->request->getVar('description'),
                ];
                
                $role->insert($roleData);
                
                //Verify the insert
                $roleInserted = $role->find($roleData['id']);

                if(!$roleInserted){
                    $json['error'] = 1;
                    $json['message'] = "Error creating a new role";
                    $json['errors'] = array('id'=> 'Error Creating a new role');
                    $json['lists_errors'] = "<ul><li>Error creating a new role</li></ul>";
                } else {
                    $json['id'] = $roleInserted['id'];
                    $json['message'] = "New role added succesfully";
                }
                
            }

            return $this->respond($json, 200);
        }

        //Informacion para el desplegado de la pagina
        $data['page_title']= "Roles | New";
        $data['style_files'][] = '<link href="'.base_url().'/assets/css/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "new"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/role/role-form.js"></script>';


        echo view("templates/header",$data);
        echo view("roles/role_form",$data);
        echo view("templates/footer",$data);

    }
}
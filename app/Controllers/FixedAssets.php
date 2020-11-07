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
                    a.fixed_asset_status not in ('Deleted')                    
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
        $json['errors'] = array('none'=> 'none');
        $json['lists_errors'] = '';
        $json['message'] = '';
        
        //Si no envio por post rechazar la solicitud
        if($this->request->getMethod()!="post"){                
            $json['message'] = "Invalid method";
            $json['error']=1;
            $json['errors'] = "Error creating a new record...";
            $json['lists_errors'] = '';
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

            
            $errors = [
                'user_name' => [
                    'is_unique' => 'Username already exists'
                ]
            ];            

            if(!$this->validate($rules,$errors)){                
                $json['error'] = 1;
                $json['errors'] = $this->validator->getErrors();
                $json['lists_errors'] = $this->validator->listErrors();
                return $this->respond($json, 500);
            }

            $insert = "
            insert into ma_fixed_assets
            (`description`,`part_number`,`brand`,`model`,`serial_no`,`import_petition`,`tariff_heading`,`key`,`remark`,`created_at`,`created_by`,`updated_at`,`updated_by`,`fixed_asset_status`)
            values
            (:description:,:part_number:,:brand:,:model:,:serial_no:,:import_petition:,:tariff_heading:,:key:,:remark:,now(),:created_by:,now(),:updated_by:,:fixed_asset_status:)
            ";

            $json['sql'] = $insert;

            $db->query($insert,[
                'description' => $this->request->getVar('description'),
                'part_number' => $this->request->getVar('part_number'),
                'brand' => $this->request->getVar('brand'),
                'model' => $this->request->getVar('model'),
                'serial_no' => $this->request->getVar('serial_no'),
                'import_petition' => $this->request->getVar('import_petition'),
                'tariff_heading' => $this->request->getVar('tariff_heading'),
                'key' => $this->request->getVar('key'),
                'remark' => '',
                'created_by' => session()->get('user_name'),
                'updated_by' => session()->get('user_name'),
                'fixed_asset_status' => 'Active',               
            ]);

            $id_fixed_asset = $db->insertID();

            if(!$id_fixed_asset){
                $json['error'] = 1;
                $json['errors'] = array('fixed_asset'=> 'Error Creating a new record');
                $json['lists_errors'] = '<ul><li>Error creating a new record</li></ul>';
                return $this->respond($json, 500);
            }

            //Generar un hash
            $hash_fixed_asset = md5("fixed_assets_".$id_fixed_asset);

            $update = "
            update ma_fixed_assets set hash_fixed_asset = '".$hash_fixed_asset."' where id_fixed_asset = $id_fixed_asset
            ";

            $db->query($update);

            $select = "select * from ma_fixed_assets where id_fixed_asset = $id_fixed_asset ";

            $query = $db->query($select);

            $fixed_asset = $query->getRowArray();

            $json['fixed_asset'] = $fixed_asset;
            $json['message'] = "New record added succesfully";
            return $this->respond($json, 200);


        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error saving new record";
            $json['errors'] = array('fixed_asset'=> 'Error Creating a new record');
            $json['lists_errors'] = '<ul><li>Error creating a new record</li></ul>';
            $json['error']=1;
            return $this->respond($json, 500);
        }
    }


}

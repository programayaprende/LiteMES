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
        $data['style_files'][] = '<link href="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "sent"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.js"></script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/approvals/inbox.js"></script>';
        
        echo view("templates/header",$data);
        echo view("approvals/approvals_inbox",$data);
        echo view("templates/footer",$data);
    }
    
    public function Pendings(){
        //Informacion para el desplegado de la pagina
        $data['page_title']= "Approvals | Sent";
        $data['style_files'][] = '';
        $data['style_files'][] = '<link href="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "pendings"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.js"></script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/approvals/inbox.js"></script>';
        
        echo view("templates/header",$data);
        echo view("approvals/approvals_inbox",$data);
        echo view("templates/footer",$data);
    }

    public function Approved(){
        //Informacion para el desplegado de la pagina
        $data['page_title']= "Approvals | Sent";
        $data['style_files'][] = '';
        $data['style_files'][] = '<link href="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "approved"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.js"></script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/approvals/inbox.js"></script>';
        
        echo view("templates/header",$data);
        echo view("approvals/approvals_inbox",$data);
        echo view("templates/footer",$data);
    }

    public function Concent(){
        //Informacion para el desplegado de la pagina
        $data['page_title']= "Approvals | Sent";
        $data['style_files'][] = '';
        $data['style_files'][] = '<link href="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "concent"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.js"></script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/approvals/inbox.js"></script>';
        
        echo view("templates/header",$data);
        echo view("approvals/approvals_inbox",$data);
        echo view("templates/footer",$data);
    }

    public function Rejected(){
        //Informacion para el desplegado de la pagina
        $data['page_title']= "Approvals | Sent";
        $data['style_files'][] = '';
        $data['style_files'][] = '<link href="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "rejected"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.js"></script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/approvals/inbox.js"></script>';
        
        echo view("templates/header",$data);
        echo view("approvals/approvals_inbox",$data);
        echo view("templates/footer",$data);
    }

    public function Notifications(){
        //Informacion para el desplegado de la pagina
        $data['page_title']= "Approvals | Sent";
        $data['style_files'][] = '';
        $data['style_files'][] = '<link href="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $data['js_files'][] = '<script> var DEFAULT_ACTION = "notifications"; </script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/plugins/custom/datatables/datatables.bundle.js"></script>';
        $data['js_files'][] = '<script src="'.base_url().'/assets/js/pages/custom/approvals/inbox.js"></script>';
        
        echo view("templates/header",$data);
        echo view("approvals/approvals_inbox",$data);
        echo view("templates/footer",$data);
    }

    public function info(){
        echo phpinfo();
        return;
    }

    public function testMail(){
        echo "Test Mail";
        return;

        $to = 'jaraiza1983@gmail.com';
        $subject = "Testing mail";
        $message = "
        <h1>Hola</h1>
        <p>
        Este es un ejemplo de correo ".date("YmdHis")."
        </p>
        ";

        $email = \Config\Services::email();

        $email->setFrom('programayaprende@gmail.com');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        if($email->send()){
            echo "Correo enviado...";
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }

    static function processApproval($approval_hash){
        
        $db = db_connect();

        try{
            //Revisar que el approval exista y que no sea Draft
            $select = "select a.* from md_approvals a
            left join ma_users b on a.drafter = b.user_name
            where approval_hash = ".$db->escape($approval_hash)." and status not in ('Draft')";

            $query = $db->query($select);

            $approval = $query->getRowArray();

            if(!isset($approval)){                
                return false;
            }

            //Traer el approval_path
            $select = "
            select a.* from md_approvals_users a
            left join ma_users b on a.user_name = b.user_name
            where id_approval= ".$db->escape($approval['id_approval'])."
            order by seq
            ";

            $query = $db->query($select);

            $approval_path = [];

            $next_user_name = "?";

            $pendingSteps = false;

            $firstStep = false;

            $nextStep = false;
            $rejected = false;

            $approvedStepsCount=0;
            $consentStepsCount=0;
            $notifiedStepsCount=0;

            foreach($query->getResultArray() as $row){

                if($row['status']=="Pending"){
                    return true;
                }

                if($row['status']=="Rejected"){
                    $rejected = true;                    
                }

                if($row['status']=="Approved"){
                    $approvedStepsCount++;
                }
                
                if($row['status']=="Consent"){
                    $consentStepsCount++;
                }
                
                if($row['status']=="Notified"){
                    $notifiedStepsCount++;
                }

                if($row['status']=="-"){
                    $pendingSteps = true;
                    if(!$nextStep){
                        $nextStep = $row;
                    }
                }
                                
                $approval_path[] = $row;

                if(!$firstStep){
                    $firstStep = $row;
                }

                $lastStep = $row;

            }

            //Si el documento esta rechazado no hay mas pasos pendientes
            if($rejected){                
                $pendingSteps = false;
            }

            //Si no hay mas pendientes terminar con este Approval            
            if(!$pendingSteps){

                //Si esta rechazado pero el approval tiene status 'Pending' cambiar a Rejected
                if($rejected && $approval['status']!="Rejected"){
                    $update = "
                    update md_approvals set status='Rejected', finished_at=now() where approval_hash=".$db->escape($approval_hash)."  limit 1
                    ";
                    $query = $db->query($update);

                    //Enviar correo al creado avisando del rechazo

                    return true;
                }


                if($approval['status']=="Pending"){
                    if($approvedStepsCount>0){
                        $update = "
                        update md_approvals set status='Approved', finished_at=now() where approval_hash=".$db->escape($approval_hash)."  limit 1
                        ";
                        $query = $db->query($update);

                        //Enviar correo al creado avisando del fin del documento

                        return true;
                    }

                    if($consentStepsCount>0){
                        $update = "
                        update md_approvals set status='Consent', finished_at=now() where approval_hash=".$db->escape($approval_hash)."  limit 1
                        ";
                        $query = $db->query($update);

                        //Enviar correo al creador avisando del fin del documento

                        return true;
                    }
                    
                    if($notifiedStepsCount>0){
                        $update = "
                        update md_approvals set status='Notified', finished_at=now() where approval_hash=".$db->escape($approval_hash)."  limit 1
                        ";
                        $query = $db->query($update);

                        return true;
                    }
                }
                return true;
            }
            
            switch($nextStep['approval_type']){
                case "Notification":
                    
                    //Actualizar el registro
                    $update = "update md_approvals_users 
                    set status='Notified', status_set_at=now(), receive_at=now(),comment=''
                    where id_approval=".$db->escape($nextStep['id_approval'])."
                    and user_name=".$db->escape($nextStep['user_name'])." limit 1";

                    $query = $db->query($update);

                    if($db->affectedRows()==0){
                        return false;
                    }

                    //TODO Enviar el correo con la informacion

                    //Como es notificacion y ya fue procesada revisar el siguiente paso
                    Approvals::processApproval($approval_hash);

                    return true;

                break;
                case "Approval":
                case "Concent":

                    //Actualizar el registro
                    $update = "update md_approvals_users 
                    set receive_at=now(), status='Pending'
                    where id_approval=".$db->escape($nextStep['id_approval'])."
                    and user_name=".$db->escape($nextStep['user_name'])." limit 1";

                    $query = $db->query($update);

                    if($db->affectedRows()==0){
                        return false;
                    }

                    //TODO Enviar el correo con la informacion

                    return true;

                break;
            }
           

        }catch(Exception $e){
            return false;
        }
    }

    public function applyAction(){
        $db = db_connect();

        $extra = [];

        $json['error'] = 0;
        $json['message'] = "";
        
        try {   
            
            //Revisar que el approval exista y que no sea Draft
            $select = "select a.* from md_approvals a
            left join ma_users b on a.drafter = b.user_name
            where approval_hash = ".$db->escape($this->request->getVar('approval_step_approval_hash'))." and status in ('Pending')";
            
            $query = $db->query($select);

            $approval = $query->getRowArray();

            if(!isset($approval)){
                $json['message'] = "Approval not found";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            //Traer el approval_path
            $select = "
            select a.* from md_approvals_users a
            left join ma_users b on a.user_name = b.user_name
            where id_approval= ".$db->escape($approval['id_approval'])."
            order by seq
            ";

            $query = $db->query($select);

            $approval_path = [];

            $next_user_name = "?";

            foreach($query->getResultArray() as $row){

                if($row['status']=="-"){
                    $row['comment'] = "-";
                    //$row['status'] = "Pending";
                }
                
                if($row['status_set_at']==""){
                    $row['status_set_at']="-";
                }
                
                $approval_path[] = $row;

                if( ($row['approval_type']=="Approval" || $row['approval_type']=="Concent") && $row['status']=="Pending" && $next_user_name=="?"){
                    $next_user_name = $row['user_name'];
                }

            }

            $json['next_user_name'] = $next_user_name;

            if($next_user_name != session()->get('user_name')){
                $json['message'] = "You can not approve this at this moment";
                $json['error']=1;
                return $this->respond($json, 200);
            }
            
            //Aplicar la accion enviada
            switch($this->request->getVar('approval_step_action')){
                case "Approve":
                    $action_to_apply = "Approved";
                    break;
                case "Concent":
                    $action_to_apply = "Concent";
                    break;
                case "Reject":
                    $action_to_apply = "Rejected";
                    break;
            }
            $update = "update md_approvals_users set 
            status= ".$db->escape($action_to_apply).", 
            status_set_at=now(), 
            comment=".$db->escape($this->request->getVar('approval_step_comment'))."
            where id_approval = ".$db->escape($approval['id_approval'])."
            and user_name = ".$db->escape(session()->get('user_name'))."
            and status='Pending'
            ";

            $query = $db->query($update);

            //Revisar si se aplico el update
            $select = "select * from md_approvals_users where id_approval = ".$db->escape($approval['id_approval'])." and user_name = ".$db->escape(session()->get('user_name'))."";
            
            $query = $db->query($select);

            $row = $query->getRowArray();

            if($row['status'] != $action_to_apply){
                $json['message'] = "Error updatating the approval";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            $json['message'] = "Approval successfully updated";
            $json['approval'] = $approval;

            Approvals::processApproval($approval['approval_hash']);

            return $this->respond($json, 200);

        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error getting approvals list";
            $json['error']=1;
            return $this->respond($json, 500);
        }

    }

    public function View($approval_hash){
        $db = db_connect();

        $extra = [];

        $json['error'] = 0;
        $json['message'] = "";

        try {   

            $canView = false;

            //Revisar que el approval exista y que no sea Draft
            $select = "select a.* from md_approvals a
            left join ma_users b on a.drafter = b.user_name
            where approval_hash = ".$db->escape($approval_hash)." and status not in ('Draft')";
            
            $query = $db->query($select);

            $approval = $query->getRowArray();

            if(!isset($approval)){
                $json['message'] = "Approval not found";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            //Traer el approval_path
            $select = "
            select a.* from md_approvals_users a
            left join ma_users b on a.user_name = b.user_name
            where id_approval= ".$db->escape($approval['id_approval'])."
            order by seq
            ";

            $query = $db->query($select);

            $approval_path = [];

            $next_user_name = "";

            foreach($query->getResultArray() as $row){
                if($row['status']=="-"){
                    $row['comment'] = "-";
                    $row['status'] = "-";
                }
                if($row['status_set_at']==""){
                    $row['status_set_at']="-";
                }
                $approval_path[] = $row;
                if($row['user_name']==session()->get('user_name')){
                    $canView = true;
                }

                if($row['approval_type']=="Approval" && $row['status']=="Pending" && $next_user_name==""){
                    $next_user_name = $row['user_name'];
                }
            }

            $json['next_user_name'] = $next_user_name;

            $json['show_btn'] = 0;

            if($next_user_name == session()->get('user_name')){
                $json['show_btn'] = 1;
            }


            //Revisar si soy el creador del Approval o soy parte de los usuarios
            if(!$canView && $approval['drafter']!=session()->get('user_name')){
                $json['message'] = "Approval not found";
                $json['error']=1;
                return $this->respond($json, 200);
            }

            //Traer la informacion de los archivos adjuntos
            $select = "select * from md_approvals_files where id_approval = ".$db->escape($approval['id_approval'])." and upload_status='UPLOADED'";

            $query = $db->query($select);

            $approval_files = [];

            foreach($query->getResultArray() as $row){
                $approval_files[] = $row;
            }
            
            $json['approval'] = $approval;
            $json['approval_path'] = $approval_path;
            $json['approval_files'] = $approval_files;
            
            return $this->respond($json, 200);

        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error getting approvals list";
            $json['error']=1;
            return $this->respond($json, 500);
        }

    }

    public function GetApprovals($initFilter){
        $db = db_connect();

        $extra = [];
        
        //Datos enviados por DataTable
        $datatable = array_merge(array('pagination' => array(), 'sort' => array(), 'query' => array()), $_REQUEST);

        $json['codition'] = $this->request->getVar('condition');
        $json['sort'] = $this->request->getVar('sort');

        $condition = "";
        
        try {

            //Listado de enviados
            if($this->request->getVar('condition')=="sent" || $initFilter=="Sent"){

                //Revisar filtros extras
                foreach($_REQUEST as $field=>$value){
                    if(substr($field,0,7)!="filter_" or $value==""){
                        continue;
                    }
                    switch($field){
                        case "filter_search":
                            $value = str_replace("'","",$value);
                            $condition = "and (subject like '%".$value."%' or body like '%".$value."%')";
                            break;
                    }
                }

                //Checar si se mando info para el sort
                $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
                $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'submit_at';

                $select = "
                select 
                    a.*
                from md_approvals a left join ma_users b on a.drafter = b.user_name 
                where 
                    drafter = ".$db->escape(session()->get('user_name'))." 
                    and status not in ('Draft')
                    $condition
                order by ".$field." ".$sort;
            }

            //Listado de MisPendientes
            if($this->request->getVar('condition')=="pendings" || $initFilter=="Pendings"){

                //Revisar filtros extras
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

                //Checar si se mando info para el sort
                $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
                $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'submit_at';

                $select = "
                select 
                        a.*
                from md_approvals a left join ma_users b on a.drafter = b.user_name 
                where 
                    id_approval in (
                        select id_approval from md_approvals_users where user_name=".$db->escape(session()->get('user_name'))." and status='Pending'
                    )
                    and status in ('Pending')
                order by ".$field." ".$sort;
                
            }

            //Listado de Approved
            if($this->request->getVar('condition')=="approved" || $initFilter=="Approved"){

                //Revisar filtros extras
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

                //Checar si se mando info para el sort
                $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
                $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'submit_at';

                $select = "
                select 
                        a.* 
                from md_approvals a left join ma_users b on a.drafter = b.user_name 
                where 
                    id_approval in (
                        select id_approval from md_approvals_users where user_name=".$db->escape(session()->get('user_name'))." and status='Approved'
                    )
                    and status not in ('Draft')
                order by ".$field." ".$sort;
                
            }

            //Listado de Concent
            if($this->request->getVar('condition')=="concent" || $initFilter=="Concent"){

                //Revisar filtros extras
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

                //Checar si se mando info para el sort
                $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
                $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'submit_at';

                $select = "
                select 
                        a.* 
                from md_approvals a left join ma_users b on a.drafter = b.user_name 
                where 
                    id_approval in (
                        select id_approval from md_approvals_users where user_name=".$db->escape(session()->get('user_name'))." and status='Concent'
                    )
                    and status not in ('Draft')
                order by ".$field." ".$sort;
                
            }

            //Listado de Rejected
            if($this->request->getVar('condition')=="rejected" || $initFilter=="Rejected"){

                //Revisar filtros extras
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

                //Checar si se mando info para el sort
                $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
                $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'submit_at';

                $select = "
                select 
                        a.* 
                from md_approvals a left join ma_users b on a.drafter = b.user_name 
                where 
                    id_approval in (
                        select id_approval from md_approvals_users where user_name=".$db->escape(session()->get('user_name'))." and status='Rejected'
                    )
                    and status not in ('Draft')
                order by ".$field." ".$sort;
                
            }

            //Listado de Notifications
            if($this->request->getVar('condition')=="notifications" || $initFilter=="Notifications"){

                //Revisar filtros extras
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

                //Checar si se mando info para el sort
                $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
                $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'submit_at';

                $select = "
                select 
                        a.* 
                from md_approvals a left join ma_users b on a.drafter = b.user_name 
                where 
                    id_approval in (
                        select id_approval from md_approvals_users where user_name=".$db->escape(session()->get('user_name'))." and status='Notified'
                    )
                    and status not in ('Draft')
                order by ".$field." ".$sort;
                
            }

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
                $select .= " limit $offset, $perpage";
            }
            
            $query = $db->query($select);

            $data = [];

            foreach($query->getResultArray() as $row){
                $row['submit_at_str'] = date("M d, Y h:i:s a",strtotime($row['submit_at']));
                $c=0;
                $row_data = [];
                foreach($row as $v){
                    $row_data[$c] = $v;
                    $c++;
                }
                $data[] = $row_data;
            }

            $meta = array(
                'page' => $page,
                'pages' => $pages,
                'perpage' => $perpage,
                'total' => $total,
            );

            //$json['rows'] = $rows;

            $result = array(
                'meta' => $meta + array(
                    'sort' => $sort,
                    'field' => $field,
                ),
                'data' => $data
            );
            
            echo json_encode($result, JSON_PRETTY_PRINT);

        }catch(Exception $e){
            $json['e'] = $e->getMessage();
            $json['message'] = "Error getting approvals list";
            $json['error']=1;
            return $this->respond($json, 500);
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

            //Procesar el approval
            Approvals::processApproval($this->request->getVar('approval_hash'));

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


            $select = "select * from ma_users where user_name=? limit 1";
            
            $query = $db->query($select,[session()->get('user_name')]);

            $user = $query->getRowArray();

            if(!isset($user)){
                $json['message'] = "User not found";
                $json['error']=1;
                return $this->respond($json, 200);
            }


            $insert = "insert into md_approvals(drafter,status,first_name,last_name,job_description,created_at)
            values (?,'Draft',?,?,?,now())";
            $insert = $db->query($insert,[session()->get('user_name'), $user['first_name'], $user['last_name'], $user['job_description']]);
            
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
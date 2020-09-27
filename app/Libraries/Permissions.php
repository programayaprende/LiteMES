<?php namespace App\Libraries;

class Permissions {
    
    public static function hasPermission(string $user_name,string $controller,string $action){
       
        $db = db_connect();
        
        //Revisar si el usuario existe
        $sql  = "SELECT count(*) as c FROM ma_users where user_name=".$db->escape($user_name)."";
        $query = $db->query($sql);
        $row = $query->getRowArray();        
        
        //Si el usuario no existe
        if($row['c']==0){
            return false;
        }

        //Revisar si tiene asignado el permiso
        $sql =  "
        select b.type from lnk_users_roles a 
        left join lnk_roles_permissions b on a.id_role = b.id_role 
        left join ma_permissions c on b.id_permission = c.id
        where a.user_name=".$db->escape($user_name)." and c.controller = ".$db->escape($controller)." and c.action = ".$db->escape($action)."
        group by b.type
        order by b.type
        ";

        $query = $db->query($sql);
        $results = $query->getResult();
        
        $roleExists = false;        
        $allow = false;
        $deny = false;            
        foreach ($query->getResultArray() as $row){
            $roleExists = true;
            if($row['type']=="DENY"){
                $deny = true;
            }
            if($row['type']=="ALLOW"){                
                $allow = true;
            }
        }

        //Si existe una configuracion determinar que retornar
        if($roleExists){
            if($deny) return false;
            if($allow) return true;
        }

        //No tiene asignado role que tenga el permiso, revisar si existe una condicion default Controller / Action
        $sql = "
        select * from ma_permissions where controller = ".$db->escape($controller)." and action=".$db->escape($action).";
        ";
        $query = $db->query($sql);
        $row = $query->getRowArray();
        if(!$row){
            //No existe restriccion            
            return true;
        }        
        return ($row['default']=="ALLOW") ? true : false;

    }
    
}
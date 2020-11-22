<?php namespace App\Libraries;

class UIComponents {
    public function SideMenu(array $params=[]){
        return view("templates/sidemenu_".$params['ecode']);
    }

    public function TopMenu(){
        return view("templates/topmenu");
    }

    public function UserPanel(){
        return view("templates/user_panel");
    }
}
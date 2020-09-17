<?php namespace App\Libraries;

class UIComponents {
    public function SideMenu(){
        return view("templates/sidemenu");
    }

    public function TopMenu(){
        return view("templates/topmenu");
    }

    public function UserPanel(){
        return view("templates/user_panel");
    }
}
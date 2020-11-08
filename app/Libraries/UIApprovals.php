<?php namespace App\Libraries;

class UIApprovals {
    public function New(){
        return view("approvals/approvals_new");
    }

    public function View(){
        return view("approvals/approvals_view");
    }

    public function Edit(){
        return view("approvals/approvals_edit");
    }

    public function List(){
        return view("approvals/approvals_list");
    }
    
}
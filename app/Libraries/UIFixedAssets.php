<?php namespace App\Libraries;

class UIFixedAssets {
    public function NewModal(){
        return view("fixed_assets/fixed_assets_new_modal");
    }

    public function ViewModal(){
        return view("fixed_assets/fixed_assets_view_modal");
    }

    public function EditModal(){
        return view("fixed_assets/fixed_assets_edit_modal");
    }

    public function DeleteModal(){
        return view("fixed_assets/fixed_assets_delete_modal");
    }
}
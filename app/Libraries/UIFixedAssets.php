<?php namespace App\Libraries;

class UIFixedAssets {
    public function NewModal(){
        return view("fixed_assets/fixed_assets_new_modal");
    }

    public function ViewModal(){
        return view("fixed_assets/fixed_assets_view_modal");
    }
}
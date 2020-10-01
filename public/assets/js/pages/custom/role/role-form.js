"use strict";

// Class definition
var KTRoleEdit = function () {
	// Base elements
	var avatar;

    var initToolbar = function() {
        console.log("initToolbar");
        $("#btn_save_and_continue").on("click",function(){            
            $("#after_action").val("save_and_continue");
            $("#kt_form").submit();
        });
        $("#btn_save_and_add").on("click",function(){            
            $("#after_action").val("save_and_add");
            $("#kt_form").submit();
        });
        $("#btn_save_and_exit").on("click",function(){            
            $("#after_action").val("save_and_exit");
            $("#kt_form").submit();            
        });
    }
    
    

    var initForm = function(){
        $("#kt_form").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("kt_form"));
            formData.append("return", "json");
            var urlTarget = "";
            switch($("#action").val()){
                case "new":
                    urlTarget = BASE_URL + "/Roles/New";
                    break;
                case "edit":
                    urlTarget = BASE_URL + "/Roles/Edit/" + $("#id").val();
                    break;
            }            
            $.ajax({
                url: urlTarget,
                type: "post",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(res){
                //console.log(res);
                if(res.error>0){
                    swal.fire({
                        html: "Sorry, looks like there are some errors detected, please try again." + res.lists_errors,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
                    return;
                } else {
                    swal.fire({
                        text: res.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                        console.log($("#after_action").val());
                        switch($("#after_action").val()){
                            case "save_and_continue":
                                if($("#action").val()=="new"){
                                    history.pushState({action: "edit",id: res.id}, 'Edit Role', '/Roles/Edit/' + res.id);
                                }
                                KTRoleEdit.initRole(res.id);
                                break;
                            case "save_and_add":
                                KTRoleEdit.initNew();
                                break;
                            case "save_and_exit":
                                window.location = BASE_URL + "/Roles";                             
                                break;                            
                        }                        
                        
                    });
                    return;
                }
            });
            // ... resto del código de mi ejercicio
        });
    }

	var initNewRoleForm = function() {
        //Design
        $("#main_title").html("New Role");
        $("#main_subtitle").html("-"); 
        $(".edit-role").addClass("d-none");
        $(".new-role").removeClass("d-none");
        $("#action").val("new");

        $("#kt_form")[0].reset();
        
    }

    var initEditRoleForm = function() {
        //Design
        $("#main_title").html("Edit Role");
        $("#main_subtitle").html("-");        
        $("#action").val("edit");
        $(".edit-role").removeClass("d-none"); //Avilita los controles de edicion
        $(".new-role").addClass("d-none"); //Avilita los controles de un nuevo record
        
        $("#kt_form")[0].reset();
        
    }
    
    var getRoleInfo = function(id){
        console.log("id: " + id);
        $.ajax({
            url: BASE_URL + "/Roles/GetRoleData/" + id,
            type: "post",
            dataType: "json"            
        })
        .done(function(res){
            console.log(res);                
            if(res.error>0){
                swal.fire({
                    html: "Sorry, looks like there are some errors detected, please try again." + res.lists_errors,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function() {
                    KTUtil.scrollTop();
                });              
                return;
            } else { 
                $("#main_subtitle").html(res.role_data.name);
                $("#name").val(res.role_data.name);
                $("#description").val(res.role_data.description);
                $("#id").val(res.role_data.id);
                return;
            }
        });
    }

	return {
		// public functions
		init: function() {
            initToolbar();
            initForm();
            console.log("DEFAULT_ACTION:" + DEFAULT_ACTION);
            switch (DEFAULT_ACTION) {
                case "new":
                    initNewRoleForm();
                    history.replaceState({action: "new"}, 'Default state', '/Roles/New');
                    break;
                case "edit":
                    console.log("edit:" + REQUEST_ID);
                    initEditRoleForm();
                    getRoleInfo(REQUEST_ID);
                    history.replaceState({action: "edit",id: REQUEST_ID}, 'Default state', '/Roles/Edit/' + REQUEST_ID);
                    break;
                default:
                    break;
            }
            window.addEventListener('popstate', e => {                
                switch(e.state.action){
                    case "new":
                        KTRoleEdit.initNew();
                        break;
                    case "edit":
                        KTRoleEdit.initRole(e.state.id);
                        break;
                    default:
                        console.log(e);
                }
            });
        },
        initRole: function(id){
            console.log("initRole: " + id);
            initEditRoleForm();
            getRoleInfo(id);
        },
        initNew: function(){
            initNewRoleForm();
        }

	};
}();

jQuery(document).ready(function() {
	KTRoleEdit.init();
});

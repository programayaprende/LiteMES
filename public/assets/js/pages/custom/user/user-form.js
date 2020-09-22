"use strict";

// Class definition
var KTUserEdit = function () {
	// Base elements
	var avatar;

    var initToolbar = function() {
        console.log("initToolbar");
        $("#btn_save_continue").on("click",function(){            
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
                    urlTarget = BASE_URL + "/Users/New";
                    break;
                case "edit":
                    urlTarget = BASE_URL + "/Users/Edit/" + $("#user_name").val();
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
                        if($("#action").val()=="new"){
                            history.pushState({action: "edit",user_name: res.user_name}, 'Edit User', '/Users/Edit/' + res.user_name);
                        }
                        KTUserEdit.initUser(res.user_name);                        
                    });
                    return;
                }
            });
            // ... resto del código de mi ejercicio
        });
    }

	var initNewUserForm = function() {
        //Design
        $("#main_title").html("New User");
        $("#main_subtitle").html("-"); 
        $(".edit-user").addClass("d-none");
        $(".new-user").removeClass("d-none");
        $("#action").val("new");

        //Inputs
        $("#password, #password_confirm, #user_name").prop("readonly",false);        
        $("#password_new, #password_new_verify").prop("readonly",true);

        $("#kt_form")[0].reset();
        
    }

    var initEditUserForm = function() {
        //Design
        $("#main_title").html("Edit User");
        $("#main_subtitle").html("-");        
        $("#action").val("edit");
        $(".edit-user").removeClass("d-none");
        $(".new-user").addClass("d-none");
        
        //Inputs
        $("#password, #password_confirm, #user_name").prop("readonly",true);        
        $("#password_new, #password_new_verify").prop("readonly",false);

        $("#kt_form")[0].reset();
        
    }
    
    var getUserInfo = function(user_name){
        console.log("user_name: " + user_name);
        $.ajax({
            url: BASE_URL + "/Users/GetUserData/" + user_name,
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
                $("#main_subtitle").html(res.user_data.first_name + " " + res.user_data.last_name + " ( " + res.user_data.user_name + " )");
                $("#first_name").val(res.user_data.first_name);
                $("#last_name").val(res.user_data.last_name);
                $("#job_description").val(res.user_data.job_description);
                $("#contact_phone").val(res.user_data.contact_phone);
                $("#email").val(res.user_data.email);
                $("#user_name").val(res.user_data.user_name);
                return;
            }
        });
    }

	return {
		// public functions
		init: function() {
            avatar = new KTImageInput('kt_user_edit_avatar');
            initToolbar();
            initForm();
            switch (DEFAULT_ACTION) {
                case "new":
                    initNewUserForm();
                    history.replaceState({action: "new"}, 'Default state', '/Users/New');
                    break;
                case "edit":
                    console.log("edit:" + REQUEST_USER_NAME);
                    initEditUserForm();
                    getUserInfo(REQUEST_USER_NAME);
                    history.replaceState({action: "edit",user_name: REQUEST_USER_NAME}, 'Default state', '/Users/Edit/' + REQUEST_USER_NAME);
                    break;
                default:
                    break;
            }
            window.addEventListener('popstate', e => {                
                switch(e.state.action){
                    case "new":
                        KTUserEdit.initNew();
                        break;
                    case "edit":
                        KTUserEdit.initUser(e.state.user_name);
                        break;
                    default:
                        console.log(e);
                }
            });
        },
        initUser: function(user_name){
            console.log("initUser: " + user_name);
            initEditUserForm();
            getUserInfo(user_name);
        },
        initNew: function(){
            initNewUserForm();
        }

	};
}();

jQuery(document).ready(function() {
	KTUserEdit.init();
});

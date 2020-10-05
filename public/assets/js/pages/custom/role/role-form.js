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
            console.log("res");
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
                
                dataUsers = res.users;
                reload_users_table();

                $.each( res.permissions, function( key, val ) {
                    $("#permission_" + val.id_permission).val(val.type);
                });


                
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

var dataTable;
var dataUsers = null;

var KTDatatablesDataSourceAjaxClient = function() {

	var initTable1 = function() {
                
        dataTable = $('#kt_datatable');

		// begin first table
		dataTable.DataTable({
			responsive: true,
			data: dataUsers,
			columnDefs: [
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {                        
                        return '\
							<div class="d-flex align-items-center">\
								<a href="javascript:removeUser(\'' + full[0] + '\');" class="btn btn-sm btn-clean btn-icon" title="Delete">\
									<i class="la la-trash"></i>\
								</a>\
							</div>\
						';
					},
				},
			],
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

function reload_users_table(){
    
    var table = $('#kt_datatable').DataTable();
    table.destroy();    
    KTDatatablesDataSourceAjaxClient.init();
    
}

function removeUser(user_name){
	$.ajax({
		url: BASE_URL + "/Roles/RemoveUser/" + $("#id").val() + "/" + user_name,
		dataType: "json",
		cache: false,
		contentType: false,
		processData: false
	})
	.done(function(res){
		console.log(res);
		if(res.error>0){
			swal.fire({
				html: res.message,
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				KTRoleEdit.initRole(res.id_role);
			});
			return;
		} else {
			swal.fire({
				html: res.message,
				icon: "success",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				console.log("Refrescar la tabla");
				KTRoleEdit.initRole(res.id_role);
			});
			return;
		}
	});
}

jQuery(document).ready(function() {
    KTRoleEdit.init();    
    KTDatatablesDataSourceAjaxClient.init();
});

function addUserModalAction(user_name){
    $.ajax({
		url: BASE_URL + "/Roles/AddUser/" + $("#id").val() + "/" + user_name,
		dataType: "json",
		cache: false,
		contentType: false,
        processData: false,
        error: function (xhr, error, code)
        {            
            swal.fire({
				html: code,
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			});
        },
	})
	.done(function(res){
		console.log(res);
		if(res.error>0){
			swal.fire({
				html: res.message,
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				KTRoleEdit.initRole(res.id_role);
			});
			return;
		} else {
			swal.fire({
				html: res.message,
				icon: "success",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				console.log("Refrescar la tabla");
				KTRoleEdit.initRole(res.id_role);
			});
			return;
		}
	});
}

var addUserModalTableInit = function() {

	var initTable1 = function() {
        var table = $('#addUserModalTable');
        
        table.DataTable().destroy();

        var conditionSearch = $("#addUserModalSearch").val();

		// begin first table
		table.DataTable({
            responsive: true,
            searching: false,
            bLengthChange: false,
            pageLength: 5,
			ajax: {
				url: BASE_URL + '/Users/Find',
				type: 'POST',
				data: {
                    condition : conditionSearch
                },
			},
			columns: [
				{data: 'user_name'},
				{data: 'actions', responsivePriority: -1},
			],
			columnDefs: [
				{
                    targets: -1,
                    "width": "50px",
					title: '\
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <i class="la la-plus"></i>\
                        </a>\
                        ',
					orderable: false,
					render: function(data, type, full, meta) {
                        console.log(full);
						return '\
							<a href="javascript:addUserModalAction(\'' + full.user_name + '\');" class="btn btn-sm btn-clean btn-icon" title="Delete">\
								<i class="la la-plus"></i>\
							</a>\
						';
					},
				},{
                    targets: -2,
					render: function(data, type, full, meta) {
                        console.log(full);
						return '\
							<strong>' + full.first_name + ' ' + full.last_name + '</strong> (' + full.user_name + ') <br>\
							' + full.job_description + '\
							\
						';
					},
				},				
			],
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

$("#addUserModalSearch" ).keyup(function() {
    if($("#addUserModalSearch" ).val().length>2){
        addUserModalTableInit.init();
    }
});

function showAddUserModal(){
    $("#addUserModal").modal("show");
    $("#addUserModalSearch").val("");
    addUserModalTableInit.init();
}

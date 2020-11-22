"use strict";
// Class definition

var table = $('#kt_datatable');

var KTAppsFixedAssetsListDatatable = function() {
	// Private functions

	// basic demo
	var _load_list = function() {
        
        table = $('#kt_datatable');

        table.DataTable({
            responsive: true,
            // DOM Layout settings
			dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": BASE_URL + "/FixedAssets/GetFixedAssets",
                "type": "POST",
                "data": function ( d ) {
                    d.myKey = "myValue";
                }
            },
            "columns": [
                { data: "id_fixed_asset" },
                { data: "description" },
                { data: "part_number" },
                { data: "brand" },
                { data: "model" },
                { data: "serial_no" },
                { data: "import_petition" },
                { data: "tariff_heading" },
                { data: "key" },
                { 
                    data: "id_fixed_asset",
                    render: function(data, type, row, meta) {
                        return "QR";
                        //return "<img src='" + BASE_URL + "/phpqrcode/litemes.php'>";
                    }
                },
                { 
                    data: "id_fixed_asset",
                    width: '125px',
                    render: function(data, type, row, meta) {
                        return '\
                        <div class="dropdown dropdown-inline">\
                            <a href="javascript:;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" data-toggle="dropdown">\
                                <span class="svg-icon svg-icon-md">\
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-icon">\
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                            <rect x="0" y="0" width="24" height="24"/>\
                                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>\
                                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>\
                                        </g>\
                                    </svg>\
                                </span>\
                            </a>\
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
                                <ul class="navi flex-column navi-hover py-2">\
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">\
                                        Choose an action:\
                                    </li>\
                                    <li class="navi-item">\
                                        <a href="javascript://" data-id-fixed-asset="' + row.id_fixed_asset + '" class="navi-link show-edit-modal">\
                                            <span class="navi-icon"><i class="la la-edit"></i></span>\
                                            <span class="navi-text">Edit</span>\
                                        </a>\
                                    </li>\
                                    <li class="navi-item">\
                                        <a href="javascript://" data-id-fixed-asset="' + row.id_fixed_asset + '" class="navi-link show-delete-modal">\
                                            <span class="navi-icon"><i class="la la-trash"></i></span>\
                                            <span class="navi-text">Delete</span>\
                                        </a>\
                                    </li>\
                                </ul>\
                            </div>\
                        </div>\
                        <a href="javascript://" data-id-fixed-asset="' + row.id_fixed_asset + '" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2 show-view-modal" title="View">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>\
                                        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                    }
                },
            ]
        });
        
		$("#btn_filter").on('click',function(){
            
            return;
            
			var filters = [];

			if($("#kt_daterangepicker_1").val().length>0){				
				datatable.setDataSourceParam('filter_registrationRange', $("#kt_daterangepicker_1").val().toLowerCase());
			} else {
				datatable.setDataSourceParam('filter_registrationRange',null);
			}
			
			if($("#filter_name").val()!=""){				
				datatable.setDataSourceParam('filter_name', $("#filter_name").val().toLowerCase());
			} else {
				datatable.setDataSourceParam('filter_name',null);
			}

			if($("#filter_approved").val()!=""){
				datatable.setDataSourceParam('filter_approved', $("#filter_approved").val().toLowerCase());
			} else {
				datatable.setDataSourceParam('filter_approved', null);
			}
			
			if($("#filter_locked").val()!=""){
				datatable.setDataSourceParam('filter_locked', $("#filter_locked").val().toLowerCase());
			} else {
				datatable.setDataSourceParam('filter_locked', null);
			}

			datatable.load();
						
		});
    };

    var _refreshList = function(){
        console.log("_refreshList");
        table.DataTable().ajax.reload();
    }
    
    var _setup_ui = function(){
        $(".show-new-modal").on("click",function(){
            console.log("show-new-modal");

            $('#form-new-modal').trigger("reset");
            $('.save-new-modal').attr("disabled", false);
            $("#newFixedAssetModal").modal("show");

        });

        $(document).on('click','.show-edit-modal',function(){
            
            console.log("show-edit-modal");
            var id_fixed_asset = $(this).attr("data-id-fixed-asset");            

            $.ajax({
                url: BASE_URL + "/FixedAssets/View",
                type: "post",                
                data: {"id_fixed_asset": id_fixed_asset },
            })
            .fail(function(jqXHR, textStatus, errorThrown ){
                try{
                    textStatus = jqXHR.responseJSON.lists_errors;
                }catch(error){

                }
                swal.fire({
                    html: "Sorry, looks like there are some errors detected, please try again. <br>" + textStatus + "",
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
                    $('#form-edit-modal').trigger("reset");
                    console.log(res);
                    $('#form-edit-modal input[name="id_fixed_asset"]').val(res.fixed_asset.id_fixed_asset);
                    $('#form-edit-modal textarea[name="description"]').val(res.fixed_asset.description);                    
                    $('#form-edit-modal input[name="part_number"]').val(res.fixed_asset.part_number);
                    $('#form-edit-modal input[name="brand"]').val(res.fixed_asset.brand);
                    $('#form-edit-modal input[name="model"]').val(res.fixed_asset.model);
                    $('#form-edit-modal input[name="serial_no"]').val(res.fixed_asset.serial_no);
                    $('#form-edit-modal input[name="import_petition"]').val(res.fixed_asset.import_petition);
                    $('#form-edit-modal input[name="tariff_heading"]').val(res.fixed_asset.tariff_heading);
                    $('#form-edit-modal input[name="key"]').val(res.fixed_asset.key);
                    $('.save-edit-modal').attr("disabled", false);
                    $("#editFixedAssetModal").modal("show");
                    return;
                }
            });           

        });

        $(document).on('click','.show-view-modal',function(){
            
            console.log("show-view-modal");
            var id_fixed_asset = $(this).attr("data-id-fixed-asset");            

            $.ajax({
                url: BASE_URL + "/FixedAssets/View",
                type: "post",                
                data: {"id_fixed_asset": id_fixed_asset },
            })
            .fail(function(jqXHR, textStatus, errorThrown ){
                try{
                    textStatus = jqXHR.responseJSON.lists_errors;
                }catch(error){

                }
                swal.fire({
                    html: "Sorry, looks like there are some errors detected, please try again. <br>" + textStatus + "",
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
                    $('#form-view-modal').trigger("reset");
                    console.log(res);
                    $('#form-view-modal input[name="id_fixed_asset"]').val(res.fixed_asset.id_fixed_asset);
                    $('#form-view-modal textarea[name="description"]').val(res.fixed_asset.description);                    
                    $('#form-view-modal input[name="part_number"]').val(res.fixed_asset.part_number);
                    $('#form-view-modal input[name="brand"]').val(res.fixed_asset.brand);
                    $('#form-view-modal input[name="model"]').val(res.fixed_asset.model);
                    $('#form-view-modal input[name="serial_no"]').val(res.fixed_asset.serial_no);
                    $('#form-view-modal input[name="import_petition"]').val(res.fixed_asset.import_petition);
                    $('#form-view-modal input[name="tariff_heading"]').val(res.fixed_asset.tariff_heading);
                    $('#form-view-modal input[name="key"]').val(res.fixed_asset.key);
                    $('.save-view-modal').attr("disabled", false);
                    $("#viewFixedAssetModal").modal("show");
                    return;
                }
            });           

        });

        $(document).on('click','.show-delete-modal',function(){            
            console.log("show-delete-modal");            
            $("#deleteFixedAssetModal").modal("show");
            var id_fixed_asset = $(this).attr("data-id-fixed-asset");
            $('#form-delete-modal input[name="id_fixed_asset"]').val(id_fixed_asset);
        });

        $(".save-delete-modal").on("click",function(){
            console.log("delete-modal");
            $(this).attr("disabled", true);
            
            var formData = new FormData(document.getElementById("form-delete-modal"));

            $.ajax({
                url: BASE_URL + "/FixedAssets/Delete",
                type: "post",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .fail(function(jqXHR, textStatus, errorThrown ){                
                console.log(textStatus);
                console.log(jqXHR);
                try{

                    textStatus = jqXHR.responseJSON.lists_errors;
                }catch(error){

                }
                swal.fire({
                    html: "Sorry, looks like there are some errors detected, please try again. <br>" + textStatus + "",
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
                        $('#form-delete-modal').trigger("reset");
                        $("#deleteFixedAssetModal").modal("hide");
                        KTUtil.scrollTop();
                        _refreshList();
                    });
                    return;
                }
            });
            

        });

        $(".save-edit-modal").on("click",function(){
            console.log("save-edit-modal");
            $(this).attr("disabled", true);
            
            var formData = new FormData(document.getElementById("form-edit-modal"));

            $.ajax({
                url: BASE_URL + "/FixedAssets/Edit",
                type: "post",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .fail(function(jqXHR, textStatus, errorThrown ){                
                console.log(textStatus);
                console.log(jqXHR);
                try{

                    textStatus = jqXHR.responseJSON.lists_errors;
                }catch(error){

                }
                swal.fire({
                    html: "Sorry, looks like there are some errors detected, please try again. <br>" + textStatus + "",
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
                        $('#form-edit-modal').trigger("reset");
                        $("#editFixedAssetModal").modal("hide");
                        KTUtil.scrollTop();
                        _refreshList();
                    });
                    return;
                }
            });
            

        });

        $(".save-new-modal").on("click",function(){
            console.log("save-new-modal");
            $(this).attr("disabled", true);
            
            var formData = new FormData(document.getElementById("form-new-modal"));

            $.ajax({
                url: BASE_URL + "/FixedAssets/New",
                type: "post",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .fail(function(jqXHR, textStatus, errorThrown ){                
                console.log(textStatus);
                console.log(jqXHR);
                try{

                    textStatus = jqXHR.responseJSON.lists_errors;
                }catch(error){

                }
                swal.fire({
                    html: "Sorry, looks like there are some errors detected, please try again. <br>" + textStatus + "",
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
                        $('#form-new-modal').trigger("reset");
                        $("#newFixedAssetModal").modal("hide");
                        KTUtil.scrollTop();
                        _refreshList();
                    });
                    return;
                }
            });
            

        });
    };

	return {
		// public functions
		init: function() {
            _setup_ui();
			_load_list();
		},
	};
}();

var KTBootstrapDaterangepicker = function () {

    // Private functions
    var setupDatePickers = function () {
		
		var start = moment().subtract(1, 'years');
        var end = moment();	

        $('#kt_daterangepicker_1').daterangepicker({
			startDate: start,
			endDate: end,
			buttonClasses: ' btn',
            applyClass: 'btn-primary',
			cancelClass: 'btn-secondary',
			showWeekNumbers: true,
			autoApply: false,
			locale: {
				format: 'YYYY-MM-DD'
			}
        });        
    }    

    return {
        // public functions
        init: function() {
            setupDatePickers();            
        }
    };
}();

function quickEdit(user_name,action){
	$.ajax({
		url: BASE_URL + "/Users/" + action + "/" + user_name,
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
				$('#kt_datatable').KTDatatable().reload();
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
				$('#kt_datatable').KTDatatable().reload();
			});
			return;
		}
	});
}


jQuery(document).ready(function() {
	KTAppsFixedAssetsListDatatable.init();
	KTBootstrapDaterangepicker.init();
});

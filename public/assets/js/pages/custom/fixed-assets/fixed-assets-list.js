"use strict";
// Class definition

var KTAppsFixedAssetsListDatatable = function() {
	// Private functions

	// basic demo
	var _load_list = function() {
        
        var table = $('#kt_datatable');

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
                { "data": "id_fixed_assets" },
                { "data": "description" },
                { "data": "part_number" },
                { "data": "brand" },
                { "data": "model" },
                { "data": "serial_no" },
                { "data": "import_petition" },
                { "data": "tariff_heading" },
                { "data": "key" },
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
    
    var _setup_ui = function(){
        $(".show-new-modal").on("click",function(){
            console.log("show-new-modal");

            $(this).attr("disabled", false);

            $("#newFixedAssetModal").modal("show");

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
                var msg = "";
                console.log(textStatus);
                console.log(jqXHR);
                swal.fire({
                    html: "Sorry, looks like there are some errors detected, please try again. <br>(" + textStatus + ")",
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
                        KTUtil.scrollTop();
                        console.log($("#after_action").val());
                        switch($("#after_action").val()){
                            case "save_and_continue":
                                if($("#action").val()=="new"){
                                    history.pushState({action: "edit",user_name: res.user_name}, 'Edit User', '/Users/Edit/' + res.user_name);
                                }
                                KTUserEdit.initUser(res.user_name);
                                break;
                            case "save_and_add":
                                KTUserEdit.initNew();
                                break;
                            case "save_and_exit":
                                window.location = BASE_URL + "/Users";                             
                                break;                            
                        }                        
                        
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

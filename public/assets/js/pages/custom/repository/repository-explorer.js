
"use strict";
// Class definition

var KTAppsRepositoryListDatatable = function() {
	// Private functions

	// basic demo
	var _demo = function() {
		var datatable = $('#kt_datatable').KTDatatable({
			// datasource definition
			data: {
				saveState : false,
				type: 'remote',
				source: {
					read: {
						url: BASE_URL + '/Repository/GetFiles',
					},
				},
				pageSize: 10, // display 20 records per page
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
				minHeight: 500,
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#kt_subheader_search_form'),
				delay: 400,
				key: 'generalSearch'
			},

			// columns definition
			columns: [
				{
					field: 'name',
					title: 'Name',
					sortable: 'asc',					
					selector: false,
					textAlign: 'left',
					template: function(data) {
						return '<span class="font-weight-bolder">' + data.name + '</span>';
					}
				}, {
					field: 'description',
					title: 'Description',					
				},  {
					field: 'created_at',
					title: 'Registered',
					type: 'date',
					width: 'auto',
					format: 'YYYY-MM-DD',
					template: function(row) {
						var output = '';						
						output += '<div class="font-weight-bolder text-primary mb-0">' + row.created_at + '</div>';
						return output;
					},
				}, {
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					overflow: 'visible',
					autoHide: false,
					template: function(row) {
						return '\
	                        <a href="javascript: window.location= BASE_URL + \'/Repository/Edit/' + row.id + '\' ;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">\
	                            <span class="svg-icon svg-icon-md">\
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
											<rect x="0" y="0" width="24" height="24"/>\
											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>\
											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>\
										</g>\
									</svg>\
	                            </span>\
	                        </a>\
	                    ';
					},
				}],
		});
		
		$("#btn_filter").on('click',function(){
			
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
			
			datatable.load();
						
		});
	};

	return {
		// public functions
		init: function() {
			_demo();
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



function quickEdit(repository_name,action){
	$.ajax({
		url: BASE_URL + "/Repository/" + action + "/" + repository_name,
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
	KTAppsRepositoryListDatatable.init();
	KTBootstrapDaterangepicker.init();
	KTDropzoneDemo.init();

	$("#addFileModalButton").click(function(){
		myDropzone5.removeAllFiles();
		$("#addFileModal").modal("show");
		$("#filesAdded").html('');
		$("#filesDescription").val('');
	});
});


function saveFiles(){

	var myform = document.getElementById("addFileModalForm");
    var fd = new FormData(myform);

    $.ajax({
		url: BASE_URL + "/Repository/FileUpload",
		method: "post",
		dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
		data: fd
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
				myDropzone5.removeAllFiles();
				$("#addFileModal").modal("hide");
				$("#filesAdded").html('');
				$("#filesDescription").val('');
				$("#filesTags").val('');
			});
			return;
		}
	});
}

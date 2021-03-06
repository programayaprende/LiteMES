"use strict";
// Class definition

var KTAppsUsersListDatatable = function() {
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
						url: BASE_URL + '/Users/GetUsers',
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
					field: 'user_name',
					title: 'Username',
					width: 'auto',
					sortable: 'asc',					
					type: 'number',
					selector: false,
					textAlign: 'left',
					template: function(data) {
						return '<span class="font-weight-bolder">' + data.user_name + '</span>';
					}
				}, {
					field: 'full_name',
					title: 'Name',
					width: 'auto',
					template: function(data) {
						var number = KTUtil.getRandomInt(1, 14);
						var user_img = '100_' + number + '.jpg';
						var output = '';
						if (number > 8) {
							output = '<div class="d-flex align-items-center">\
								<div class="symbol symbol-40 symbol-sm flex-shrink-0">\
									<img class="" src="' + BASE_URL + '/assets/media/users/' + user_img + '" alt="photo">\
								</div>\
								<div class="ml-4">\
									<div class="text-dark-75 font-weight-bolder font-size-lg mb-0">' + data.first_name + ' ' + data.last_name + '</div>\
									' + data.email + '\
								</div>\
							</div>';
						}
						else {
							var stateNo = KTUtil.getRandomInt(0, 7);
							var states = [
								'success',
								'primary',
								'danger',
								'success',
								'warning',
								'dark',
								'primary',
								'info'];
							var state = states[stateNo];

							output = '<div class="d-flex align-items-center">\
								<div class="symbol symbol-40 symbol-light-'+state+' flex-shrink-0">\
									<span class="symbol-label font-size-h4 font-weight-bold">' + data.first_name.substring(0, 1) + '</span>\
								</div>\
								<div class="ml-4">\
									<div class="text-dark-75 font-weight-bolder font-size-lg mb-0">' + data.first_name + ' ' + data.last_name + '</div>\
									' + data.email + '\
								</div>\
							</div>';
						}

						return output;
					}
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
					field: 'job_description',
					title: 'Job',
					template: function(row) {
						var output = '';

						output += '<div class="font-weight-bold text-muted">' + row.job_description + '</div>';

						return output;
					}
				}, {
					field: 'approved',
					title: 'Approved',
					width: 'auto',					
					template: function(row) {
						var status = {
							0: {'title': 'Pending', 'class': ' label-light-primary'},
							1: {'title': 'Approved', 'class': ' label-light-success'},							
						};
						return '<span class="label label-lg font-weight-bold ' + status[row.approved].class + ' label-inline">' + status[row.approved].title + '</span>';
					},
				},{
					field: 'status',
					title: 'Status',
					width: 'auto',					
					template: function(row) {
						var status = {
							0: {'title': 'Active', 'class': ' label-light-success'},
							1: {'title': 'Locked', 'class': ' label-light-danger'},							
						};
						return '<span class="label label-lg font-weight-bold ' + status[row.locked].class + ' label-inline">' + status[row.locked].title + '</span>';
					},
				}, {
					field: 'Actions',
					title: 'Actions',
					sortable: false,					
					overflow: 'visible',
					autoHide: false,
					template: function(row) {
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
	                                        <a href="javascript: quickEdit(\'' + row.user_name + '\',\'Approve\')" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-print"></i></span>\
	                                            <span class="navi-text">Approve</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="javascript: quickEdit(\'' + row.user_name + '\',\'Lock\')" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-copy"></i></span>\
	                                            <span class="navi-text">Lock User</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="javascript: quickEdit(\'' + row.user_name + '\',\'Unlock\')" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-file-excel-o"></i></span>\
	                                            <span class="navi-text">Active User</span>\
	                                        </a>\
	                                    </li>\
	                                </ul>\
	                            </div>\
	                        </div>\
	                        <a href="javascript: window.location= BASE_URL + \'/Users/Edit/' + row.user_name + '\' ;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">\
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
	KTAppsUsersListDatatable.init();
	KTBootstrapDaterangepicker.init();
});

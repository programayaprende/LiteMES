					<!--begin::Modal-->
					<div class="modal fade" id="addFileModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content UppyForm">
								<div class="modal-header">
									<h5 class="modal-title" id="addFileModalLabel">Upload Files Form</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<i aria-hidden="true" class="ki ki-close"></i>
									</button>
								</div>								
								<div id="addFileModalBody" class="modal-body">
									<!--begin::form-->
									<form id="addFileModalForm" action="http://localhost/Repository/FileUpload" method="post">										
										<div class="form-group">
											<label class="">Files description</label>
											<textarea class="form-control" id="filesDescription" name="filesDescription" rows="3" placeholder="Files description or information"></textarea>
											<span class="form-text text-muted">Files description or information, this information is used to improve file searching</span>
										</div>
										<div id="filesAdded">
										</div>
										<div class="form-group">
											<label class="">Upload Files</label>
											<div class="dropzone dropzone-multi" id="kt_dropzone_5">
												<div class="dropzone-panel mb-lg-0 mb-2">
													<a class="dropzone-select btn btn-light-primary font-weight-bold btn-sm">Attach files</a>
												</div>
												<div class="dropzone-items">
													<div class="dropzone-item" style="display:none">
														<div class="dropzone-file">
															<div class="dropzone-filename" title="some_image_file_name.jpg">
																<span data-dz-name="">some_image_file_name.jpg</span>
																<strong>(
																<span data-dz-size="">340kb</span>)</strong>
															</div>
															<div class="dropzone-error" data-dz-errormessage=""></div>
														</div>
														<div class="dropzone-progress">
															<div class="progress">
																<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
															</div>
														</div>
														<div class="dropzone-toolbar">
															<span class="dropzone-delete" data-dz-remove="">
																<i class="flaticon2-cross"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<span class="form-text text-muted">Max file size is 1MB and max number of files is 5.</span>
										</div>
									</form>
									<!--end::form-->
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary" onclick="saveFiles()">Upload files</button>
								</div>
							</div>
						</div>
					</div>
					<!--end::Modal-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
							<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Details-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Title-->
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">File Explorer</h5>
									<!--end::Title-->
									<!--begin::Separator-->
									<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
									<!--end::Separator-->
									<!--begin::Search Form-->
									<div class="d-flex align-items-center" id="kt_subheader_search">										
										<form class="">
											<div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
												<input type="text" class="form-control" id="kt_subheader_search_form" placeholder="Search..." />
												<div class="input-group-append">
													<span class="input-group-text">
														<span class="svg-icon">
															<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																	<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
														<!--<i class="flaticon2-search-1 icon-sm"></i>-->
													</span>
												</div>
											</div>
										</form>
									</div>
									<!--end::Search Form-->									
								</div>
								<!--end::Details-->
								<!--begin::Toolbar-->
								<div class="d-flex align-items-center">
									<!--begin::Button-->
									<a href="#" class=""></a>
									<!--end::Button-->

									<!--begin::Button-->
									<a href="javascript:;" id="addFileModalButton" class="btn btn-light-primary font-weight-bold ml-2">Upload files</a>
									<!--end::Button-->

								</div>
								<!--end::Toolbar-->
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container-fluid"> <!---fluid-->								
								<div class="row">
									<div class="col-lg-3 col-xl-2">
										<div class="card card-custom ">
											<div class="card-header " style="padding-left:20px; padding-right:20px;">
												<div class="card-title">
													<span class="card-icon">
														<i class="flaticon2-chat-1 text-primary"></i>
													</span>
													<h3 class="card-label">Filters</h3>
												</div>
												<div class="card-toolbar">
													<button class="btn btn-sm btn-light-primary font-weight-bold" id="btn_filter">
													Apply</button>
												</div>
											</div>											
											<div class="card-body" style="padding-left:20px; padding-right:20px;">
												<div class="form-group ">
													<label class="col-form-label">Registration Date</label>
													<input class="form-control" id="kt_daterangepicker_1" readonly="readonly" placeholder="Select" type="text">													
												</div>
												<div class="form-group">
													<label for="filter_name">Name</label>
													<input type="text" class="form-control" id="filter_name"  placeholder="Enter repository name"/>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-9 col-xl-10">
										<!--begin::Card-->
										<div class="card card-custom">
											<!--begin::Body-->
											<div class="card-body">
												<!--begin: Datatable-->
												<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
												<!--end: Datatable-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card-->
									</div>									
								</div>
							</div>
							<!--end::Container-->

						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->					
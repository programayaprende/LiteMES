                <!--begin::View-->
                <div class="flex-row-fluid ml-lg-8 d-none" id="kt_inbox_view">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                            <!--begin::Left-->
                            <div class="d-flex align-items-center my-2 d-none">
                                <!--<a href="#" class="btn btn-clean btn-icon btn-sm mr-6" data-inbox="back">
                                    <i class="flaticon2-left-arrow-1"></i>
                                </a>-->
                                <div class="font-weight-bold text-muted">UID: <span id="view_approval_hash"></span></div>
                            </div>
                            <!--end::Left-->
                            <!--begin::Right-->
                            <div class="d-flex align-items-center justify-content-end text-right my-2">                                
                                <span class="btn btn-default btn-icon btn-sm mr-2 d-none" id="btn-approve" data-toggle="tooltip" title="" data-original-title="Approve">
                                    <i class="ki ki-bold-check icon-sm"></i>
                                </span>
                                <span class="btn btn-default btn-icon btn-sm mr-2 d-none" id="btn-reject" data-toggle="tooltip" title="" data-original-title="Reject">
                                    <i class="ki ki-bold-close icon-sm"></i>
                                </span>                                
                                <div class="dropdown" data-toggle="tooltip" title="Options">
                                    <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
                                        <i class="ki ki-bold-more-hor icon-1x"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-md">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover py-5">
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-drop"></i>
                                                    </span>
                                                    <span class="navi-text">Print</span>
                                                </a>
                                            </li>                                            
                                            <li class="navi-separator my-3"></li>                                            
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-magnifier-tool"></i>
                                                    </span>
                                                    <span class="navi-text">Help</span>
                                                </a>
                                            </li>                                            
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Right-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <!--begin::Header-->
                            <div class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x py-5">
                                <!--begin::Title-->
                                <div class="d-flex align-items-center mr-2 py-2">
                                    <div class="font-weight-bold font-size-h3 mr-3" id="view_subject"></div>                                    
                                </div>
                                <!--end::Title-->                                
                            </div>
                            <!--end::Header-->
                            <!--begin::Messages-->
                            <div class="mb-3">
                                <div id="view_approval_path">
                                    
                                </div>
                                
                                <div class="shadow-xs toggle-on" data-inbox="message">
                                    <div class="d-flex align-items-center card-spacer-x py-6">
                                        <span class="symbol symbol-50 mr-4">
                                            <span class="symbol-label" style="background-image: url('<?=base_url()?>/assets/media/users/100_13.jpg')"></span>
                                        </span>
                                        <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                            <div class="d-flex">
                                                <a href="#" class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2" id="view_drafter">-</a>
                                                <div class="font-weight-bold text-muted" id="view_drafter_job_description">-</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="font-weight-bold text-muted mr-2" id="view_submit_at">-</div>
                                        </div>
                                    </div>
                                    <div class="card-spacer-x py-3 toggle-off-item" id="view_body">                                        
                                    </div>

                                    <div class="card-spacer-x d-flex flex-column font-size-sm font-weight-bold pb-6" id="view_files">
                                        
                                    </div>
                                </div>
                                                                
                            </div>
                            <!--end::Messages-->                            
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::New-->
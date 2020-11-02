    <!--begin::List-->
    <div class="flex-row-fluid ml-lg-8 d-none" id="kt_inbox_list">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
                <!--begin::Toolbar-->
                <div class="col-12 col-sm-6 col-xxl-4 order-2 order-xxl-1 d-flex flex-wrap align-items-center">
                    <div class="d-flex align-items-center mr-1 my-2">                        
                        <span class="btn btn-clean btn-icon btn-sm mr-2" data-toggle="tooltip" title="Reload list">
                            <i class="ki ki-refresh icon-1x"></i>
                        </span>
                    </div>
                </div>
                <!--end::Toolbar-->
                <!--begin::Search-->
                <div class="col-xxl-3 d-flex order-1 order-xxl-2 align-items-center justify-content-center">
                    <div class="input-group input-group-lg input-group-solid my-2">
                        <input type="text" class="form-control pl-4" placeholder="Search..." id="list_search_text" />
                        <div class="input-group-append">
                            <span class="input-group-text pr-3">
                                <span class="svg-icon svg-icon-lg">
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
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Search-->
                <!--begin::Pagination-->
                <div class="col-12 col-sm-6 col-xxl-4 order-2 order-xxl-3 d-flex align-items-center justify-content-sm-end text-right my-2">
                    <!--begin::Per Page Dropdown-->
                    <!--
                    <div class="d-flex align-items-center mr-2">
                        <span class="text-muted font-weight-bold mr-2">1 - 50 of 235</span>                        
                    </div>
                    -->
                    <!--end::Per Page Dropdown-->
                    <!--begin::Arrow Buttons-->
                    <!--
                    <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Previose page">
                        <i class="ki ki-bold-arrow-back icon-sm"></i>
                    </span>
                    <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Next page">
                        <i class="ki ki-bold-arrow-next icon-sm"></i>
                    </span>
                    -->
                    <!--end::Arrow Buttons-->
                    <!--begin::Sort Dropdown-->
                    <div class="dropdown mr-2" data-toggle="tooltip" title="Sort">
                        <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
                            <i class="flaticon2-console icon-1x"></i>
                        </span>
                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                            <ul class="navi py-3">
                                <li class="navi-item">
                                    <a href="#" class="navi-link active">
                                        <span class="navi-text">Newest</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">Olders</span>
                                    </a>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <!--end::Sort Dropdown-->                                
                </div>
                <!--end::Pagination-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body table-responsive">
                <!--begin: Datatable-->
                <table class="table table-hover" id="kt_datatable" style="">
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
                <?
                if(false){
                ?>
                <!--begin::Items-->
                <div class="d-none list list-hover min-w-500px" data-inbox="list" id="approval_list_table">                                        
                                    
                </div>
                <!--end::Items-->
                <?
                }
                ?>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::List-->
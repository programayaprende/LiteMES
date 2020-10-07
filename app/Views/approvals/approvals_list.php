    <!--begin::List-->
    <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
                <!--begin::Toolbar-->
                <div class="col-12 col-sm-6 col-xxl-4 order-2 order-xxl-1 d-flex flex-wrap align-items-center">
                    <div class="d-flex align-items-center mr-1 my-2">
                        <label data-inbox="group-select" class="checkbox checkbox-inline checkbox-primary mr-3">
                            <input type="checkbox" />
                            <span class="symbol-label"></span>
                        </label>
                        <div class="dropdown">
                            <span class="btn btn-clean btn-icon btn-sm mr-1" data-toggle="dropdown">
                                <i class="ki ki-bold-arrow-down icon-sm"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-left p-0 m-0 dropdown-menu-sm">
                                <ul class="navi py-3">
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">All</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">Read</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">Unread</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">Starred</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">Unstarred</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <span class="btn btn-clean btn-icon btn-sm mr-2" data-toggle="tooltip" title="Reload list">
                            <i class="ki ki-refresh icon-1x"></i>
                        </span>
                    </div>                                
                </div>
                <!--end::Toolbar-->
                <!--begin::Search-->
                <div class="col-xxl-3 d-flex order-1 order-xxl-2 align-items-center justify-content-center">
                    <div class="input-group input-group-lg input-group-solid my-2">
                        <input type="text" class="form-control pl-4" placeholder="Search..." />
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
                    <div class="d-flex align-items-center mr-2" data-toggle="tooltip" title="Records per page">
                        <span class="text-muted font-weight-bold mr-2" data-toggle="dropdown">1 - 50 of 235</span>
                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                            <ul class="navi py-3">
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">20 per page</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link active">
                                        <span class="navi-text">50 par page</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">100 per page</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Per Page Dropdown-->
                    <!--begin::Arrow Buttons-->
                    <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Previose page">
                        <i class="ki ki-bold-arrow-back icon-sm"></i>
                    </span>
                    <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Next page">
                        <i class="ki ki-bold-arrow-next icon-sm"></i>
                    </span>
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
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">Unread</span>
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
            <div class="card-body table-responsive px-0">
                <!--begin::Items-->
                <div class="list list-hover min-w-500px" data-inbox="list">
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <span class="symbol symbol-35 mr-3">
                                    <span class="symbol-label" style="background-image: url('<?=base_url()?>/assets/media/users/100_13.jpg')"></span>
                                </span>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Sean Paul</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Digital PPV Customer Confirmation -</span>
                                <span class="text-muted">Thank you for ordering UFC 240 Holloway vs Edgar Alternate camera angles...</span>
                            </div>
                            <div class="mt-2">
                                <span class="label label-light-primary font-weight-bold label-inline mr-1">inbox</span>
                                <span class="label label-light-danger font-weight-bold label-inline">task</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-bolder w-50px text-right" data-toggle="view">8:30 PM</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <div class="symbol symbol-light-danger symbol-35 mr-3">
                                    <span class="symbol-label font-weight-bolder">OJ</span>
                                </div>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Oliver Jake</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Your iBuy.com grocery shopping confirmation -</span>
                                <span class="text-muted">Please make sure that you have one of the following cards with you when we deliver your order...</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-bolder w-100px text-right" data-toggle="view">day ago</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <div class="symbol symbol-light-primary symbol-35 mr-3">
                                    <span class="symbol-label font-weight-bolder">EF</span>
                                </div>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Enrico Fermi</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Your Order #224820998666029 has been Confirmed -</span>
                                <span class="text-muted">Your Order #224820998666029 has been placed on Saturday, 29 June</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">11:20PM</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <span class="symbol symbol-35 mr-3">
                                    <span class="symbol-label" style="background-image: url('<?=base_url()?>/assets/media/users/100_2.jpg')"></span>
                                </span>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Jane Goodall</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Payment Notification DLOP2329KD -</span>
                                <span class="text-muted">Your payment of 4500USD to AirCar has been authorized and confirmed, thank you your account. This...</span>
                            </div>
                            <div class="mt-2">
                                <span class="label label-light-danger font-weight-bold label-inline">new</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">2 days ago</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <div class="symbol symbol-light-success symbol-35 mr-3">
                                    <span class="symbol-label font-weight-bolder">MP</span>
                                </div>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Max O'Brien Planck</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Congratulations on your iRun Coach subscription -</span>
                                <span class="text-muted">Congratulations on your iRun Coach subscription. You made no space for excuses and you</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 25</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <span class="symbol symbol-35 mr-3">
                                    <span class="symbol-label" style="background-image: url('<?=base_url()?>/assets/media/users/100_4.jpg')"></span>
                                </span>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Rita Levi-Montalcini</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Pay bills &amp; win up to 600$ Cashback! -</span>
                                <span class="text-muted">Congratulations on your iRun Coach subscription. You made no space for excuses and you decided on a healthier and happier life...</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 24</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <span class="symbol symbol-35 mr-3">
                                    <span class="symbol-label" style="background-image: url('<?=base_url()?>/assets/media/users/100_5.jpg')"></span>
                                </span>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Stephen Hawking</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Activate your LIPO Account today -</span>
                                <span class="text-muted">Thank you for creating a LIPO Account. Please click the link below to activate your account.</span>
                            </div>
                            <div class="mt-2">
                                <span class="label label-light-warning font-weight-bold label-inline mr-2">task</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 13</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <div class="symbol symbol-light symbol-35 mr-3">
                                    <span class="symbol-label text-dark-75 font-weight-bolder">WE</span>
                                </div>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Wolfgang Ernst Pauli</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">About your request for PalmLake -</span>
                                <span class="text-muted">What you requested can't be arranged ahead of time but PalmLake said they'll do their best to accommodate you upon arrival....</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-bold text-muted w-100px text-right" data-toggle="view">25 May</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <span class="symbol symbol-35 mr-3">
                                    <span class="symbol-label" style="background-image: url('<?=base_url()?>/assets/media/users/100_6.jpg')"></span>
                                </span>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Patty Jo Watson</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Welcome, Patty -</span>
                                <span class="text-muted">Discover interesting ideas and unique perspectives. Read, explore and follow your interests. Get personalized recommendations delivered to you....</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 24</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <span class="symbol symbol-35 mr-3">
                                    <span class="symbol-label" style="background-image: url('<?=base_url()?>/assets/media/users/100_8.jpg')"></span>
                                </span>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Blaise Pascal</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Free Video Marketing Guide -</span>
                                <span class="text-muted">Video has rolled into every marketing platform or channel, leaving...</span>
                            </div>
                            <div class="mt-2">
                                <span class="label label-light-success font-weight-bold label-inline">project</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">July 13</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <div class="symbol symbol-light-warning symbol-35 mr-3">
                                    <span class="symbol-label font-weight-bolder">RO</span>
                                </div>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Roberts O'Neill Wilson</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Your iBuy.com grocery shopping confirmation -</span>
                                <span class="text-muted">Please make sure that you have one of the following cards with you when we deliver your order...</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-bolder w-100px text-right" data-toggle="view">day ago</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <div class="symbol symbol-light-primary symbol-35 mr-3">
                                    <span class="symbol-label font-weight-bolder">EF</span>
                                </div>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Enrico Fermi</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Your Order #224820998666029 has been Confirmed -</span>
                                <span class="text-muted">Your Order #224820998666029 has been placed on Saturday, 29 June</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">11:20PM</div>
                        <!--end::Datetime-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" />
                                    <span></span>
                                </label>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Star">
                                    <i class="flaticon-star text-muted"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning active" data-toggle="tooltip" data-placement="right" title="Mark as important">
                                    <i class="flaticon-add-label-button text-muted"></i>
                                </a>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
                                <span class="symbol symbol-35 mr-3">
                                    <span class="symbol-label" style="background-image: url('<?=base_url()?>/assets/media/users/100_10.jpg')"></span>
                                </span>
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">Jane Goodall</a>
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Info-->
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <div>
                                <span class="font-weight-bolder font-size-lg mr-2">Payment Notification DLOP2329KD -</span>
                                <span class="text-muted">Your payment of 4500USD to AirCar has been authorized and confirmed, thank you your account. This...</span>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Datetime-->
                        <div class="mt-2 mr-3 font-weight-normal w-100px text-right text-muted" data-toggle="view">2 days ago</div>
                        <!--end::Datetime-->
                    </div>
                </div>
                <!--end::Items-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::List-->
                <!--begin::New-->
                <div class="flex-row-fluid ml-lg-8 d-none" id="kt_inbox_new">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                            <!--begin::Left-->
                            <div class="d-flex align-items-center my-2">
                                <a href="#" class="btn btn-clean btn-icon btn-sm mr-6" data-inbox="back">
                                    <i class="flaticon2-left-arrow-1"></i>
                                </a>                                                                
                            </div>
                            <!--end::Left-->                            
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <!--begin::Form-->
                            <form id="kt_inbox_reply_form">
                                <!--begin::Body-->
                                <div class="d-block">
                                    <!--begin::Subject-->
                                    <div class="border-bottom">
                                        <input class="form-control border-0 px-8 min-h-45px" name="compose_subject" placeholder="Subject" />
                                    </div>
                                    <!--end::Subject-->                                    
                                    <!--begin::Add User-->
                                    <div class="d-flex align-items-center border-bottom  inbox-to px-8 min-h-50px">                                        
                                        <div class="mr-2 pt-1">
                                            <div class="radio-inline">
                                                <label class="radio radio-success">
                                                <input type="radio" name="radios5" checked="checked">
                                                <span></span>Approval</label>
                                                <label class="radio radio-success">
                                                <input type="radio" name="radios5">
                                                <span></span>Concent</label>
                                                <label class="radio radio-success">
                                                <input type="radio" name="radios5">
                                                <span></span>Notification</label>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center flex-grow-1">                                            
                                            <!--<input class="form-control border-0 px-0 min-h-45px" name="compose_subject" placeholder="Search for user" />-->
                                            <div class="input-group input-group-solid">
                                                <input type="text" class="form-control border-0" placeholder="Search for user to add to the approval path">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">Add User</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!--end::Add User-->
                                    <!--begin::Users List-->
                                    <div class="align-items-center border-bottom inbox-to-cc p-0 pr-5 min-h-50px">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>                                                    
                                                    <th scope="col" class="pl-8">Action Request</th>
                                                    <th>User</th>
                                                    <th>Job</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td scope="row" class="pl-8" style="width:350px;">
                                                        <div class="radio-inline">
                                                            <label class="radio radio-success">
                                                            <input type="radio" name="radios5" checked="checked">
                                                            <span></span>Approval</label>
                                                            <label class="radio radio-success">
                                                            <input type="radio" name="radios5">
                                                            <span></span>Concent</label>
                                                            <label class="radio radio-success">
                                                            <input type="radio" name="radios5">
                                                            <span></span>Notification</label>
                                                        </div>
                                                    </td>
                                                    <td>Jonathan Araiza (j.araiza)</td>
                                                    <td>Sr. App Developer</td>
                                                    <td>
                                                        <a href="#">
                                                        <span class="label label-inline label-light-danger font-weight-bold">
                                                            Remove
                                                        </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row" class="pl-8">
                                                        <div class="radio-inline">
                                                            <label class="radio radio-success">
                                                            <input type="radio" name="radios5" checked="checked">
                                                            <span></span>Approval</label>
                                                            <label class="radio radio-success">
                                                            <input type="radio" name="radios5">
                                                            <span></span>Concent</label>
                                                            <label class="radio radio-success">
                                                            <input type="radio" name="radios5">
                                                            <span></span>Notification</label>
                                                        </div>
                                                    </td>
                                                    <td>Jonathan Araiza (j.araiza)</td>
                                                    <td>Production Manager</td>
                                                    <td>
                                                        <a href="#">
                                                        <span class="label label-inline label-light-danger font-weight-bold">
                                                            Remove
                                                        </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row"  class="pl-8">
                                                        <div class="radio-inline">
                                                            <label class="radio radio-success">
                                                            <input type="radio" name="radios5" checked="checked">
                                                            <span></span>Approval</label>
                                                            <label class="radio radio-success">
                                                            <input type="radio" name="radios5">
                                                            <span></span>Concent</label>
                                                            <label class="radio radio-success">
                                                            <input type="radio" name="radios5">
                                                            <span></span>Notification</label>
                                                        </div>
                                                    </td>
                                                    <td>Jonathan Araiza (j.araiza)</td>
                                                    <td>Quality Manager</td>
                                                    <td>
                                                        <a href="#">
                                                        <span class="label label-inline label-light-danger font-weight-bold">
                                                            Remove
                                                        </span>
                                                        </a>
                                                    </td>
                                                </tr>                                                                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::User List-->
                                    <!--begin::Message-->
                                    <div id="kt_inbox_new_editor" class="border-0" style="height: 250px"></div>
                                    <!--end::Message-->
                                    <!--begin::Attachments-->
                                    <div class="dropzone dropzone-multi px-8 py-4" id="kt_inbox_new_attachments">
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
                                    <!--end::Attachments-->
                                </div>
                                <!--end::Body-->
                                <!--begin::Footer-->
                                <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-top">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center mr-3">
                                        <!--begin::Send-->
                                        <div class="btn-group mr-4">
                                            <span class="btn btn-primary font-weight-bold px-6">Send</span>
                                            <span class="btn btn-primary font-weight-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button"></span>
                                            <div class="dropdown-menu dropdown-menu-sm dropup p-0 m-0 dropdown-menu-right">
                                                <ul class="navi py-3">
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="flaticon2-writing"></i>
                                                            </span>
                                                            <span class="navi-text">Schedule Send</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="flaticon2-medical-records"></i>
                                                            </span>
                                                            <span class="navi-text">Save &amp; archive</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="flaticon2-hourglass-1"></i>
                                                            </span>
                                                            <span class="navi-text">Cancel</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--end::Send-->
                                        <!--begin::Other-->
                                        <span class="btn btn-icon btn-sm btn-clean mr-2" id="kt_inbox_new_attachments_select">
                                            <i class="flaticon2-clip-symbol"></i>
                                        </span>
                                        <span class="btn btn-icon btn-sm btn-clean">
                                            <i class="flaticon2-pin"></i>
                                        </span>
                                        <!--end::Other-->
                                    </div>
                                    <!--end::Actions-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-icon btn-sm btn-clean mr-2" data-toggle="tooltip" title="More actions">
                                            <i class="flaticon2-settings"></i>
                                        </span>
                                        <span class="btn btn-icon btn-sm btn-clean" data-inbox="dismiss" data-toggle="tooltip" title="Dismiss reply">
                                            <i class="flaticon2-rubbish-bin-delete-button"></i>
                                        </span>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::New-->
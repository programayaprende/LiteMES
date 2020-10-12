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
                            <form id="approval_new_form" method="post">
                                <!--begin::Body-->
                                <div class="d-block">
                                    <!--begin::Hash-->
                                    <div class="border-bottom">
                                        <input class="form-control border-0 px-8 min-h-45px" name="approval_hash" id="approval_hash" type="hidden"/>                                        
                                    </div>
                                    <!--end::Hash--> 
                                    <div id="filesAdded" class="d-none">

                                    </div>
                                    <!--begin::Subject-->
                                    <div class="border-bottom">
                                        <input class="form-control border-0 px-8 min-h-45px" name="compose_subject" placeholder="Subject" />
                                    </div>
                                    <!--end::Subject-->                                    
                                    <!--begin::Add User-->
                                    <style>
                                        .twitter-typeahead {
                                            width:100%;
                                        }
                                    </style>
                                    <div class="d-flex align-items-center border-bottom  inbox-to px-8 min-h-50px">                                        
                                        <div class="mr-2 pt-1">
                                            <div class="radio-inline">
                                                <label class="radio radio-success">
                                                <input type="radio" name="approval_action_new" id="action_request_approval" checked="checked" value="Approval">
                                                <span></span>Approval</label>
                                                <label class="radio radio-success">
                                                <input type="radio" name="approval_action_new" id="action_request_concent" value="Concent">
                                                <span></span>Concent</label>
                                                <label class="radio radio-success">
                                                <input type="radio" name="approval_action_new" id="action_request_notification" value="Notification">
                                                <span></span>Notification</label>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center flex-grow-1 typeahead ">                                            
                                            <input id="approval_user_new" class="form-control border-0 px-0 min-h-45px ml-2" placeholder="Search for user to add into the approval path" />                                            
                                        </div>                                        
                                    </div>
                                    <!--end::Add User-->
                                    <!--begin::Users List-->
                                    <div class="align-items-center border-bottom inbox-to-cc p-0 pr-5 min-h-50px">
                                        <table class="table mb-0" id="approval_path_new">
                                            <thead>
                                                <tr>                                                    
                                                    <th scope="col" class="pl-8">Action Request</th>
                                                    <th>User</th>
                                                    <th>Job</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>                                                
                                                
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
                                            <span class="btn btn-primary font-weight-bold px-6" id="btnSend">Send</span>
                                        </div>
                                        <!--end::Send-->
                                        <!--begin::Other-->
                                        <span class="btn btn-icon btn-sm btn-clean mr-2" id="kt_inbox_new_attachments_select">
                                            <i class="flaticon2-clip-symbol"></i>
                                        </span>                                        
                                        <!--end::Other-->
                                    </div>
                                    <!--end::Actions-->                                    
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
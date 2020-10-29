"use strict";

var dataUsers = null;
var dataTable;

// Class definition
var KTAppInbox = function() {
    // Private properties
    var _asideEl;
    var _listEl;
    var _viewEl;
    var _newEl;
    var _toolbarEl;    
    var _asideOffcanvas;
    var _approval_hash_new;
    var _approval_editor_new;

    // Private methods
    var _initEditor = function(form, editor) {
        // init editor
        var options = {
            modules: {
                toolbar: {}
            },
            placeholder: 'Type message...',
            theme: 'snow'
        };

        // Init editor
        _approval_editor_new = new Quill('#' + editor, options);

        // Customize editor
        var toolbar = KTUtil.find(form, '.ql-toolbar');
        var editor = KTUtil.find(form, '.ql-editor');

        if (toolbar) {
            KTUtil.addClass(toolbar, 'px-5 border-top-0 border-left-0 border-right-0');
        }

        if (editor) {
            KTUtil.addClass(editor, 'px-8');
        }
    }

    var _initForm = function(formEl) {
        var formEl = KTUtil.getById(formEl);

        // Init autocompletes
        var toEl = KTUtil.find(formEl, '[name=compose_to]');
        var tagifyTo = new Tagify(toEl, {
            delimiters: ", ", // add new tags when a comma or a space character is entered
            maxTags: 10,
            blacklist: ["fuck", "shit", "pussy"],
            keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
            whitelist: [{
                value: 'Chris Muller',
                email: 'chris.muller@wix.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_11.jpg',
                class: 'tagify__tag--primary'
            }, {
                value: 'Nick Bold',
                email: 'nick.seo@gmail.com',
                initials: 'SS',
                initialsState: 'warning',
                pic: ''
            }, {
                value: 'Alon Silko',
                email: 'alon@keenthemes.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_6.jpg'
            }, {
                value: 'Sam Seanic',
                email: 'sam.senic@loop.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_8.jpg'
            }, {
                value: 'Sara Loran',
                email: 'sara.loran@tilda.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_9.jpg'
            }, {
                value: 'Eric Davok',
                email: 'davok@mix.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_13.jpg'
            }, {
                value: 'Sam Seanic',
                email: 'sam.senic@loop.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_13.jpg'
            }, {
                value: 'Lina Nilson',
                email: 'lina.nilson@loop.com',
                initials: 'LN',
                initialsState: 'danger',
                pic: './assets/media/users/100_15.jpg'
            }],
            templates: {
                dropdownItem: function(tagData) {
                    try {
                        var html = '';

                        html += '<div class="tagify__dropdown__item">';
                        html += '   <div class="d-flex align-items-center">';
                        html += '       <span class="symbol sumbol-' + (tagData.initialsState ? tagData.initialsState : '') + ' mr-2">';
                        html += '           <span class="symbol-label" style="background-image: url(\''+ (tagData.pic ? tagData.pic : '') + '\')">' + (tagData.initials ? tagData.initials : '') + '</span>';
                        html += '       </span>';
                        html += '       <div class="d-flex flex-column">';
                        html += '           <a href="#" class="text-dark-75 text-hover-primary font-weight-bold">'+ (tagData.value ? tagData.value : '') + '</a>';
                        html += '           <span class="text-muted font-weight-bold">' + (tagData.email ? tagData.email : '') + '</span>';
                        html += '       </div>';
                        html += '   </div>';
                        html += '</div>';

                        return html;
                    } catch (err) {}
                }
            },
            transformTag: function(tagData) {
                tagData.class = 'tagify__tag tagify__tag--primary';
            },
            dropdown: {
                classname: "color-blue",
                enabled: 1,
                maxItems: 5
            }
        });

        var ccEl = KTUtil.find(formEl, '[name=compose_cc]');
        var tagifyCc = new Tagify(ccEl, {
            delimiters: ", ", // add new tags when a comma or a space character is entered
            maxTags: 10,
            blacklist: ["fuck", "shit", "pussy"],
            keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
            whitelist: [{
                value: 'Chris Muller',
                email: 'chris.muller@wix.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_11.jpg',
                class: 'tagify__tag--primary'
            }, {
                value: 'Nick Bold',
                email: 'nick.seo@gmail.com',
                initials: 'SS',
                initialsState: 'warning',
                pic: ''
            }, {
                value: 'Alon Silko',
                email: 'alon@keenthemes.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_6.jpg'
            }, {
                value: 'Sam Seanic',
                email: 'sam.senic@loop.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_8.jpg'
            }, {
                value: 'Sara Loran',
                email: 'sara.loran@tilda.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_9.jpg'
            }, {
                value: 'Eric Davok',
                email: 'davok@mix.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_13.jpg'
            }, {
                value: 'Sam Seanic',
                email: 'sam.senic@loop.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_13.jpg'
            }, {
                value: 'Lina Nilson',
                email: 'lina.nilson@loop.com',
                initials: 'LN',
                initialsState: 'danger',
                pic: './assets/media/users/100_15.jpg'
            }],
            templates: {
                dropdownItem: function(tagData) {
                    try {
                        var html = '';

                        html += '<div class="tagify__dropdown__item">';
                        html += '   <div class="d-flex align-items-center">';
                        html += '       <span class="symbol sumbol-' + (tagData.initialsState ? tagData.initialsState : '') + ' mr-2" style="background-image: url(\''+ (tagData.pic ? tagData.pic : '') + '\')">';
                        html += '           <span class="symbol-label">' + (tagData.initials ? tagData.initials : '') + '</span>';
                        html += '       </span>';
                        html += '       <div class="d-flex flex-column">';
                        html += '           <a href="#" class="text-dark-75 text-hover-primary font-weight-bold">'+ (tagData.value ? tagData.value : '') + '</a>';
                        html += '           <span class="text-muted font-weight-bold">' + (tagData.email ? tagData.email : '') + '</span>';
                        html += '       </div>';
                        html += '   </div>';
                        html += '</div>';

                        return html;
                    } catch (err) {}
                }
            },
            transformTag: function(tagData) {
                tagData.class = 'tagify__tag tagify__tag--primary';
            },
            dropdown: {
                classname: "color-blue",
                enabled: 1,
                maxItems: 5
            }
        });

        var bccEl = KTUtil.find(formEl, '[name=compose_bcc]');
        var tagifyBcc = new Tagify(bccEl, {
            delimiters: ", ", // add new tags when a comma or a space character is entered
            maxTags: 10,
            blacklist: ["fuck", "shit", "pussy"],
            keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
            whitelist: [{
                value: 'Chris Muller',
                email: 'chris.muller@wix.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_11.jpg',
                class: 'tagify__tag--primary'
            }, {
                value: 'Nick Bold',
                email: 'nick.seo@gmail.com',
                initials: 'SS',
                initialsState: 'warning',
                pic: ''
            }, {
                value: 'Alon Silko',
                email: 'alon@keenthemes.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_6.jpg'
            }, {
                value: 'Sam Seanic',
                email: 'sam.senic@loop.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_8.jpg'
            }, {
                value: 'Sara Loran',
                email: 'sara.loran@tilda.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_9.jpg'
            }, {
                value: 'Eric Davok',
                email: 'davok@mix.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_13.jpg'
            }, {
                value: 'Sam Seanic',
                email: 'sam.senic@loop.com',
                initials: '',
                initialsState: '',
                pic: './assets/media/users/100_13.jpg'
            }, {
                value: 'Lina Nilson',
                email: 'lina.nilson@loop.com',
                initials: 'LN',
                initialsState: 'danger',
                pic: './assets/media/users/100_15.jpg'
            }],
            templates: {
                dropdownItem: function(tagData) {
                    try {
                        var html = '';

                        html += '<div class="tagify__dropdown__item">';
                        html += '   <div class="d-flex align-items-center">';
                        html += '       <span class="symbol sumbol-' + (tagData.initialsState ? tagData.initialsState : '') + ' mr-2" style="background-image: url(\''+ (tagData.pic ? tagData.pic : '') + '\')">';
                        html += '           <span class="symbol-label">' + (tagData.initials ? tagData.initials : '') + '</span>';
                        html += '       </span>';
                        html += '       <div class="d-flex flex-column">';
                        html += '           <a href="#" class="text-dark-75 text-hover-primary font-weight-bold">'+ (tagData.value ? tagData.value : '') + '</a>';
                        html += '           <span class="text-muted font-weight-bold">' + (tagData.email ? tagData.email : '') + '</span>';
                        html += '       </div>';
                        html += '   </div>';
                        html += '</div>';

                        return html;
                    } catch (err) {}
                }
            },
            transformTag: function(tagData) {
                tagData.class = 'tagify__tag tagify__tag--primary';
            },
            dropdown: {
                classname: "color-blue",
                enabled: 1,
                maxItems: 5
            }
        });

        // CC input show
        KTUtil.on(formEl, '[data-inbox="cc-show"]', 'click', function(e) {
            var inputEl = KTUtil.find(formEl, '.inbox-to-cc');
            KTUtil.removeClass(inputEl, 'd-none');
            KTUtil.addClass(inputEl, 'd-flex');
            KTUtil.find(formEl, "[name=compose_cc]").focus();
        });

        // CC input hide
        KTUtil.on(formEl, '[data-inbox="cc-hide"]', 'click', function(e) {
            var inputEl = KTUtil.find(formEl, '.inbox-to-cc');
            KTUtil.removeClass(inputEl, 'd-flex');
            KTUtil.addClass(inputEl, 'd-none');
        });

        // BCC input show
        KTUtil.on(formEl, '[data-inbox="bcc-show"]', 'click', function(e) {
            var inputEl = KTUtil.find(formEl, '.inbox-to-bcc');
            KTUtil.removeClass(inputEl, 'd-none');
            KTUtil.addClass(inputEl, 'd-flex');
            KTUtil.find(formEl, "[name=compose_bcc]").focus();
        });

        // BCC input hide
        KTUtil.on(formEl, '[data-inbox="bcc-hide"]', 'click', function(e) {
            var inputEl = KTUtil.find(formEl, '.inbox-to-bcc');
            KTUtil.removeClass(inputEl, 'd-flex');
            KTUtil.addClass(inputEl, 'd-none');
        });
    }

    var _initAttachments = function(elemId) {
        var id = "#" + elemId;
        var previewNode = $(id + " .dropzone-item");
        previewNode.id = "";
        var previewTemplate = previewNode.parent('.dropzone-items').html();
        previewNode.remove();

        var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
            url: BASE_URL + '/Approvals/FileUpload', // Set the url for your upload script location
            parallelUploads: 3,
            maxFilesize: 3, // Max filesize in MB
            previewTemplate: previewTemplate,
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            clickable: id + "_select" // Define the element that should be used as click trigger to select files.
        });

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            $(document).find(id + ' .dropzone-item').css('display', '');
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            try {
                document.querySelector(id + " .progress-bar").style.width = progress + "%";    
            } catch (error) {
                
            }            
        });

        myDropzone.on("sending", function(file, xhr, formData) {
            console.log("sending");
            console.log(file);
            // Show the total progress bar when upload starts
            document.querySelector(id + " .progress-bar").style.opacity = "1";
            formData.append("approval_hash", _approval_hash_new);
        });

        myDropzone.on("removedfile", function(file, xhr, formData) {
            console.log("removedfile");
            if(file.status=="success"){
                //Remover del servidor
                $.ajax({
                    url: BASE_URL + "/Approvals/RemoveFile",
                    dataType: "json",
                    method: "post",
                    data: {
                        file_name: file.name,
                        approval_hash: _approval_hash_new
                    },
                    success: function(data){
                        loading.hide();
        
                        console.log(data);
        
                        if(data.error==1){
                            alert('Error creating a approval');
                            return;
                        }
                        _approval_hash_new = data.approval_hash;
                        $("#kt_inbox_new #approval_hash").val(data.approval_hash);
                        
                        //Mostrar new
        
                        KTUtil.addClass(_newEl, 'd-block');
                        KTUtil.removeClass(_newEl, 'd-none');
                    }            
                });
            }
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("complete", function(progress) {
            var thisProgressBar = id + " .dz-complete";
            setTimeout(function() {
                $(thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress").css('opacity', '0');
            }, 300);

            if(progress.status=="success"){
                var responseObj = JSON.parse(progress.xhr.responseText);
                console.log(responseObj);                
            }
        });
    }

    var _initPage = function() {
        console.log("_initPage");
        KTUtil.removeClass(_listEl, 'd-block');
        KTUtil.removeClass(_viewEl, 'd-block');
        KTUtil.removeClass(_newEl, 'd-block');

        KTUtil.addClass(_listEl, 'd-none');
        KTUtil.addClass(_viewEl, 'd-none');
        KTUtil.addClass(_newEl, 'd-none');
    }

    var _showSent = function(){

        console.log("_showSent");

        // demo loading
        var loading = new KTDialog({
            'type': 'loader',
            'placement': 'top center',
            'message': 'Loading ...'
        });
        loading.show();

        //Ocultar new
        KTUtil.addClass(_newEl, 'd-none');
        KTUtil.removeClass(_newEl, 'd-block');

        //Ocultar view
        KTUtil.addClass(_viewEl, 'd-none');
        KTUtil.removeClass(_viewEl, 'd-block');
        
        $.ajax({
            url: BASE_URL + '/Approvals/GetApprovals/Sent',
            type: "post",
            dataType: "json"
        })
        .done(function(res){            
            console.log("res");
            console.log(res);
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
            } else {                 
                //$("#main_subtitle").html(res.role_data.name);
                //$("#name").val(res.role_data.name);
                //$("#description").val(res.role_data.description);
                //$("#id").val(res.role_data.id);
                
                loading.hide();
        
                //Mostrar listado
                KTUtil.addClass(_listEl, 'd-block');
                KTUtil.removeClass(_listEl, 'd-none');

                console.log("x");
                
                dataUsers = res.data;
                reload_table();
            }
        });        
    }
    
    var _startNew = function(){

        console.log("_startNew");

        // demo loading
        var loading = new KTDialog({
            'type': 'loader',
            'placement': 'top center',
            'message': 'Loading ...'
        });
        loading.show();

        //Ocultar lista
        KTUtil.addClass(_listEl, 'd-none');
        KTUtil.removeClass(_listEl, 'd-block');

        //Ocultar view
        KTUtil.addClass(_viewEl, 'd-none');
        KTUtil.removeClass(_viewEl, 'd-block');

        $('#approval_new_form').trigger("reset");
        
        //var editor = new Quill('#kt_inbox_new_editor');
        _approval_editor_new.setText('');
        

        $("#approval_path_new tbody").html('<tr><td colspan="4" class="pl-8 text-center">Approval path is empty, select action and add a user</td></tr>');

        $.ajax({
            url: BASE_URL + "/Approvals/CreateDraft",
            dataType: "json",
            success: function(data){
                loading.hide();

                console.log(data);

                if(data.error==1){
                    alert('Error creating a approval');
                    return;
                }
                _approval_hash_new = data.approval_hash;
                $("#kt_inbox_new #approval_hash").val(data.approval_hash);
                
                //Mostrar new

                KTUtil.addClass(_newEl, 'd-block');
                KTUtil.removeClass(_newEl, 'd-none');
            }            
        });

        
    }

    var _addToPath = function(new_user_name){        
        $.ajax({
            url: BASE_URL + "/Approvals/AddToPath",
            data: { 
                user_name: new_user_name, 
                approval_hash: _approval_hash_new,
                approval_type: $("input[name='approval_action_new']:checked").val(),
            },
            dataType: "json",
            success: function(data){                
                console.log(data);
                
                if(data.error==1){
                    alert(data.message);
                    return;
                }                
                
                _previewPath();
            }            
        });
    }

    var _updateActionRequest= function(seq,action){
        $.ajax({
            url: BASE_URL + "/Approvals/UpdateActionRequest",            
            data: { 
                approval_hash: _approval_hash_new,
                approval_type: action,
                seq: seq,
            },
            dataType: "json",
            method: "post",
            success: function(data){                
                console.log(data);
                
                if(data.error==1){
                    alert(data.message);
                    return;
                }
            }
        });
    }
    
    var _removeFromPath= function(seq){
        $.ajax({
            url: BASE_URL + "/Approvals/RemoveFromPath",            
            data: { 
                approval_hash: _approval_hash_new,                
                seq: seq,
            },
            dataType: "json",
            method: "post",
            success: function(data){                
                console.log(data);
                
                if(data.error==1){
                    alert(data.message);
                    return;
                }

                _previewPath();
            }
        });
    }

    var _previewPath = function(){
        $.ajax({
            url: BASE_URL + "/Approvals/PreviewPath",            
            data: { approval_hash: _approval_hash_new},
            dataType: "json",
            method: "post",
            success: function(data){                
                console.log(data);
                
                if(data.error==1){
                    alert(data.message);
                    return;
                }

                if(data.steps_count==0){
                    $("#approval_path_new tbody").html('<tr><td colspan="4" class="pl-8 text-center">Approval path is empty, select action and add a user</td></tr>');
                    return;
                }

                $("#approval_path_new tbody").html('');
                $.each(data.steps, function(index,step){
                    console.log(step);
                    
                    $("#approval_path_new tbody").append('\
                    <tr data-seq="' + step.seq + '" data-user-name="' + step.user_name + '">\
                        <td scope="row" class="pl-8" style="width:350px;">\
                            <div class="radio-inline">\
                                <label class="radio radio-success">\
                                <input type="radio" value="Approval" name="action_request_'+ step.seq + '" ' + ( step.approval_type=='Approval' ? 'checked="checked"' : '') + '>\
                                <span></span>Approval</label>\
                                <label class="radio radio-success">\
                                <input type="radio" value="Concent" name="action_request_'+ step.seq + '" ' + ( step.approval_type=='Concent' ? 'checked="checked"' : '') + '>\
                                <span></span>Concent</label>\
                                <label class="radio radio-success">\
                                <input type="radio" value="Notification" name="action_request_'+ step.seq + '" ' + ( step.approval_type=='Notification' ? 'checked="checked"' : '') + '>\
                                <span></span>Notification</label>\
                            </div>\
                        </td>\
                        <td>' + step.first_name + ' ' + step.last_name +' (' + step.user_name + ')</td>\
                        <td>' + step.job_description + '</td>\
                        <td>\
                            <a href="javascript:;" class="label-remove">\
                            <span class="label label-inline label-light-danger font-weight-bold">\
                                Remove\
                            </span>\
                            </a>\
                        </td>\
                    </tr>\
                    ');
                });

                $("#approval_path_new input[type='radio']").click(function(){
                    var tr = $(this).closest('tr');
                    var seq = tr.data("seq");
                    var value = $(this).val();
                    _updateActionRequest(seq,value);
                });

                $("#approval_path_new .label-remove").click(function(){
                    var tr = $(this).closest('tr');
                    var seq = tr.data("seq");                    
                    _removeFromPath(seq);
                });
                
            }
        });
    }
   

    // Public methods
    return {
        // Public functions
        init: function() {
            // Init variables
            _asideEl = KTUtil.getById('kt_inbox_aside');
            _listEl = KTUtil.getById('kt_inbox_list');
            _viewEl = KTUtil.getById('kt_inbox_view');
            _newEl = KTUtil.getById('kt_inbox_new');
            _toolbarEl = KTUtil.getById('kt_subheader');

            _initPage();

            // Init handlers
            KTAppInbox.initAside();
            KTAppInbox.initList();
            KTAppInbox.initView();
            KTAppInbox.initNew();            
                        
            KTUtil.on(_toolbarEl, '.btn-new-approval', 'click', function(e) {                
                _startNew();                
            });

            if(DEFAULT_ACTION=="new"){
                _startNew();
            }

            if(DEFAULT_ACTION=="sent"){
                _showSent();
            }
            
        },

        viewApproval: function(approval_hash) {
            // Demo loading
            var loading = new KTDialog({
                'type': 'loader',
                'placement': 'top center',
                'message': 'Loading ...'
            });
            loading.show();
            
            $("#view_subject").html("");
            $("#view_approval_path").html("");
            $("#view_drafter").html("");
            $("#view_drafter_job_description").html("");
            $("#view_submit_at").html("");
            $("#view_body").html("");
            $("#view_files").html("");
            $("#view_approval_hash").html("");

            //Reset modal
            $("#actionModalTitle").html("");
            $("#approval_step_action").val("");
            $("#approval_step_approval_hash").val("");
            $("#approval_step_comment").val("");

            $.ajax({
                url: BASE_URL + "/Approvals/View/" + approval_hash,
                dataType: "json",
                success: function(data){
                    loading.hide();
    
                    console.log(data);
    
                    if(data.error==1){
                        alert('Error getting approval data');
                        return;
                    }

                    $("#view_subject").html(data.approval.subject);

                    $("#view_approval_path").html("");
                    
                    $.each(data.approval_path, function(index,approval_step){
                        
                        var state = "info";

                        switch(approval_step.status){
                            case "Pending":
                                state = "primary";
                                break;
                            case "Approved":
                                state = "success";
                                break;
                            case "Rejected":
                                state = "danger";
                                break;
                            case "Notified":
                                state = "warning";
                                break;
                        }

                        $("#view_approval_path").append(
                            '\
                            <div class=" shadow-xs toggle-off" data-inbox="message">\
                                <div class="d-flex align-items-center card-spacer-x py-6">\
                                    <span class="symbol symbol-50 mr-4">\
                                        <span class="symbol-label" style="background-image: url(\'' + BASE_URL + '/assets/media/users/100_11.jpg\')"></span>\
                                    </span>\
                                    <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">\
                                        <div class="d-flex">\
                                            <a href="javascript:;" class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">' + approval_step.first_name + ' ' + approval_step.last_name + '</a>\
                                            <div class="font-weight-bold text-muted">\
                                            | ' + approval_step.job_description + '</div>\
                                        </div>\
                                        <div class="d-flex flex-column">\
                                            <div class="text-muted font-weight-bold toggle-on-item">' + approval_step.comment + '</div>\
                                        </div>\
                                    </div>\
                                    <div class="d-flex align-items-center">\
                                        <div class="font-weight-bold text-muted mr-2" >' + approval_step.status_set_at + '</div>\
                                        <div class="d-flex align-items-center">\
                                            <span class="label label-light-' + state + ' font-weight-bold label-inline mr-1">' + approval_step.status + '</span>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                            '
                        );
                    });

                    $("#view_drafter").html(data.approval.first_name + ' ' + data.approval.last_name);
                    $("#view_drafter_job_description").html(data.approval.job_description);
                    $("#view_submit_at").html(data.approval.submit_at);
                    $("#view_body").html(data.approval.body);
                    $("#view_approval_hash").html(data.approval.approval_hash);

                    $("#view_files").html("");
                    $.each(data.approval_files, function(index,approval_file){                        
                        $("#view_files").append('\
                        <a href="javascript:;" class="d-flex align-items-center text-muted text-hover-primary py-1">\
                        <span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span>' + approval_file.file_name + '</a>\
                        ');
                    });

                    $("#btn-approve").addClass("d-none");
                    $("#btn-reject").addClass("d-none");

                    if(data.show_btn){
                        $("#btn-approve").removeClass("d-none");
                        $("#btn-reject").removeClass("d-none");
                    }
                    
                    //Ocultar listas
                    KTUtil.addClass(_listEl, 'd-none');
                    KTUtil.removeClass(_listEl, 'd-block');

                    //Ocultar new
                    KTUtil.addClass(_newEl, 'd-none');
                    KTUtil.removeClass(_newEl, 'd-block');
                    
                    //Mostrar vista
                    KTUtil.addClass(_viewEl, 'd-block');
                    KTUtil.removeClass(_viewEl, 'd-none');
                },
                error: function() {
                    alert('Error');
                },
                complete: function(){
                    loading.hide();
                }
            });


            return;
            setTimeout(function() {
                loading.hide();
                

            }, 700);
        },

        initAside: function() {
            // Mobile offcanvas for mobile mode
            _asideOffcanvas = new KTOffcanvas(_asideEl, {
                overlay: true,
                baseClass: 'offcanvas-mobile',
                //closeBy: 'kt_inbox_aside_close',
                toggleBy: 'kt_subheader_mobile_toggle'
            });

            // View list
            KTUtil.on(_asideEl, '.list-item[data-action="list"]', 'click', function(e) {
                var type = KTUtil.attr(this, 'data-type');
                var listItemsEl = KTUtil.find(_listEl, '.kt-inbox__items');
                var navItemEl = this.closest('.kt-nav__item');
                var navItemActiveEl = KTUtil.find(_asideEl, '.kt-nav__item.kt-nav__item--active');

                // demo loading
                var loading = new KTDialog({
                    'type': 'loader',
                    'placement': 'top center',
                    'message': 'Loadingg ...'
                });
                loading.show();

                setTimeout(function() {
                    loading.hide();

                    KTUtil.css(_listEl, 'display', 'flex'); // show list
                    KTUtil.css(_viewEl, 'display', 'none'); // hide view

                    KTUtil.addClass(navItemEl, 'kt-nav__item--active');
                    KTUtil.removeClass(navItemActiveEl, 'kt-nav__item--active');

                    KTUtil.attr(listItemsEl, 'data-type', type);
                }, 600);
            });
        },

        initList: function() {

            console.log("initList");

            dataTable = $('#kt_datatable');

            // begin first table
            dataTable.DataTable({
                responsive: true,
                data: dataUsers,
                columnDefs: [
                    {
                        targets: 0,
                        title: 'Sender',                        
                        render: function(data, type, full, meta) {                                                    
                            
                            var output = '<div class="d-flex align-items-center">\
								<div class="symbol symbol-40 symbol-light-success flex-shrink-0">\
									<span class="symbol-label font-size-h4 font-weight-bold">' + full[8].substring(0, 1) + '</span>\
								</div>\
								<div class="ml-4">\
									<div class="text-dark-75 font-weight-bolder font-size-lg mb-0">' + full[8] + ' ' + full[9] + '</div>\
									' + full[10] + '\
								</div>\
							</div>';
                            
                            return output;
                        },
                    },
                    {
                        targets: 1,                        
                        render: function(data, type, full, meta) {                                                    
                            return full[3];
                        },
                    },
                    {
                        targets: 2,
                        render: function(data, type, full, meta) {                                                    
                            return full[11];
                        },
                    },
                    {
                        targets: 3,
                        render: function(data, type, full, meta) {                                                    
                            return '\
                            <span class="label label-light-primary font-weight-bold label-inline mr-1">' + full[2] + '</span>\
                            ';                            
                        },
                    },
                    {
                        targets: -1,
                        title: '',
                        orderable: false,
                        render: function(data, type, full, meta) {                                                    
                            return '\
                                <div class="d-flex align-items-center">\
                                    <a href="javascript:KTAppInbox.viewApproval(\'' + full[7] + '\');" class="btn btn-sm btn-clean btn-icon" title="View">\
                                        <i class="la la-eye"></i>\
                                    </a>\
                                </div>\
                            ';
                        },
                    },
                ],
            });
        },

        initView: function() {
            
            $("#btn-approve").click(function(){                
                $("#actionModal").modal('show');
                $("#actionModalTitle").html("Approve");
                $("#approval_step_action").val("Approve");
                $("#approval_step_approval_hash").val($("#view_approval_hash").html());                
                $("#approval_step_comment").val("");
                $("#btn-apply-action").removeClass("d-none");
                $("#btn-apply-action-wait").addClass("d-none");
            });

            $("#btn-reject").click(function(){                
                $("#actionModal").modal('show');
                $("#actionModalTitle").html("Reject");
                $("#approval_step_action").val("Reject");
                $("#approval_step_approval_hash").val($("#view_approval_hash").html());
                $("#approval_step_comment").val("");
                $("#btn-apply-action").removeClass("d-none");
                $("#btn-apply-action-wait").addClass("d-none");
            });

            $("#btn-apply-action").click(function(){
                var formData = new FormData(document.getElementById("actionForm"));
                
                $("#btn-apply-action").addClass("d-none");
                $("#btn-apply-action-wait").removeClass("d-none");

                $.ajax({
                    url: BASE_URL + "/Approvals/applyAction",
                    method: "post",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    error: function(){
                        alert('Error');
                        $("#btn-apply-action").removeClass("d-none");
                        $("#btn-apply-action-wait").addClass("d-none");
                    }                    
                }).done(function(res){
                    
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
                            KTUtil.scrollTop();   
                            $("#btn-apply-action").removeClass("d-none");
                            $("#btn-apply-action-wait").addClass("d-none");
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
                            $("#actionModal").modal('hide');
                            KTUtil.scrollTop();
                            //Refresh Approval
                            KTAppInbox.viewApproval(res.approval.approval_hash);
                        });
                        return;
                    }

                });
            });
            
            // Back to listing
            KTUtil.on(_viewEl, '[data-inbox="back"]', 'click', function() {
                // demo loading
                var loading = new KTDialog({
                    'type': 'loader',
                    'placement': 'top center',
                    'message': 'Loading ...'
                });

                loading.show();

                setTimeout(function() {
                    loading.hide();

                    KTUtil.addClass(_listEl, 'd-block');
                    KTUtil.removeClass(_listEl, 'd-none');

                    KTUtil.addClass(_viewEl, 'd-none');
                    KTUtil.removeClass(_viewEl, 'd-block');
                }, 700);
            });

            // Expand/Collapse reply
            KTUtil.on(_viewEl, '[data-inbox="message"]', 'click', function(e) {
                return;
                var message = this.closest('[data-inbox="message"]');

                var dropdownToggleEl = KTUtil.find(this, '[data-toggle="dropdown"]');
                var toolbarEl = KTUtil.find(this, '[data-inbox="toolbar"]');

                // skip dropdown toggle click
                if (e.target === dropdownToggleEl || (dropdownToggleEl && dropdownToggleEl.contains(e.target) === true)) {
                    return false;
                }

                // skip group actions click
                if (e.target === toolbarEl || (toolbarEl && toolbarEl.contains(e.target) === true)) {
                    return false;
                }

                if (KTUtil.hasClass(message, 'toggle-on')) {
                    KTUtil.addClass(message, 'toggle-off');
                    KTUtil.removeClass(message, 'toggle-on');
                } else {
                    KTUtil.removeClass(message, 'toggle-off');
                    KTUtil.addClass(message, 'toggle-on');
                }
            });
        },

        initNew: function() {
            // Back to listing
            KTUtil.on(_newEl, '[data-inbox="back"]', 'click', function() {
                // demo loading
                var loading = new KTDialog({
                    'type': 'loader',
                    'placement': 'top center',
                    'message': 'Loading ...'
                });

                loading.show();

                setTimeout(function() {
                    loading.hide();

                    KTUtil.addClass(_listEl, 'd-block');
                    KTUtil.removeClass(_listEl, 'd-none');

                    KTUtil.addClass(_newEl, 'd-none');
                    KTUtil.removeClass(_newEl, 'd-block');
                }, 700);
            });

            $('#btnSend').click(function(){

                var formData = new FormData(document.getElementById("approval_new_form"));
                
                formData.append("messageBody",_approval_editor_new.root.innerHTML);
                formData.append("messageText",_approval_editor_new.getText());

                $.ajax({
                    url: BASE_URL + "/Approvals/Send",
                    method: "post",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,                    
                }).done(function(res){
                    console.log(res);

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
                            //Go to Sent List
                        });
                        return;
                    }

                });
            });

            var usersList = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('user_name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: BASE_URL + "/Users/Search",
                remote: {
                    url: BASE_URL + '/Users/Search?condition=%QUERY',
                    wildcard: '%QUERY'
                }
            });

            $('#approval_user_new').typeahead(null, {
                name: 'best-pictures',
                display: 'user_name',
                source: usersList,
                templates: {
                    empty: [
                        '<div class="empty-message" style="padding: 10px 15px; text-align: center;">',
                        'unable to find any users that match the current query',
                        '</div>'
                    ].join(''),
                    suggestion: Handlebars.compile('<div><strong>{{first_name}} {{last_name}}</strong> ({{user_name}})<br>{{job_description}}</div>')
                }
            });

            $('#approval_user_new').bind('typeahead:select', function(ev, suggestion) {                
                _addToPath(suggestion.user_name);
                $('#approval_user_new').typeahead('val','');
            });

            _initEditor(_newEl, 'kt_inbox_new_editor');
            _initAttachments('kt_inbox_new_attachments');            
        },
    };
}();

function reload_table(){
    var table = $('#kt_datatable').DataTable();
    table.destroy();    
    KTAppInbox.initList();    
}

// Class Initialization
jQuery(document).ready(function() {
    KTAppInbox.init();
});

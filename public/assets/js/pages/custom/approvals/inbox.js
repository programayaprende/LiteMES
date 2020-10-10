"use strict";

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
        var editor = new Quill('#' + editor, options);

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
            url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
            parallelUploads: 20,
            maxFilesize: 1, // Max filesize in MB
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
            document.querySelector(id + " .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector(id + " .progress-bar").style.opacity = "1";
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("complete", function(progress) {
            var thisProgressBar = id + " .dz-complete";
            setTimeout(function() {
                $(thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress").css('opacity', '0');
            }, 300)
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
        var editor = new Quill('#kt_inbox_new_editor');
        editor.setText('');

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

    var _addUser = function(new_user_name){
        $.ajax({
            url: BASE_URL + "/Approvals/AddToPath",
            data: { user_name: new_user_name, approval_hash: _approval_hash_new},
            dataType: "json",
            success: function(data){                
                console.log(data);
                
                if(data.error==1){
                    alert('Error getting approval path');
                    return;
                }                
                
                _drawApprovalPath();
            }            
        });
    }

    var _drawApprovalPath = function(){
        $.ajax({
            url: BASE_URL + "/Approvals/GetPath",
            data: { approval_hash: _approval_hash_new},
            dataType: "json",
            success: function(data){                
                console.log(data);
                
                if(data.error==1){
                    alert('Error getting approval path');
                    return;
                }                
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
                    'message': 'Loading ...'
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
            // View message
            KTUtil.on(_listEl, '[data-inbox="message"]', 'click', function(e) {
                var actionsEl = KTUtil.find(this, '[data-inbox="actions"]');

                // skip actions click
                if (e.target === actionsEl || (actionsEl && actionsEl.contains(e.target) === true)) {
                    return false;
                }

                // Demo loading
                var loading = new KTDialog({
                    'type': 'loader',
                    'placement': 'top center',
                    'message': 'Loading ...'
                });
                loading.show();

                setTimeout(function() {
                    loading.hide();

                    KTUtil.addClass(_listEl, 'd-none');
                    KTUtil.removeClass(_listEl, 'd-block');

                    KTUtil.addClass(_viewEl, 'd-block');
                    KTUtil.removeClass(_viewEl, 'd-none');
                }, 700);
            });

            // Group selection
            KTUtil.on(_listEl, '[data-inbox="group-select"] input', 'click', function() {
                var messages = KTUtil.findAll(_listEl, '[data-inbox="message"]');

                for (var i = 0, j = messages.length; i < j; i++) {
                    var message = messages[i];
                    var checkbox = KTUtil.find(message, '.checkbox input');
                    checkbox.checked = this.checked;

                    if (this.checked) {
                        KTUtil.addClass(message, 'active');
                    } else {
                        KTUtil.removeClass(message, 'active');
                    }
                }
            });

            // Individual selection
            KTUtil.on(_listEl, '[data-inbox="message"] [data-inbox="actions"] .checkbox input', 'click', function() {
                var item = this.closest('[data-inbox="message"]');

                if (item && this.checked) {
                    KTUtil.addClass(item, 'active');
                } else {
                    KTUtil.removeClass(item, 'active');
                }
            });
        },

        initView: function() {
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

            //'https://preview.keenthemes.com/metronic/theme/html/tools/preview/api/?file=typeahead/movies.json'
            var usersList = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('user_name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: "http://localhost/Users/Search",
                remote: {
                    url: 'http://localhost/Users/Search?condition=%QUERY',
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
                _addUser(suggestion.user_name);
            });

            // Expand/Collapse reply
            /*
            KTUtil.on(_newEl, '[data-inbox="message"]', 'click', function(e) {
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
            */

            _initEditor(_newEl, 'kt_inbox_new_editor');            
            _initAttachments('kt_inbox_new_attachments');            
        },
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTAppInbox.init();
});

"use strict";
// Class definition

var myDropzone5;

var KTDropzoneDemo = function () {
    
    var demo3 = function () {
         // set the dropzone container id
         var id = '#kt_dropzone_5';

         // set the preview element template
         var previewNode = $(id + " .dropzone-item");
         previewNode.id = "";
         var previewTemplate = previewNode.parent('.dropzone-items').html();
         previewNode.remove();

         myDropzone5 = new Dropzone(id, { // Make the whole body a dropzone
             url: BASE_URL + '/Repository/TempFileUpload', // Set the url for your upload script location
             parallelUploads: 5,
             maxFiles: 5,
             maxFilesize: 1, // Max filesize in MB
             previewTemplate: previewTemplate,
             previewsContainer: id + " .dropzone-items", // Define the container to display the previews
             clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
         });

         myDropzone5.on("addedfile", function(file) {
             // Hookup the start button
             $(document).find( id + ' .dropzone-item').css('display', '');
         });

         // Update the total progress bar
         myDropzone5.on("totaluploadprogress", function(progress) {
             $( id + " .progress-bar").css('width', progress + "%");
         });

         myDropzone5.on("sending", function(file) {
             // Show the total progress bar when upload starts
             $( id + " .progress-bar").css('opacity', "1");
         });
         
         myDropzone5.on("removedfile", function(file) {             
             $("#" + file.upload.uuid).remove();
         });

         // Hide the total progress bar when nothing's uploading anymore
         myDropzone5.on("complete", function(progress) {     
            
            var thisProgressBar = id + " .dz-complete";
            setTimeout(function(){
                $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress").css('opacity', '0');
            }, 300);

            if(progress.status=="success"){

                var responseObj = JSON.parse(progress.xhr.responseText);

                console.log(responseObj);

                if(responseObj.error==0){
                    $("#filesAdded").append("<input type='hidden' name='files_id[]' id='" + progress.upload.uuid  +"' value='" + responseObj.id  +"'>");
                }
            }
             
         });
    }

    return {
        // public functions
        init: function() {
            demo3();
        }
    };
}();
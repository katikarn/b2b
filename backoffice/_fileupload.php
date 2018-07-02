<?php

// define absolute folder path
$storeFolder = 'ABSOLUTE_FOLDER_PATH/'
// if folder doesn't exists, create it
if(!file_exists($storeFolder) && !is_dir($storeFolder)) {
    mkdir($storeFolder);
}
  
// upload files to $storeFolder
if (!empty($_FILES)) {
    
    /**
     *  uploadMultiple = false
     *  When uploading file by file, upload on fly
     *  
     */
    // $tempFile = $_FILES['file']['tmp_name'];        
    // $targetFile =  $storeFolders . $_FILES['file']['name'];
    // move_uploaded_file($tempFile,$targetFile); 
    
   /**
     *  uploadMultiple = true
     *  When uploading multiple files in a single request.
     *  Way to go if using dropzone in a form with other fields,
     *  and when uploading files on form submit via button... myDropzone.processQueue(); 
     *
     *  $_FILES['file']['tmp_name'] is an array so have to use loop
     *
     */
    foreach($_FILES['file']['tmp_name'] as $key => $value) {
        $tempFile = $_FILES['file']['tmp_name'][$key];
        $targetFile =  $storeFolder. $_FILES['file']['name'][$key];
        move_uploaded_file($tempFile,$targetFile);
    }
}

?> 

<!-- include dropzone script & style -->
<link rel="stylesheet" href="<?=$config->urls->templates?>lib/dropzone/dropzone.css">
<script src="<?=$config->urls->templates?>lib/dropzone/dropzone.js"></script>

<script>
// disable auto discover
Dropzone.autoDiscover = false;
// init dropzone on id (form or div)
$(document).ready(function() {

    var myDropzone = new Dropzone("#myDropzone", {
        url: "<?=$page->url?>",
        paramName: "file",
        autoProcessQueue: false,
        uploadMultiple: true, // uplaod files in a single request
        parallelUploads: 100, // use it with uploadMultiple
        maxFilesize: 1, // MB
        maxFiles: 5,
        acceptedFiles: ".jpg, .jpeg, .png, .gif, .pdf",
        addRemoveLinks: true,
        // Language Strings
        dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
        dictInvalidFileType: "Invalid File Type",
        dictCancelUpload: "Cancel",
        dictRemoveFile: "Remove",
        dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
        dictDefaultMessage: "Drop files here to upload",
    });

});

Dropzone.options.myDropzone = {
    // The setting up of the dropzone
    init: function() {
        var myDropzone = this;

        // First change the button to actually tell Dropzone to process the queue.
        $("#dropzoneSubmit").on("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            
            if (myDropzone.files != "") {
                myDropzone.processQueue();
            } else {
                $("#myDropzone").submit();
            }

        });

        // on add file
        this.on("addedfile", function(file) {
            // console.log(file);
        });
        // on error
        this.on("error", function(file, response) {
            // console.log(response);
        });
        // on start
        this.on("sendingmultiple", function(file) {
             // console.log(file);
        });
        // on success
        this.on("successmultiple", function(file) {
            // submit form
            $("#form").submit();
        });
    }
};

</script>

<!-- dropzone as a form 
<form id="myDropzone" action="./" enctype="multipart/form-data" class="dropzone" method="post"></form>
-->

<!-- dropzone as a div in a form -->
<form id="form" action="./" method="POST">
    <!-- standard form fields -->
    <input type="text" name="name" />
    <input type="email" name="email" />
    <!-- dropzone field -->
    <div id="myDropzone" class="dropzone"></div>
</form>

<!-- submit button -->
<button id="dropzoneSubmit" class="uk-button uk-button-primary">Submit</button>
Dropzone.autoDiscover = false;
$(function() {
    //Dropzone class
    var myDropzone = new Dropzone(".dropzone");
    myDropzone.on("queuecomplete", function() {
        //Redirect URL
        window.location.href = urlRedirectToIndex;
    });
});
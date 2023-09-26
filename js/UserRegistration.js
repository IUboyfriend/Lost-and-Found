$("#file").change(function (event) {
    var files = event.target.files, file;
    if (files && files.length > 0) {
        file = files[0];
        var URL = window.URL || window.webkitURL;
        var imgURL = URL.createObjectURL(file);
        $("#image").attr("src", imgURL);
    }
})

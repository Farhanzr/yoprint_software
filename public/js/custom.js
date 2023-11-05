document.forms['upload-csv'].onsubmit = function(e){
    var x = document.getElementById("progress_section");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    document.getElementById(".progress_section")
    e.preventDefault();
    
    let error = document.querySelector(".error");
    let success = document.querySelector(".success");
    let message = document.querySelector(".message");
    let file = this.upload_file.files[0];
    error.innerHTML = "";

    if(!file){
        error.innerHTML = "Please select a file";
        return false;
    }

    let formdata = new FormData();
    formdata.append("upload_file", file);
    formdata.append("_token", window.csrfToken);

    let http = new XMLHttpRequest();
    http.open("post", window.uploadCsvStoreRoute, true);
    http.upload.addEventListener("progress", function(event){
        let percent = (event.loaded / event.total) * 100;
        document.querySelector("progress").value = Math.round(percent);
        document.querySelector("#percentage").innerHTML = Math.round(percent) + "%";
    });

    http.addEventListener("load", function() {
        if(this.readyState == 4 && this.status == 200)
        {
            success.innerHTML = `File uploaded successfully`;
        }
        if(this.readyState == 1)
        {
            message.innerHTML = `The file is being processed`;
        }
    });

    // http.open("post", window.uploadCsvStoreRoute, true);
    http.send(formdata);
}
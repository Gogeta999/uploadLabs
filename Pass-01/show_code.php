<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-javascript">
function checkFile() {
        var file = document.getElementsByName('upload_file')[0].value;
        if (file == null || file == "") {
            alert("Please select the file you want to upload!");
            return false;
        }
        //Define the types of files allowed to be uploaded
        var allow_ext = ".jpg|.png|.gif";
    //Extracting the type of uploaded files
        var ext_name = file.substring(file.lastIndexOf("."));
    //Determine if the upload file type is allowed to be uploaded
        if (allow_ext.indexOf(ext_name) == -1) {
            var errMsg = "This file is not allowed to be uploaded, please upload" + allow_ext + "types file,current file type：" + ext_name;
            alert(errMsg);
            return false;
        }
}
</code>
</pre>
</li>
<?php
include '../config.php';
include '../head.php';
include '../menu.php';

$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        $temp_file = $_FILES['upload_file']['tmp_name'];
        $img_path = UPLOAD_PATH . '/' . $_FILES['upload_file']['name'];
        if (move_uploaded_file($temp_file, $img_path)){
            $is_upload = true;
        } else {
            $msg = 'Upload error!';
        }
    } else {
        $msg = UPLOAD_PATH . 'Folder does not exist, please create it manually!';
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>This level test point:</h3>
            <p>Front-end validation bypass</p>
        </li>    

        <li>
            <h3>Mission</h3>
            <p>Upload one<code>webshell</code>to server.</p>
        </li>
        <li>
            <h3>Upload area</h3>
            <form enctype="multipart/form-data" method="post" onsubmit="return checkFile()">
                <p>Please select the image you want to upload：<p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="Upload"/>
            </form>
            <div id="msg">
                <?php 
                    if($msg != null){
                        echo "Tip：".$msg;
                    }
                ?>
            </div>
            <div id="img">
                <?php
                    if($is_upload){
                        echo '<img src="'.$img_path.'" width="250px" />';
                    }
                ?>
            </div>
        </li>
	    <?php 
	        if($_GET['action'] == "show_code"){
	            include 'show_code.php';
	        }
	    ?>
	</ol>
</div>

<?php
include '../footer.php'
?>


<script type="text/javascript">
    function checkFile() {
        var file = document.getElementsByName('upload_file')[0].value;
        if (file == null || file == "") {
            alert("Please select the file you want to upload!");
            return false;
        }
        //定义允许上传的文件类型
        var allow_ext = ".jpg|.png|.gif";
        //提取上传文件的类型
        var ext_name = file.substring(file.lastIndexOf("."));
        //判断上传文件类型是否允许上传
        if (allow_ext.indexOf(ext_name) == -1) {
            var errMsg = "This file is not allowed to be uploaded, please upload" + allow_ext + "types file,current file type：" + ext_name;
            alert(errMsg);
            return false;
        }
    }
</script>
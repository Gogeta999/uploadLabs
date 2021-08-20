<?php
include '../config.php';
include '../common.php';
include '../head.php';
include '../menu.php';

$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists($UPLOAD_ADDR)) {
        $deny_ext = array("php","php5","php4","php3","php2","html","htm","phtml","pht","jsp","jspa","jspx","jsw","jsv","jspf","jtml","asp","aspx","asa","asax","ascx","ashx","asmx","cer","swf","htaccess");

        $file_name = $_POST['save_name'];
        $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

        if(!in_array($file_ext,$deny_ext)) {
            $img_path = $UPLOAD_ADDR . '/' .$file_name;
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $img_path)) { 
                $is_upload = true;
            }else{
                $msg = 'Upload Failed！';
            }
        }else{
            $msg = 'Save file as this type is prohibited!';
        }

    } else {
        $msg = $UPLOAD_ADDR . 'Folder does not exist, please create it manually!';
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>This level test point:</h3>
            <p>move_uploaded_file() truncation Bypass</p>
        </li>   
        <li>
            <h3>Mission</h3>
            <p>Upload <code>webshell</code> to server。</p>
        </li>
        <li>
        <h3>Upload area</h3>
            <form enctype="multipart/form-data" method="post">
                <p>Please select the image you want to upload：<p>
                <input class="input_file" type="file" name="upload_file"/>
                <p>Save Name:<p>
                <input class="input_text" type="text" name="save_name" value="upload-19.jpg" /><br/>
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
include '../footer.php';
?>
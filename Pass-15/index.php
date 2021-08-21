<?php
include '../config.php';
include '../head.php';
include '../menu.php';

function isImage($filename){
    //Require php_exif module
    $image_type = exif_imagetype($filename);
    switch ($image_type) {
        case IMAGETYPE_GIF:
            return "gif";
            break;
        case IMAGETYPE_JPEG:
            return "jpg";
            break;
        case IMAGETYPE_PNG:
            return "png";
            break;    
        default:
            return false;
            break;
    }
}

$is_upload = false;
$msg = null;
if(isset($_POST['submit'])){
    $temp_file = $_FILES['upload_file']['tmp_name'];
    $res = isImage($temp_file);
    if(!$res){
        $msg = "Unkown file type，Upload failed！";
    }else{
        $img_path = UPLOAD_PATH."/".rand(10, 99).date("YmdHis").".".$res;
        if(move_uploaded_file($temp_file,$img_path)){
            $is_upload = true;
        } else {
            $msg = "Upload Failed";
        }
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>This level test point:</h3>
            <p>php_exif module image type bypass</p>
        </li>   

        <li>
            <h3>Mission</h3>
            <p>Upload <code>picture trojan </code> to server。</p>
            <p>Note：</p>
            <p>1. Make sure that the uploaded image still contains <code>the complete sentence</code> or <code>webshell</code> code</p>
            <p>2. Pictures trojan can be uploaded successfully to pass by <code>.jpg</code>,<code>.png</code>,<code>.gif</code> three suffixes!</p>
        </li>
        <li>
            <h3>Upload area</h3>
            <form enctype="multipart/form-data" method="post">
            <p>Please select the image you want to upload：<p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="上传"/>
            </form>
            <div id="msg">
                <?php 
                    if($msg != null){
                        echo "Tip:".$msg;
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
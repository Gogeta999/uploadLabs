<?php
include '../config.php';
include '../head.php';
include '../menu.php';

function isImage($filename){
    $types = '.jpeg|.png|.gif';
    if(file_exists($filename)){
        $info = getimagesize($filename);
        $ext = image_type_to_extension($info[2]);
        if(stripos($types,$ext)>=0){
            return $ext;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

$is_upload = false;
$msg = null;
if(isset($_POST['submit'])){
    $temp_file = $_FILES['upload_file']['tmp_name'];
    $res = isImage($temp_file);
    if(!$res){
        $msg = "File Type Unknown，Upload Error!";
    }else{
        $img_path = UPLOAD_PATH."/".rand(10, 99).date("YmdHis").$res;
        if(move_uploaded_file($temp_file,$img_path)){
            $is_upload = true;
        } else {
            $msg = "Upload error！";
        }
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>This level test point:</h3>
            <p>getimagesize image type bypass</p>
        </li>   

        <li>
            <h3>Mission</h3>
            <p>Upload <code>picture trojan </code> to server。</p>
            <p>Note：</p>
            <p>1. Make sure that the uploaded image still contains <code>the complete sentence</code> or <code>webshell</code> code</p>
            <p>2.Use <a href="<?php echo INC_VUL_PATH;?>" target="_bank"> File Inclusion Vulnerability </a>Can run the malicious code in the image trojan.</p>
            <p>3. Pictures trojan can be uploaded successfully to pass by <code>.jpg</code>,<code>.png</code>,<code>.gif</code> three suffixes!</p>
        </li>
        <li>
            <h3>Upload area</h3>
            <form enctype="multipart/form-data" method="post">
            <p>Please select the image you want to upload：<p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="upload"/>
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
<?php
include '../config.php';
include '../head.php';
include '../menu.php';

$is_upload = false;
$msg = null;
if (isset($_POST['submit'])){
    // Get basic information about the uploaded file, file name, type, size, temporary file path
    $filename = $_FILES['upload_file']['name'];
    $filetype = $_FILES['upload_file']['type'];
    $tmpname = $_FILES['upload_file']['tmp_name'];

    $target_path=UPLOAD_PATH.'/'.basename($filename);

    // Get ext name
    $fileext= substr(strrchr($filename,"."),1);

    //Check Image Suffix type to know valid or not
    if(($fileext == "jpg") && ($filetype=="image/jpeg")){
        if(move_uploaded_file($tmpname,$target_path)){
            //Use uploaded image to create same but new image to server
            $im = imagecreatefromjpeg($target_path);

            if($im == false){
                $msg = "该文件不是jpg格式的图片！";
                @unlink($target_path);
            }else{
                //Assign a file name to a new image
                srand(time());
                $newfilename = strval(rand()).".jpg";
                //display secondary rendered images (new images generated using user uploaded images)             
                $img_path = UPLOAD_PATH.'/'.$newfilename;
                imagejpeg($im,$img_path);
                @unlink($target_path);
                $is_upload = true;
            }
        } else {
            $msg = "Upload Failed";
        }

    }else if(($fileext == "png") && ($filetype=="image/png")){
        if(move_uploaded_file($tmpname,$target_path)){
            //Use uploaded image to create same but new image to server
            $im = imagecreatefrompng($target_path);

            if($im == false){
                $msg = "File is not a png image！";
                @unlink($target_path);
            }else{
                //Assign a file name to a new image
                srand(time());
                $newfilename = strval(rand()).".png";
                //display secondary rendered images (new images generated using user uploaded images)  
                $img_path = UPLOAD_PATH.'/'.$newfilename;
                imagepng($im,$img_path);

                @unlink($target_path);
                $is_upload = true;               
            }
        } else {
            $msg = "Upload Failed！";
        }

    }else if(($fileext == "gif") && ($filetype=="image/gif")){
        if(move_uploaded_file($tmpname,$target_path)){
            //Use uploaded image to create same but new image to server
            $im = imagecreatefromgif($target_path);
            if($im == false){
                $msg = "File is not a gif image！";
                @unlink($target_path);
            }else{
                //Assign a file name to a new image
                srand(time());
                $newfilename = strval(rand()).".gif";
                //display secondary rendered images (new images generated using user uploaded images)
                $img_path = UPLOAD_PATH.'/'.$newfilename;
                imagegif($im,$img_path);

                @unlink($target_path);
                $is_upload = true;
            }
        } else {
            $msg = "Upload Failed";
        }
    }else{
        $msg = "Only allow to upload .jpg|.png|.gif suffix file type！";
    }
}
?>

<div id="upload_panel">
    <ol>
    <li>
            <h3>This level test point:</h3>
            <p>Rendering bypass</p>
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
                <input class="button" type="submit" name="submit" value="Upload"/>
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
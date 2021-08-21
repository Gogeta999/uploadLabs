<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">
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
</code>
</pre>
</li>
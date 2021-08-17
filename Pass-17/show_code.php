<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">$is_upload = false;
$msg = null;
if (isset($_POST['submit'])){
    // Get basic information about the uploaded file, file name, type, size, temporary file path
    $filename = $_FILES['upload_file']['name'];
    $filetype = $_FILES['upload_file']['type'];
    $tmpname = $_FILES['upload_file']['tmp_name'];

    $target_path=UPLOAD_PATH.'/'.basename($filename);

    // Get the extension of the uploaded file
    $fileext= substr(strrchr($filename,"."),1);

    //Determine the file suffix and type, and upload only if it is legal
    if(($fileext == "jpg") && ($filetype=="image/jpeg")){
        if(move_uploaded_file($tmpname,$target_path)){
            //Generate a new image using the uploaded image
            $im = imagecreatefromjpeg($target_path);

            if($im == false){
                $msg = "File is not a jpg image！";
                @unlink($target_path);
            }else{
                //Assign a file name to a new image
                srand(time());
                $newfilename = strval(rand()).".jpg";
                //display secondary rendered images (new images generated using user uploaded images)                $img_path = UPLOAD_PATH.'/'.$newfilename;
                imagejpeg($im,$img_path);
                @unlink($target_path);
                $is_upload = true;
            }
        } else {
            $msg = "Upload error！";
        }

    }else if(($fileext == "png") && ($filetype=="image/png")){
        if(move_uploaded_file($tmpname,$target_path)){
            //Generate a new image using the uploaded image
            $im = imagecreatefrompng($target_path);

            if($im == false){
                $msg = "File is not a png image！";
                @unlink($target_path);
            }else{
                //Assign a file name to a new image
                srand(time());
                $newfilename = strval(rand()).".png";
                //display secondary rendered images (new images generated using user uploaded images)                $img_path = UPLOAD_PATH.'/'.$newfilename;
                $img_path = UPLOAD_PATH.'/'.$newfilename;
                imagepng($im,$img_path);

                @unlink($target_path);
                $is_upload = true;               
            }
        } else {
            $msg = "Upload error！";
        }

    }else if(($fileext == "gif") && ($filetype=="image/gif")){
        if(move_uploaded_file($tmpname,$target_path)){
            //Generate a new image using the uploaded image
            $im = imagecreatefromgif($target_path);
            if($im == false){
                $msg = "File is not a gif image！";
                @unlink($target_path);
            }else{
                //Assign a file name to a new image
                srand(time());
                $newfilename = strval(rand()).".gif";
                //display secondary rendered images (new images generated using user uploaded images)                $img_path = UPLOAD_PATH.'/'.$newfilename;
                $img_path = UPLOAD_PATH.'/'.$newfilename;
                imagegif($im,$img_path);

                @unlink($target_path);
                $is_upload = true;
            }
        } else {
            $msg = "Upload error！";
        }
    }else{
        $msg = "Only allow to upload .jpg|.png|.gif suffix file type！";
    }
}
</code>
</pre>
</li>
<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">$is_upload = false;
$msg = null;
if(!empty($_FILES['upload_file'])){
    //mime check
    $allow_type = array('image/jpeg','image/png','image/gif');
    if(!in_array($_FILES['upload_file']['type'],$allow_type)){
        $msg = "Prohibit the upload of this type of file!";
    }else{
        //check filename
        $file = empty($_POST['save_name']) ? $_FILES['upload_file']['name'] : $_POST['save_name'];
        if (!is_array($file)) {
            $file = explode('.', strtolower($file));
        }

        $ext = end($file);
        $allow_suffix = array('jpg','png','gif');
        if (!in_array($ext, $allow_suffix)) {
            $msg = "Prohibit the upload of files with this suffix!";
        }else{
            $file_name = reset($file) . '.' . $file[count($file) - 1];
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $img_path = UPLOAD_PATH . '/' .$file_name;
            if (move_uploaded_file($temp_file, $img_path)) {
                $msg = "File upload success！";
                $is_upload = true;
            } else {
                $msg = "File upload fail！";
            }
        }
    }
}else{
    $msg = "Please select the file you want to upload!";
}
</code>
</pre>
</li>
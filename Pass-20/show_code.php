<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {

        $is_upload = false;
        $msg = null;
        if(!empty($_FILES['upload_file'])){
            //mime check
            $allow_type = array('image/jpeg','image/png','image/gif');
            if(!in_array($_FILES['upload_file']['type'],$allow_type)){
                $msg = "Prohibit to upload this type of File!";
            }else{
                //check filename
                $file = empty($_POST['save_name']) ? $_FILES['upload_file']['name'] : $_POST['save_name'];
                if (!is_array($file)) {
                    $file = explode('.', strtolower($file));
                }

                $ext = end($file);
                $allow_suffix = array('jpg','png','gif');
                if (!in_array($ext, $allow_suffix)) {
                    $msg = "Prohibit to upload this type of suffix!";
                }else{
                    $file_name = reset($file) . '.' . $file[count($file) - 1];
                    $temp_file = $_FILES['upload_file']['tmp_name'];
                    $img_path = UPLOAD_PATH . '/' .$file_name;
                    if (move_uploaded_file($temp_file, $img_path)) {
                        $msg = "Upload Success!";
                        $is_upload = true;
                    } else {
                        $msg = "Upload Failed!";
                    }
                }
            }
        }else{
            $msg = "Please choose your file to upload";
        }
        
    } else {
        $msg = UPLOAD_PATH . 'Folder does not exist, please create it manually!';
    }
}
</code>
</pre>
</li>
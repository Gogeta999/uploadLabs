<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">
$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        $deny_ext = array('.asp','.aspx','.php','.jsp');
        $file_name = trim($_FILES['upload_file']['name']);
        $file_name = deldot($file_name);//Delete the dot at the end of the file name
        $file_ext = strrchr($file_name, '.');
        $file_ext = strtolower($file_ext); //Convert to Small letter
        $file_ext = str_ireplace('::$DATA', '', $file_ext);//Remove String::$DATA
        $file_ext = trim($file_ext); //Clean Empty Space

        if(!in_array($file_ext, $deny_ext)) {
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $img_path = UPLOAD_PATH.'/'.date("YmdHis").rand(1000,9999).$file_ext;            
            if (move_uploaded_file($temp_file,$img_path)) {
                 $is_upload = true;
            } else {
                $msg = 'Upload Failed!';
            }
        } else {
            $msg = 'Upload not allowed .asp,.aspx,.php,.jsp suffix files!';
        }
    } else {
        $msg = UPLOAD_PATH . 'Folder does not exist, please create it manually！';
    }
}
</code>
</pre>
</li>
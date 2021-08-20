<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">
$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists($UPLOAD_ADDR)) {
        $deny_ext = array('.asp','.aspx','.php','.jsp');
        $file_name = trim($_FILES['upload_file']['name']);
        $file_name = deldot($file_name);//Delete the dot at the end of the file name
        $file_ext = strrchr($file_name, '.');
        $file_ext = strtolower($file_ext); //Convert to Small letter
        $file_ext = str_ireplace('::$DATA', '', $file_ext);//Remove String::$DATA
        $file_ext = trim($file_ext); //Clean Empty Space

        if(!in_array($file_ext, $deny_ext)) {
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $UPLOAD_ADDR. '/' . $_FILES['upload_file']['name'])) {
                 $img_path = $UPLOAD_ADDR .'/'. $_FILES['upload_file']['name'];
                 $is_upload = true;
            }
        } else {
            $msg = 'Upload not allowed .asp,.aspx,.php,.jsp suffix files！';
        }
    } else {
        $msg = $UPLOAD_ADDR . 'Folder does not exist, please create it manually！';
    }
}
</code>
</pre>
</li>
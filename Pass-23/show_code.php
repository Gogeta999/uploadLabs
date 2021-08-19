<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        $allow_ext = array(".jpg",".jpeg",".png",".bmp",".gif");
        $file_name = trim($_FILES['upload_file']['name']);
        $file_name = deldot($file_name);//Delete dot in name's latest place
        $file_ext = strrchr($file_name, '.');
        $file_ext = strtolower($file_ext); //Convert to lowercase
        $file_ext = str_ireplace('::$DATA', '', $file_ext);//Remove String::$DATA
        $file_ext = trim($file_ext); //Clean Empty in file name

        if (in_array($file_ext, $deny_ext)) {
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], UPLOAD_PATH . '/' . $_FILES['upload_file']['name'])) {
                $img_path = UPLOAD_PATH . $_FILES['upload_file']['name'];
                $is_upload = true;
            }
        } else {
            $msg = 'Not allow,Only allow [.jpg, .jpeg, .png, .bmp, .gif]!';
        }
    } else {
        $msg = UPLOAD_PATH . 'Folder does not exist, please create it manually！';
    }
}
</code>
</pre>
</li>
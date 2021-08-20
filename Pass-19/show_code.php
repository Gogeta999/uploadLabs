<li id="show_code">
    <h3>index.php Code</h3>
<pre>
<code class="line-numbers language-php">
$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists($UPLOAD_ADDR)) {
        $deny_ext = array("php","php5","php4","php3","php2","html","htm","phtml","pht","jsp","jspa","jspx","jsw","jsv","jspf","jtml","asp","aspx","asa","asax","ascx","ashx","asmx","cer","swf","htaccess");

        $file_name = $_POST['save_name'];
        $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

        if(!in_array($file_ext,$deny_ext)) {
            $img_path = $UPLOAD_ADDR . '/' .$file_name;
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $img_path)) { 
                $is_upload = true;
            }else{
                $msg = 'Upload Failed！';
            }
        }else{
            $msg = 'Save file as this type is prohibited!';
        }

    } else {
        $msg = $UPLOAD_ADDR . 'Folder does not exist, please create it manually!';
    }
}
</code>
</pre>
</li>
<?php
include '../config.php';
include '../common.php';
include '../head.php';
include '../menu.php';

if (isset($_POST['submit'])) {
    if (file_exists($UPLOAD_ADDR)) {
        $allow_ext = array(".jpg",".jpeg",".png",".bmp",".gif");
        $file_name = trim($_FILES['upload_file']['name']);
        $file_name = deldot($file_name);//Delete dot in name's latest place
        $file_ext = strrchr($file_name, '.');
        $file_ext = strtolower($file_ext); //Convert to lowercase
        $file_ext = str_ireplace('::$DATA', '', $file_ext);//Remove String::$DATA
        $file_ext = trim($file_ext); //Clean Empty in file name

        if (in_array($file_ext, $deny_ext)) {
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $UPLOAD_ADDR . '/' . $_FILES['upload_file']['name'])) {
                $img_path = $UPLOAD_ADDR . $_FILES['upload_file']['name'];
                $is_upload = true;
            }
        } else {
            $msg = 'Not allow,Only allow [.jpg, .jpeg, .png, .bmp, .gif]!';
        }
    } else {
        $msg = $UPLOAD_ADDR . 'Folder does not exist, please create it manually！';
    }
}


?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>This level test point:</h3>
            <p>IIS6.0 parsing vulnerability(3)</p>
        </li>   
        <li>
            <h3>Mission</h3>
            <p>Upload <code>PictureTrojan</code> to server。</p>
            <p>Note：</p>
            <p>flag is located in File Saved Path</p>
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
<?php
include '../config.php';
include '../common.php';
include '../head.php';
include '../menu.php';

$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        $deny_ext = array(".php",".php5",".php4",".php3",".php2",".html",".htm",".phtml",".pht",".pHp",".pHp5",".pHp4",".pHp3",".pHp2",".Html",".Htm",".pHtml",".jsp",".jspa",".jspx",".jsw",".jsv",".jspf",".jtml",".jSp",".jSpx",".jSpa",".jSw",".jSv",".jSpf",".jHtml",".asp",".aspx",".asa",".asax",".ascx",".ashx",".asmx",".cer",".aSp",".aSpx",".aSa",".aSax",".aScx",".aShx",".aSmx",".cEr",".sWf",".swf",".htaccess",".ini");
        $file_name = trim($_FILES['upload_file']['name']);
        $file_name = deldot($file_name);//删除文件名末尾的点
        $file_ext = strrchr($file_name, '.');
        $file_ext = strtolower($file_ext); //Convert to lowercase
        $file_ext = str_ireplace('::$DATA', '', $file_ext);//去除字符串::$DATA
        //$file_ext = trim($file_ext); //首尾去空

        if (!in_array($file_ext, $deny_ext)) {
            // $temp_file = $_FILES['upload_file']['tmp_name'];
            // $img_path = UPLOAD_PATH.'/'.date("YmdHis").rand(1000,9999).$file_ext;
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], UPLOAD_PATH . '/' . $_FILES['upload_file']['name'])) {
                $img_path = UPLOAD_PATH . '/' . $file_name;
                $is_upload = true;
            }
            } else {
                $msg = 'Upload error！';
            }
        } else {
            $msg = 'This file is not allowed to be uploaded!';
        }
    } else {
        $msg = UPLOAD_PATH . 'Folder does not exist, please create it manually！';
    }
// }
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>This level test point:</h3>
            <p>File suffix (empty) bypass</p>
        </li>    

        <li>
            <h3>Mission</h3>
            <p>Upload one<code>webshell</code>to server.</p>
        </li>

        <li>
            <h3>Upload area</h3>
            <form enctype="multipart/form-data" method="post" onsubmit="return checkFile()">
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

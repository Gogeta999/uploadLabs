<?php
include '../config.php';
include '../common.php';
include '../head.php';
include '../menu.php';

$allowedExts = array("jpg");
$time = time();
$temp = explode(".", $_FILES["file"]["name"]);
echo $_FILES["file"]["size"];
$extension = end($temp);     // Get Suffix Name
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 204800)   // Smaller than 200 kb
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "Error: " . $_FILES["file"]["error"] . "";
    }
    else
    {
        echo "File Name: " . $_FILES["file"]["name"] . "";
        echo "File Type: " . $_FILES["file"]["type"] . "";
        echo "File Size: " . ($_FILES["file"]["size"] / 1024) . " kB";
      
        if (file_exists("C:/Inetpub/wwwroot/c/image/a.asp/" .$time.".jpg"))
        {
            echo $_FILES["file"]["name"] . " already exist. ";
        }
        else
        {
            // If the file does not exist in the upload directory, upload the file to the upload directory
            $ret = move_uploaded_file($_FILES["file"]["tmp_name"], "image/a.asp/".$time.".jpg");
            echo "File Saved Path: " . "./c/image/a.asp/".$time.".jpg";
            echo "";
        }
    }
}
else
{
    echo "Unvalid File Format";
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
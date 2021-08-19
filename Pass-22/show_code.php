<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">
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
</code>
</pre>
</li>
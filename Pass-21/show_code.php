<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
echo $_FILES["file"]["size"];
$extension = end($temp);     // Get Suffix Name
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 204800)   // Small than 200 kb
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
    
        if (file_exists("./b/image/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . "  already exist。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            $ret = move_uploaded_file($_FILES["file"]["tmp_name"], "image/" . $_FILES["file"]["name"]);
            echo "File Saved Path: " . "./b/image/" . $_FILES["file"]["name"];
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
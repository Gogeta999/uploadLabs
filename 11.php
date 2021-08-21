<?php 
function decrypt($cipher)
{
    global $key;
    $cipher = base64_decode($cipher);
    $r = '';
    for($i=0;$i<strlen($cipher);$i++){
        $k = $i % strlen($key);
        $r .= chr(ord($key[$k])^ord($cipher[$i]));
    }
    return $r;
}

//admin's encypt AABYDww=

echo decrypt('AABYDww=');
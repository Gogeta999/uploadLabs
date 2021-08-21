<?php
$string_xml = '<?xml version="1.0" encoding="utf-8"?><note><to>George</to><from>John</from><heading>Reminder</heading><body>xml实体注入</body></note>';
$xml = isset($_GET['xml'])?$_GET['xml']:$string_xml;
$data = simplexml_load_string($xml);
echo  '<meta charset="UTF-8">';
print_r($data);
?>
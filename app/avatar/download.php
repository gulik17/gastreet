<?php
if (isset($_GET["file"])) {
    $filename = $_GET["file"];
}

if($filename && mime_content_type($filename) == "image/jpeg") {
	header("Content-Disposition: attachment; filename=" . $filename);
	header("Content-type: application/octet-stream");  
	echo file_get_contents($filename);
}
else
{
    header("Location: /index.php?show=avatar");
}

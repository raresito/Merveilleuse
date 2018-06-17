<?php
$files = glob("../../resources/img/foto/*.{jpg,png,gif}", GLOB_BRACE);
for ($i=1; $i<count($files); $i++)
{
$num = $files[$i];
}
echo json_encode($files);
?>
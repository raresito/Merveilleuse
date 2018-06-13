<?php
$files = glob("../resources/res/foto/*.jpg");
for ($i=1; $i<count($files); $i++)
{
$num = $files[$i];

}
echo json_encode($files);
?>
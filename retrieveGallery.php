<?php
$files = glob("res/foto/*.jpg");
for ($i=1; $i<count($files); $i++)
{
$num = $files[$i];
echo'<div class="col-sm-3 col-md-2 col-lg-2 item" onclick="SelectPhoto(this)">
    <a  data-lightbox="photos">
        <img class="img-responsive" src=' . $num . '>
    </a>
</div>';
}
?>
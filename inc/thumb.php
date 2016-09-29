<?php
require_once '../classes/loader.php';

if(isset($_GET['src']) && isset($_GET['x']) && isset($_GET['y'])) {
	header('Content-Type: image/png');
	if(isset($_GET['align']))
		$align = $_GET['align'];
	else
		$align = NULL;
	if(isset($_GET['no_crop']))
		$img = image_sizer(intval($_GET['x']), intval($_GET['y']), $_GET['src'], NULL, TRUE, $align);
	else
		$img = image_sizer(intval($_GET['x']), intval($_GET['y']), $_GET['src'], NULL, NULL, $align);
	if($img != NULL)
		imagepng($img);
}
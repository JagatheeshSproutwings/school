<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('fileupload')) {

    function do_upload($file_name,$tmp_name,$filepath) {
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$new_file_name = round(microtime(true) * 1000).'.' . $ext;
		$file_array = explode(".", $file_name);
		$file_extension = end($file_array);
		$location = $filepath . $new_file_name;
		if (move_uploaded_file($tmp_name, $location))
		{
			return $new_file_name;
		}

    }

}

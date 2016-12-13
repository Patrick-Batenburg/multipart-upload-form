<?php
if(isset($_POST["submit"]))
{
	$parse_uri = explode("wp-content", $_SERVER["SCRIPT_FILENAME"]);
	require_once($parse_uri[0] . "wp-load.php");

    if(!isset($_FILES) || empty ($_FILES) || ! isset($_FILES["fileToUpload"]))
	{
		return;
	}

	if (!function_exists("wp_handle_upload"))
	{
		require_once(ABSPATH . "wp-admin/includes/file.php");
	}
	
	$upload_overrides = array("test_form" => false);
	$files = $_FILES['fileToUpload'];
	$arrayCounter = count($files["name"]);
	$i = 0;
	
	foreach ($files['name'] as $key => $value)
	{
		if ($files['name'][$key])
		{
			$uploadedfile = array(
			'name'     => $files['name'][$key],
			'type'     => $files['type'][$key],
			'tmp_name' => $files['tmp_name'][$key],
			'error'    => $files['error'][$key],
			'size'     => $files['size'][$key]
			);
			$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
		}

		if ($movefile && ! isset($movefile["error"]))
		{
			if(++$i === $arrayCounter) 
			{
				echo "Bestand(en) zijn succesvol geupload.";
			}
		} 
		else
		{
			echo "Onbekend probleem is opgetreden, probreer het opnieuw. Error: " . $movefile["error"];
		}		
	}
}
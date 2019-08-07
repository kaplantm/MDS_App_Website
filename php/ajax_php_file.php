<?php
$fi = new FilesystemIterator(dirname(__FILE__) .'/uploads/', FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi);

if(isset($_FILES["file"]["type"]))
{
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES['file']['type'] == 'text/plain')
	) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
		if ($_FILES["file"]["error"] > 0){
			echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
		}
		else{
			if (file_exists("uploads/" . $_FILES["file"]["name"])) {
				echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else{
if($_POST['fileContentHolder'] != ''){
				$filename = dirname(__FILE__) .'/uploads/'.$fileCount.'.txt';
				$content = $_POST['fileContentHolder'];
				 
				if($handle = fopen($filename, 'a')){
					if(is_writable($filename)){
						if(fwrite($handle, $content) === FALSE){
							echo "Cannot write to file $filename";
							exit;
						}

						fclose($handle);

						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/".$fileCount.'.'.end($temporary); // Target path where file is to be stored
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

						echo "Success! Your project code is: ". $fileCount.".".$file_extension;
					}
					else{
						echo "The file $filename, could not written to!";
					exit;
					}
				}
				else{
					echo "The file $filename, could not be created!";
					exit;
				}
}
			else{
						echo "No colors selected!";
					exit;
					}
			}
		}
	}
	else
	{
	echo "<span id='invalid'>***Invalid file Size or Type***<span>";
	}
}
?>
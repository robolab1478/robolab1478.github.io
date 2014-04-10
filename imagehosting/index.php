<html>
<?php
$activeTab="home";
$title = "Home";
function getExtension($what)
{
    $extension = end(explode('.', this.$what));
	return $extension;
}
function getFile($what)
{
	$withoutExt = preg_replace("/\\.[^.\\s]{3,4}$/", "", $what);
return $withoutExt;
}
function randomURLWanted($lengthOfStringTheUserWants)
{
    $URLTheUserGets = generateURL($lengthOfStringTheUserWants);
    $returnValue = uploadImage($URLTheUserGets);
    if(!$returnValue)
    {
        $stuff = error("chosen_fail");
        return false;
    }
    else
    {
		$url = $returnValue;
       	return $url;
	}
}
function URLChosen($URLName)
{
	if(checkIfURLExists($URLName))
	{
		$stuff = error("file_exists");
		include('nav.php');
		return false;
	}
	else
	{
		$returnValue = uploadImage($URLName);
		if(!$returnValue)
	    {
	        $stuff = error("chosen_fail");
	        include('nav.php');
	        return false;
	    }
    	else
    	{
			$url = $returnValue;
        	return $url;
        	// code to build the file they want
    	}
	}
}
//Image upload code
function uploadImage($fileName)
{
    $ds = DIRECTORY_SEPARATOR;
    $storeFolder = 'uploads';
    if (!empty($_FILES)) 
    {
        $uploaddir = 'upload/';
        $extension = end(explode('.', $_FILES['file']['name']));
        $path = $_FILES['image']['name'];
        $tempFile = $_FILES['file']['tmp_name'];
        $targetPath = $uploaddir.$fileName.".".$extension;
        if($extension == "png" || $extension == "jpg" || $extension == "tiff" || $extension == "bmp" || $extension == "gif" || $extension == "exif" || $extension == "webp")
		{
			if(file_exists($targetPath))
        	{
	            $title = "ERROR!";
	            $stuff = "<h2>".error('file_exists')."<a href='//vikasdoeshelppeople.host-ed.me/imagehostingbeta/index_new.php'>here.</a></h2>";
	            include('nav.php');
    	        die();
        	}
        	move_uploaded_file($tempFile,$targetPath);
			$imageFileName = $fileName.".".$extension;
			return $imageFileName;
		}
		else
		{
			$stuff = "you tried to uplad a file that is not supported (png,jpg,tiff,bmp,gif,exif,webp).";
			include('nav.php');
		}
    }
    else
    {
        $stuff = error("file_upload"); return false;
    }
}
//code for random generation of characters
function generateURL($length2)
{
    $string = generateString($length2);
    $trys = 0;
    while($trys < 150)
    {
    	if(checkIfURLExists($string))
    	{
    		$string = generateString($length2);
    		$trys++;
    	}
    }
    if($trys == 150)
    {
    	$stuff="Cannot generate a ".$length2." character URL beause they're all taken! Please try another, maybe ".$length2+1."? <a href='imagehosting.8jelly.com'>Try again here.</a>";
    	include('nav.php');
    	exit();
    }
    else	return $string;
}
function generateString($length)
{
    $allCharacters=array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $output="";
    for($i=0;$i<$length;$i++)
        {
            $output = $output . $allCharacters[rand(0, count($allCharacters)-1)];
        }
    return $output;
}
function checkIfURLExists($what)
{
    $array = scandir("./"); //CHANGE THIS INTO THE CORRECT DIRECTORY!!!
    if(array_key_exists($what,$array) == true)
       return true;
       return false;
}
function error($what)
{
    if ($what == "customAndChosen")
        return "fatal error! File exists.";
    else if ($what == "Type_is_not_'RANDOM'_or_'CHOSEN'")
        return "Something went wrong! Our fault, please try again.";
    else if($what == 'chosen_fail')
        return "something went wrong! Please upload the image again, or <a href='mailto:webmaster@google.com'>email support</a>.";
    else if($what == "file_upload")
        return "There was an error with the file upload";
    else if($what == "file_exists")
        return "The file already exists! Try again. ";
}
//sets some default values.
$lengthOfString = 10;
$success = false;
//runs the program
if (array_key_exists('check_submit', $_POST)) 
{
    //first thing to do is determine what type of url is wanted
    if($_POST['type'] == 'RANDOM')
	{
		$type='RANDOM'; 
		$return = randomURLWanted($_POST['stringLength']);
		if($return == false) $success = false;
		else
		{
			$file = $return;
			$success = true;
		}
	}
    else if($_POST['type'] == 'CHOSEN')
	{
		$type ='CHOSEN'; 	
		$return = URLChosen($_POST['urlName']);
		if($return == false)
			$success = false;
		else 
		{
			$file = $return;
			$success = true;
		}
	}
    else 
	{
		$stuff = error("Type_is_not_'RANDOM'_or_'CHOSEN'");
		include('nav.php'); 
		die();
	} // If the program doesn't work it ends here.
	if($success == false)
	{
		$stuff = '<h1> fatal server error... Sorry :(. Please <a href="//">try again</a>'; // fix the href url
		include('nav.php');
		exit();
	}
	else
	{
		$extension = getExtension($file);
		$fileName = getFile($file);
		$one = file_get_contents('base_files/1.php');
		$two = file_get_contents('base_files/2.php');
		$three = file_get_contents('base_files/3.php');
		$final = $one.$file.$two.$file.$three;
		$writer = fopen($fileName,w);
		fwrite($writer,$final);
		fclose($writer);
		echo("<html><head><meta http-equiv='refresh' content='0; URL=//imagehosting.8jelly.com/".$fileName."'></head></html>");
		exit();
	}
}
else
{
    $stuff="<form method='POST' action='index.php' enctype='multipart/form-data'>
        <input type='hidden' name='check_submit' value='1'>
        <input type='hidden' name='type' value=''>
        <label for='file'>File</label><input type='file' name='file' accept='image/*'><br/>
        <label for='questionAsker'>Would you like to choose the URL for the image?</label><br/>
            <input type='radio' name='questionAsker' value='yes' required >Yes<br/>
                <label for='urlName' class='hidden yes' maxlength='99'> The URL I want is:</label><input type='hidden' name='urlName'>
                <div id='breakerYes'></div>
            <input type='radio' name='questionAsker' value='no' required>No<br/>
                <label for='stringLength' class='hidden'>How long should the URL be?</label><input type='hidden' name='stringLength' step='1' min='0' max='150' value='10' maxlength='3'>
                <div id='breakerNo'></div>
        <input type='submit' onclick='validateForm();'>
    </form>
    <script src='assets/js/form.js' type='text/javascript'></script><!--Put the scrip at the bottom of the page to decrease element load time... this will load last and they can start working on the form.!-->";
    include('nav.php');
}

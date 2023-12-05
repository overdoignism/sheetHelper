<!DOCTYPE html>
<html>
<head>
    <title>sheetHelper_PHP_Writer v0.1</title>
</head>
<body>

<?php

myFunction();

function myFunction() {
	
	/*
	if(isset($_GET['pwd'])){
		$pwd = $_GET['pwd'];
		if($pwd <> 'mypwd')  // set password here
		{
			echo 'Password bad.';
			return;	
		}
		
	} else {
		echo 'Password bad.';
		return;
	}
	*/
		
	if(isset($_GET['id']) && isset($_GET['text'])) {

    $fileName = $_GET['id'];
    $text = $_GET['text'];

     if (strpos($fileName, ',') !== false) {
        echo "<span class='verify'>sheetHelper_Error. (Comma cannot appear in ID.) </span>";
        return false;
    }

    $file = fopen('./' . $fileName, 'w');

        if ($file) {
            fwrite($file, $text . "\n");
            $secondsSince2000 = time() - strtotime('2000-01-01');
            fwrite($file, $secondsSince2000);
            fclose($file);
            echo "<span class='verify'>sheetHelper_Done.</span>";
        } else {
            echo "<span class='verify'>sheetHelper_Error.</span>";
        }
        
	} else {

	echo "<span class='verify'>sheetHelper_Error: Missing ID or text.</span>";
	
	}
	

}


?>

</body>
</html>
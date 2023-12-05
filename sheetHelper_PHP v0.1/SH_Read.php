<!DOCTYPE html>
<html>
<head><title>sheetHelper_PHP_Reader v0.1</title></head>
<body>

<?php

error_reporting(0);

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $fileIds = explode(',', $id);
    
    foreach ($fileIds as $fileName) {
     
        $file = fopen('./'.$fileName, 'r');

        if ($file) {

        $text = fgets($file);
        $seconds = fgets($file);
        fclose($file);

        echo "<span class='$fileName"."_title'>$fileName</span><br>";
        $currentSeconds = time() - strtotime('2000-01-01');
        echo "<span class='$fileName'>$text</span><br>";

        $timeDifference = $currentSeconds - $seconds;
        echo "<span class='$fileName"."_sec'>$timeDifference</span><br>";
        echo "<span class='$fileName"."_end'>sheetHelper_Done.</span><br><br>";
        } else {
        echo "<span class='$fileName"."_title'>$fileName</span><br>";
        echo "<span class='$fileName"."_end'>sheetHelper_Error.</span><br><br>";
        }
        
    }
    
    
} else {

    echo "<span class='verify'>sheetHelper_Error: Missing ID.</span>";
}
?>

</body>
</html>
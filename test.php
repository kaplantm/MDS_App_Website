<?php
   $a =isset($_POST['id1'])?$_POST['id1']:'not yet';
   echo $a ;

$myfile = fopen("uploads/newfile.txt", "w") or die("Unable to open file!");
$txt = "Mickey Mouse\n";
fwrite($myfile, $txt);
$txt = "Minnie Mouse\n";
fwrite($myfile, $txt);
fclose($myfile);


   ?>
<?php
$db=new PDO('mysql:host=localhost;dbname=bbms','root','');
if($db)
{
          echo 'Connected';
}
else{
          echo'Not connected';
}


?>

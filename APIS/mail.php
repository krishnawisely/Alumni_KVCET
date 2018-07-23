<?php
$msg="hi i am krishna";
$result=mail("krishna192168@gmail.com","Sample mail",$msg);

   //echo date("l dS \of F Y h:i:s A");
   // print_date($date);
/*function print_date($date1)
{
    echo "$date1";
} 
*/
if($result)
{
    echo "Mail sent!";
}
else
{
    echo "Mail not sent!";
}
?>
<?php
   /*$today_date=date("d m");
   $today=strtotime("today");
   $add_date=strtotime("+1 day");
   $end_date=strtotime($today_date,$add_date);

   echo "End date:$add_date";


   $deadend=mktime(0,0,0,24,03,2017);
   $today=time();
   $difference=$deadend - $today;
   $days=round($difference/86400);
   echo "Days:$days";

   echo "
   
   <script>

   </script>
   
   ";*/
   $date_today=date_create("now");
   date_add($date_today,date_interval_create_from_date_string("1 day"));
   $final_date=date_format($date_today,'d-m-Y');
   echof $final_date;
   //echo "this is test".$final_date;
   
   //$today_date=date("d m Y");
   
   //echo ( - $today_date) / 86400 ."Days left";
   //$end_date=strtotime($today_date,$destionation_date);
   //$final_date=$today_date - $destionation_date;
   //echo $today_date;
   echo round($today_date/86400);
   //echo $end_date;
?>
<!DOCTYPE html>
<html>
<body>
<form method="post">
<input type="checkbox" name="Oncology[]" value="1">1<br>
<input type="checkbox" name="Oncology[]" value="2">2<br>
<input type="checkbox" name="Oncology[]" value="3">3<br>
<input type="submit" name="ok">
</form>
</body>
</html>
<?php
if(isset($_POST['ok']))
{
    $values=$_POST['Oncology'];
    foreach($values as $output)
    {
        echo $output."<br>";
    }
    echo $values[0];
}
?>
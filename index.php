<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	 
</head>
<body>
   <form action="index.php" method="post" enctype="multipart/form-data"> 
   	 Select text to upload:
   	 <input type="file" name="file_txt">
   	 <input type="submit" name="submit">
   </form>
</body>
<?php 

 $connect=new mysqli("localhost","root","","exm");

 if (isset($_POST['submit'])) 
 {
 	$file_dir="file/";

 	$file_name=$file_dir.$_FILES['file_txt']['name'];

 	$file_type=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

 	if ($file_type == "txt") 
 	{
 	  move_uploaded_file($_FILES['file_txt']['tmp_name'],$file_name); 

      $my_file_text=fopen($file_name,"r");
      $str=fread($my_file_text,filesize($file_name));

      $sql="INSERT INTO `text_table`(`text`) VALUES ('".$str."')";

      if ($connect->query($sql)) 
      {
        echo "The text file has been inserted successfully"; 
      }

      fclose($my_file_text);
      unlink($file_name);
    }else{
      echo"Please select a text file";
    }

 }
?>
</html>
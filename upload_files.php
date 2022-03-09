<?php

$connection=mysqli_connect("localhost","root","","php_test");

$zip_dir='public/zip';
$file_dir='public\files';

$name_parts=explode(".",$_FILES['zip_file']["name"]);
$ext=end($name_parts);
$allowed_ext=array('zip','rar');
if(in_array($ext,$allowed_ext)){
$new_file_name=time().".".$ext;

if(move_uploaded_file($_FILES['zip_file']["tmp_name"],$zip_dir.$new_file_name)){
    $result=mysqli_query($connection,"insert into files values('$_FILES[zip_file]')");
echo "file uploaded suceccfully ";
}
}
else {
    echo "file type is not allowed ";
}

$mydir = 'public/files/'; 
  
$myfiles = array_diff(scandir($mydir), array('.', '..')); 
  


$zip = new ZipArchive;
  
// Zip File Name
if ($zip->open($zip_dir.$new_file_name) === TRUE) {
  
    // Unzip Path
    $zip->extractTo($file_dir);
    $zip->close();
    echo 'Unzipped Process Successful!';
} else {
    echo 'Unzipped Process failed';
}
/********** DELETE the file******** */

If (unlink('public/zip'.$new_file_name)) {
  echo" file was successfully deleted";
} else {
    echo" file was not successfully deleted";

}


/******** lust data******** */

  $mydir = 'public/files/'; 
  
  $myfiles = array_diff(scandir($mydir), array('.', '..')); 
  
  print_r($myfiles); 

  foreach($myfiles as $file)
  {
    $name_parts=explode(".",$file);
    $ext=end($name_parts);
    if( $ext=="png")
    {
       
        ?>
        <img src="<?php echo $mydir.$file;?>" alt="<?php echo $mydir.$file;?>">
        <?php
    }
    else if( $ext=="gif")
    {
        ?>
        <img src="<?php echo $mydir.$file;?>" alt="<?php echo $mydir.$file;?>">
        <embed type="video/webm" src="<?php $mydir.$file?>" width="400" height="300"alt="<?php echo $mydir.$file;?>">
        
        <?php
    }

    else if( $ext=="pdf")

    {
      
// Header content type/*
//header("Content-type: application/pdf");
  
///header("Content-Length: " . filesize($mydir.$file));
//readfile($mydir.$file);
        ?>

        <embed src="<?php $mydir.$file?>" width="400" height="300" alt="<?php echo $mydir.$file;?>">
      <?php
    }
    else if( $ext=="jpg")
    { ?>
        <img src="<?php echo $mydir.$file;?>" alt="<?php echo $mydir.$file;?>" width="200px">
        <?php
    }

  }




?>
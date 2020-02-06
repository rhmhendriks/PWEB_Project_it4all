<?php

$imageresultdebug = "";
$resultuser = "";
$ArticleID = 18;

    require "../../../_init/initialize.php";
  $imagecategory = "article";

  // Check if form was submited 
  if (isset($_POST['submit'])) { 
    
      // Configure upload directory and allowed file types 
      $upload_dir = "../../../_images/$imagecategory/"; 
      $allowed_types = array('jpg', 'png', 'jpeg', 'gif','avi', 'mp4'); 
        
      // Define maxsize for files i.e 2MB 
      $maxsize = 100 * 1024 * 1024;  
    
      // Checks if user sent an empty form  
      if (!empty(array_filter($_FILES['files']['name']))) { 
    
          // Loop through each file in files[] array 
          foreach ($_FILES['files']['tmp_name'] as $key => $value) { 
                
              $file_tmpname = $_FILES['files']['tmp_name'][$key]; 
              $file_name = $_FILES['files']['name'][$key]; 
              $file_size = $_FILES['files']['size'][$key]; 
              $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 

              // Set upload file path 
              $filepath = $upload_dir.$file_name; 
    
              // Check file type is allowed or not 
              if (in_array(strtolower($file_ext), $allowed_types)) { 
    
                  // Verify file size - 2MB max  
                  if ($file_size > $maxsize)          
                      $resultuser .= "Het bestand: " . $file_name . " is te groot! Er geldt een maximum van 100mb.<br />";  

                  // If file with name already exist then append time in 
                  // front of name of the file to avoid overwriting of file 
                  if(file_exists($filepath)) { 
                      $filepath = $upload_dir.time().$file_name; 
                      
                      // Bestand aanmelden in de database
                      $uploadarray = MySqlDo("Add", "Media", "$file_name", "$file_ext", "$file_size", "$filepath", "$ArticleID" , "null");
                      if ($uploadarray['result']){
                        $imageresultdebug = $uploadarray['debug']; 

                        if (move_uploaded_file($file_tmpname, $filepath)) { 
                            $imageresultdebug .=  "{$file_name} successfully uploaded <br />"; 
  
                        }  
                        else {                      
                            $resultuser .= "Het bestand : {$file_name} is niet geupload! <br />"; 
                            $delarray = MySqlDo("Delete", "Media", $uploadarray['ID']); 
                            $imageresultdebug .= $delarray['debug'];
                        } 
                    } else {
                        $imageresultdebug .= $uploadarray['debug']; 
                        $resultuser .= "De afbeelding: " . $file_name . " is niet geupload!<br />";
                            }                    
                  
                    } else { 
                        $uploadarray = MySqlDo("Add", "Media", "$file_name", "$file_ext", "$file_size", "$filepath", "$ArticleID" , "null");
                        if ($uploadarray['result']){
                            $imageresultdebug = $uploadarray['debug']; 
    
                            if (move_uploaded_file($file_tmpname, $filepath)) { 
                                $imageresultdebug .=  "{$file_name} successfully uploaded <br />"; 
      
                            } else { //  sluiten bestand is verplaatst en openen bestand is niets verplaatst                   
                                $resultuser .= "Het bestand : {$file_name} is niet geupload! <br />"; 
                                $delarray = MySqlDo("Delete", "Media", $uploadarray['ID']); 
                                $imageresultdebug .= $delarray['debug'];
                            } // sluiten bestand is niet verplaatst
                        } else { // sluiten is geupload naar database, start upload gefaald
                            $imageresultdebug .= $uploadarray['debug']; 
                            $resultuser .= "De afbeelding: " . $file_name . " is niet geupload!<br />";
                                }  // sluiten upload database niet gelukt                  
                    } //bestand bestaat nog niet sluiten

          }  else { // is in array
                    
            // If file extention not valid 
            $resultuser .= "$file_name heeft een verkeerde extensie! We accepteren alleen jpg, png, jpeg, mp4 of avi<br />"; 
        } // else is in array
      }  // forech
    } // if emptyform
} //isset submit

    if (DebugisOn){
        echo "DEBUG IS ON <br>";
        echo $imageresultdebug;
    }
        echo $resultuser;
  ?> 
  
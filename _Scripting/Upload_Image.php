<?php
/**
 * Auteur: Ronald HM Hendriks
 * Beschrijving: Voorlopig script voor afbeeldingen. 
 * 
 * Laatste update: 03-02-2021 09:38
 * Updates, Comments and try to get it working
 * Door: Ronald HM Hendriks
 */
// Nu gaan we kijken naar de fotos en/of video's
                $UploadDir = "imagesfoler/$imagecategory/";
                $AllowedFileTypes = array("jpg", "png", "jpeg", "gif", "mp4", "avi");
                            
                // We gaan controleren of er media is meegegeven
                if(!empty(array_filter($_FILES['foto']['name']))){
                    foreach($_FILES['foto']['name'] as $key=>$value){
                        $filename = basename($_FILES['foto']['name'][$key]);
                        $FullUploadPath = $UploadDir . $filename;
                        $FileSize = $_FILES['foto']['size'];
                                    
                        // Bepalen van het bestandtype en het controleren of deze is toegestaan
                        $fileType = pathinfo($FullUploadPath,PATHINFO_EXTENSION);
                        if(in_array($fileType, $AllowedFileTypes)){
                
                            // Nu gaan we de afbeelding uploaden en controleren we of het goed gaat
                            if(move_uploaded_file($_FILES['foto']['name'][$key], $FullUploadPath)){
                                // Het bestand is geupload naar de juiste map, nu gaan we de database bijwerken
                                if($imagecategory == 'article'){
                                    $uploadarray = MySqlDo("Add", "Media", "$Filename", "$fileType", "$FileSize", "$FullUploadPath", "$ArticleID" , "null");
                                    if ($uploadarray['result']){
                                        $imageresultdebug = $uploadarray['debug']; 
                                        $imageresult = "De afbeeldingen zijn geupload!";
                                    } else {
                                        $imageresultdebug = $uploadarray['debug']; 
                                        $imageresult = "De afbeeldingen is niet geupload!";
                                    }
                                } else {
                                    $uploadarray = MySqlDo("Add", "Media", "$Filename", "$fileType", "$FileSize", "$FullUploadPath", "null" , "$TipTrickID");
                                    if ($uploadarray['result']){
                                        $imageresultdebug = $uploadarray['debug']; 
                                        $imageresult = "De afbeeldingen zijn geupload!";
                                    } else {
                                        $imageresultdebug = $uploadarray['debug']; 
                                        $imageresult = "De afbeeldingen is niet geupload!";
                                    }
                                }
                            } else {
                                    $imageresultdebug = "The file <b>" . $_FILES['foto']['name'][$key] . "</b> could not be moved! <br>";
                                    $imageresult = "De afbeelding is niet geupload!";
                            } 
                        } else {
                                $imageresultdebug = "The file <b>" . $_FILES['foto']['name'][$key] . "</b> could not be uploaded: <b> The file type is incorrent! </b> <br>";
                                $imageresult = "De afbeeldingen zijn niet geupload! Alleen jpg, png, jpeg, gif, mp4 en avi bestanden zijn toegestaan!";
                        }
                    }
                }
?>
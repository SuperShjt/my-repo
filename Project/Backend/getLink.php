<?php

    include 'domain-name.php';

    $ciphering = "AES-128-CTR";
    $options = 0;
    $iv = '1234235491011121';
    $key = "5AxSj9L00sATLJir";

    if(isset($_POST['isJScall'])){
        $isJScall = $_POST['isJScall'];
        if($isJScall){
            $userid= $_POST['id'];
            $usedSaletedID = $_POST['saltedID'];
            $filename = $_POST['filename'];
            $file_path = $usedSaletedID.'/'.$filename;
            $encrypted_path = openssl_encrypt($file_path, $ciphering, $key, $options, $iv);
            // Display the encrypted string
            echo "Sharable Link:<br/> <a id = 'link-clipboard' target=”_blank” href='".$DOMAIN_NAME."/share-link.php?".$encrypted_path."'>".$DOMAIN_NAME."/share-link.php?".$encrypted_path."</a>";
            //echo $_SERVER['PHP_SELF']; // $_SERVER['PHP_SELF'] = /Backend/getLink.php
            
        }  else { // Decrypt Link // https://www.myrepo.online/share-link.php?MgTHM4JJxXSWHdFp8w+MvK52xSWQb+EAaBGlKKJy
            $link = $_POST['file_url'];
            echo $link;
            $link = (explode("https://www.myrepo.online/share-link.php?",$link));
            //print_r($link);
            $path = $link[1];
            //echo "\n path is $path";
            $decrypted_path = openssl_decrypt ($path, $ciphering, $key, $options, $iv);
            echo $decrypted_path;
            //echo "Decrypted String: " . $decrypted_path;
    
        }
    }
    
    

    //echo("\nLink IS www.asdasdasdas.com/".$filename);
?>
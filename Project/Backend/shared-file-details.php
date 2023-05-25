<?php 
error_reporting(E_ERROR | E_PARSE);
include 'domain-name.php';

          $ciphering = "AES-128-CTR";
          $options = 0;
          $iv = '1234235491011121';
          $key = "5AxSj9L00sATLJir";

          session_start();

          if (isset($_POST['file_url'])){
            $link = $_POST['file_url'];
            $link = (explode("$DOMAIN_NAME/share-link.php?",$link));
            $parm = $link[1];
            $decrypted_path = openssl_decrypt($parm, $ciphering, $key, $options, $iv);
            echo ($decrypted_path);
            return;
          } else {
            
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $link = (explode("$DOMAIN_NAME/share-link.php?",$link));
            $parm = $link[1];
            $decrypted_path = openssl_decrypt($parm, $ciphering, $key, $options, $iv);

            $file_name = (explode("/",$decrypted_path))[1];
            $file_owner = substr(((explode("/",$decrypted_path))[0]), 0, -8);
            $path = getcwd()."/uploads"."/".$decrypted_path.".zip";
            $file_size = round(filesize($path)/1000000, 2); // Convert bytes to MB
            
            $_SESSION['file_name'] = $file_name;
            $_SESSION['file_owner'] = $file_owner;
            $_SESSION['file_size'] = $file_size;
          }


?>
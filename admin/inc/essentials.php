<?php 
    
    //frontend purpose data
    define('SITE_URL','http://127.0.0.1/STUDENTS-ADMISSION/');
    define('USERS_IMG_PATH',SITE_URL.'images/student/');

    //backend upload process need this data
    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/STUDENTS-ADMISSION/images/');
    define('USERS_FOLDER','student/');

    function adminLogin()
    {
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)){
            echo"<script>
              window.location.href='index.php';
            </script>";
            exit;
        }
    }

    function redirect($url){
        echo"<script>
              window.location.href='$url';
        </script>";
        exit;
    }


    function alert($type,$msg){
        $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
        echo <<<alert
            <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">$msg</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        alert;    
    }
    
    function uploadImage($image,$folder){
        $valid_mime = ['image/jpeg','image/png','image/jpg','image/webp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img';   //invalid image mime or format
        }
        else if(($image['size']/(1024*1024))>2){
            return 'inv_size';  //invalid size greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }

    }

    


    function uploadUserImage($image)
    {

         // Check if $image is set and not null
        if (!isset($image) || is_null($image)) {
            return 'inv_img'; // Invalid image data
        }

        // Check if $image['type'] is set and not null
        if (!isset($image['type']) || is_null($image['type'])) {
            return 'inv_img'; // Invalid image mime or format
        }



        $valid_mime = ['image/jpeg','image/png','image/jpg','image/webp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img';   //invalid image mime or format
        }
        else{ 
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".jpeg";

            $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

             // Ensure the directory exists   if it works keep it otherwise delte this 3 line of code
            if (!is_dir(UPLOAD_IMAGE_PATH . USERS_FOLDER)) {
            mkdir(UPLOAD_IMAGE_PATH . USERS_FOLDER, 0777, true);
            }
            if($ext == 'png' || $ext == 'PNG'){
                $img = imagecreatefrompng($image['tmp_name']);
            }
            else if($ext == 'webp' || $ext == 'WEBP'){
                $img = imagecreatefromwebp($image['tmp_name']);
            }
            else{
                $img = imagecreatefromjpeg($image['tmp_name']);
            }
        

        if(imagejpeg($img,$img_path,75)){
            return $rname;
        }
        else{
            return 'upd_failed';
        }
        }
        
    }

?>
<?php 
      
    if(isset($url)) {
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        
        switch($url[0]) {
            case 'home':
                require_once('pages/home.php');
                break;
            case 'view':
                require_once('pages/view.php');
                break;
            case 'detail':
                require_once('pages/detail.php');
                break;
            case 'payment':
                require_once('pages/payment.php');
                break;
            case 'akun':
                require_once('pages/akun.php');
                break;
            default:
                require_once('pages/home.php');
                break;
        }
    }



?>
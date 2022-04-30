<?
    session_start();
    if(isset($_SESSION['user']) && $_SESSION['user']!=''){
        session_destroy();
        header("Location:../index.php");
    }
?>
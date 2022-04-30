<?
    session_start();
    $id = $_SESSION['user'];
    if($id!=1){header("Location:../index.php");}
?>
<html>
  <body>
  <center>
    <p>
      <a href="http://localhost:8000/verify.php?token={{twilio_code}}" 
         style="background-color:#ffbe00; color:#000000; display:inline-block; padding:12px 40px 12px 40px; text-align:center; text-decoration:none;" 
         target="_blank">Verify Email Now</a>
    </p>
    <span style="font-size: 10px;"><a href=".">Email preferences</a></span>
  </center>
  </body>
</html>
<a href="registration.php?id='.$row->userid.'" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete"></span></a>




<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script src="bower_components/sweetalert/sweetalert.js"></script>

<?php
include_once'connectdb.php';

session_start();

include_once'header.php';




if(isset($_POST['btnupdate'])){

$oldpassword_txt = $_POST['txtoldpass'];
$newpassword_txt = $_POST['txtnewpass'];
$confpassword_txt =$_POST['txtconfpass'];
    
$email=$_SESSION['useremail'];
$select=$pdo->prepare("SELECT * FROM tbl_user WHERE useremail = '$email'");
    
$select->execute();    
$row=$select->fetch(PDO::FETCH_ASSOC);
    
    $useremail_db= $row['username'];
    $password_db=$row['password'];
    
    if($password_db==$oldpassword_txt){
       
    if($newpassword_txt==$confpassword_txt){
           
    $update = $pdo->prepare("update tbl_user set password=:pass where useremail=:email");
           
    
    $update->bindParam(':pass',$confpassword_txt);
   $update->bindParam(':email',$email);
    
    if($update->execute())
    {
    
            
        
      echo'<script type="text/javascript">
jQuery(function validation(){


swal({
  title: "Good job!",
  text: "Password Updated",
  icon: "success",
  button: "Ok",
});


});

</script>';
    
    }else{
        
         echo'<script type="text/javascript">
jQuery(function validation(){
  
        swal({
  title: "oOps..!",
  text: "Error in query",
  icon: "warning",
  button: "Ok",
});


});

</script>';
    } 
           
           
           
       }else{
           
        echo'<script type="text/javascript">
jQuery(function validation(){
  
        swal({
  title: "Oops Password not matched!",
  text: "Your New and Confirmed passwored are not matched !!!",
  icon: "error",
  button: "Ok",
});


});

</script>';    
           
           
           
           
       } 
        
        
        
        
        
        
        
        
        
        

        
    }else{
        
      echo'<script type="text/javascript">
jQuery(function validation(){
  
        swal({
  title: "oOps..!",
  text: "Your Password is wrong : Please Enter Right Password",
  icon: "warning",
  button: "Ok",
});


});

</script>';
        
        
    }
    

}
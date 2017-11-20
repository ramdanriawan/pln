<?php

$error=''; 

include "admin/config.php";
if(isset($_POST['submit']))
{               
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    
                    
    $query = mysqli_query($connection, "SELECT * FROM tb_login WHERE username='$username' AND password='$password'");
    if(mysqli_num_rows($query) > 0)
    {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['username']=$row['username'];
        $_SESSION['role']=$row['role'];
        $_SESSION['nama']=$row['nama'];
        
        if($row['role'] =="manager")
        {
            header("location:manager/index.php");
        }
        else if($row['role']=="admin")
        {
            header("location:admin/index.php");
        }
        else if($row['role']=="karyawan")
        {
            header("location:karyawan/index.php");
        }
        else if($row['role']=="vendoradmin")
        {
            header("location:vendoradmin/index.php");
        }
        else if($row['role']=="driver")
        {
            header("location:driver/index.php");
        }
    }
    else
    {
        //find from driver
        $query = mysqli_query($connection, "SELECT * FROM tb_sopir where username='$username' AND password='$password'");
            // echo $query;exit;
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $_SESSION['username']=$row['username'];
            $_SESSION['role']='driver';
            $_SESSION['nama']=$row['nama_sopir'];
            header("location:driver/index.php");                   
        }    
        else{
            header("location:index.php?err=Username or Password is invalid");            
        }


        
    }
}           
?>
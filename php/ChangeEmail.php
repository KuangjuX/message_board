<?php
require_once ('normal.php');
session_start();
function ChangeEmail($new_email,$user_id,$mysql){
    $sql="UPDATE user SET email=? WHERE id=?";
    $statement=$mysql->prepare($sql);
    $statement->bindParam(1,$new_email);
    $statement->bindParam(2,$user_id);
    if($statement->execute()){
        return true;
    }else{
        $errorInfo=$statement->errorInfo()[2];
        echo "<script>alert(`error:$errorInfo`)</script>";
        return false;
    }
}


$user_id=$_SESSION["user_id"];
$new_email=$_POST["new_email"];

if(Judge()){
    $mysql=Connect();
    $flag=ChangeEmail($new_email,$user_id,$mysql);
    if($flag){
        $_SESSION["email"]=$new_email;
        echo "<script>alert('修改成功')</script>";
        echo '<script>setTimeout(function(){window.location.href="index.php";},500);</script>';
    }else{
        echo "<script>alert('修改失败')</script>";
        echo '<script>
    setTimeout(function(){window.location.href="index.php";},500);</script>';
    }

}else{
    echo '<script>alert(`您没有登录`)</script>';
    echo '<script>setTimeout(function () {
        window.location.href=\'../index.html\';
    },500);</script>';
}
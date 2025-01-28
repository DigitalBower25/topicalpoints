<?php

 include_once('connect.php');

 if(isset($_POST)){
    $article_id=$_POST['title'];
    $name=$_POST['cname'];
    $email=$_POST['cmail'];
    $comment=$_POST['comment'];
    $comment_date=date('Y-m-d');
    $sql='insert into comments (`article_id`, `comment`, `email`, `name`,`comment_date`) values (?,?,?,?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss',$article_id,$comment,$email,$name,$comment_date);
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo "0" . $stmt->error;
    }

    $stmt->close();
 }



?>
<?php

if( isset($_POST["studentId"]) && !empty($_POST["studentId"]) ){
    if( $attendance = selectDB("attendance","`studentId` = '{$_POST["studentId"]}' AND `attendanceDate` = '{$_POST["attendanceDate"]}'") ){
        updateDB("attendance",array('type'=> $_POST["type"] ),"`id` = '{$attendance[0]["id"]}'");
    }else{
        insertDB("attendance",$_POST);
    }
}

?>
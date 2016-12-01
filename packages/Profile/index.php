<?php
    /* DB connection */
    $hostName = "localhost";
    $hostUser = "root";
    $hostPw = "admin";
    $dbName = "credume";

    $connection = new mysqli($hostName, $hostUser, $hostPw, $dbName);

    if (!$connection)
        die("Connection Failed!");
    /**/
    $profileId = $_GET['id'];
    $friendList = array();
    $courseList = array();
    $userName;
    $userSurname;
    $userMail;
    $userPhone;

    /* Get the query results and store them in arrays - FriendList and CoursesTaken */
    $userInfoQuery = "SELECT FIRST_NAME,LAST_NAME,EMAIL,PHONE_NO FROM USERS WHERE ID ='".$profileId."'";
    $userInfoQueryResult = mysqli_query($connection,$userInfoQuery);
    $friendQuery =  "SELECT SECOND_USER_ID,FIRST_NAME,LAST_NAME FROM FRIENDSHIP JOIN USERS ON SECOND_USER_ID = ID 
                     WHERE FIRST_USER_ID = '".$profileId."'";
    $friendQueryResult = mysqli_query($connection, $friendQuery);
    $courseQuery = "SELECT COURSE_ID FROM COURSESTAKEN WHERE USER_ID ='".$profileId."'";
    $courseQueryResult = mysqli_query($connection, $courseQuery);

    if(!$userInfoQueryResult){
        throw new Exception("User Query error");
    }

    if(!$friendQueryResult){
        throw new Exception("Friend List Query error ");
    }

    if(!$courseQueryResult){
        throw new Exception("Course query error");
    }

    while ($row = mysqli_fetch_assoc($userInfoQueryResult)){
        $userName = $row["FIRST_NAME"];
        $userSurname = $row["LAST_NAME"];
        $userMail = $row["EMAIL"];
        $userPhone = $row["PHONE_NO"];
    }

    while ($row = mysqli_fetch_assoc($friendQueryResult)){
        /* Stores the friend Query result in array as FriendID = Key, First_name + Last_name = Value */
        $friendID=array_shift($row);
        $friendList[$friendID] = $row["FIRST_NAME"]." ".$row["LAST_NAME"];
    }

    while ($row = mysqli_fetch_assoc($courseQueryResult)){
        array_push($courseList,$row["COURSE_ID"]);
    }

    /* Display for Testing */
    echo("Name : ".$userName." ".$userSurname."<br/>");
    echo("Mail : ".$userMail."<br/>");
    echo("Phone : ".$userPhone."<br/>");
    echo("Friends: "."<br/>");
    echo("background-color:#ffbf80");
    foreach($friendList as $key => $value){
        echo $key.  ":".$value."<br/>";
    }
    echo("Courses: "."<br/>");
    foreach($courseList as $key => $value){
        echo $key.":".$value."<br/>";
    }
    mysqli_close($connection);
    /**/
?>

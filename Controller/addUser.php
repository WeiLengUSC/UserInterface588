<?php
/**
 * Created by PhpStorm.
 * User: weileng
 * Date: 4/3/15
 * Time: 12:59 PM
 */
/*
 * for user part mongo db collection name is "AllUsers"
AllUsers{
    "user_email" : "weileng@usc.edu",
    "user_name" :  "weileng",
    "user_pwd"  : "12345678"
}
 *
 * */

function connectMongoDB()
{
    $connection = new MongoClient('mongodb://588Group:snapost8304@ds061558.mongolab.com:61558/snapost_db');
    $db =  $connection->selectDB('snapost_db');
    return $db;
}


function addUser($document, $collection){
    try {
        $collection->insert($document);
        $feedback = array(
            "add_success" => "success"
        );
        return $feedback;
    } catch(MongoException $e){
        $feedback = array(
            "error" => "failure"
        );
        return $feedback;
    }
}

function insertUser($username, $password, $email)
{
    $document = array(
        "user_email" => $email,
        "user_name" => $username,
        "user_pwd" => $password
    );

    $db = connectMongoDB();
    $collection = $db->selectCollection('AllUsers');
    $user = $collection->find(array("user_email" => $email));
    if(($user->count()) == 0)
        return json_encode(addUser($document, $collection));
    else{
        $feedback = array(
                "exist" => "exist"
            );
        return json_encode($feedback);
    }
}

function userLogin($password, $email)
{
    $document = array(
        "user_email" => $email,
        "user_pwd" => $password
    );

    $db = connectMongoDB();
    $collection = $db->selectCollection('AllUsers');
    $user = $collection->find(array("user_email" => $email));
    if(($user->count()) > 0){
        //login success
        $feedback = array(
            "success" => "login success"
        );
        return json_encode($feedback);
    }
    else{
        $feedback = array(
            "failure" => "login failure"
        );
        return json_encode($feedback);
    }
}



function setSession()
{
    if (!isset($_SESSION['CREATED'])) {
        $_SESSION['CREATED'] = time();
    } else if (time() - $_SESSION['CREATED'] > 1800) {
        // session started more than 30 minutes ago
        header("Refresh: 60; Location: ../makePost.html");
        session_destroy();
    }
}

function startSession($user_email){
    $_SESSION['user_email'] = $user_email;
    $_SESSION['CREATED'] = time();
    //header("Refresh: 60; Location: /path/somepage.php");
}


//session_start();
//setSession();

if(isset($_POST)){

    if(!empty($_POST["addUser"]))
    {
        $username = $_POST["user_name"];
        $password = $_POST["pass_word"];
        $email = $_POST["user_email"];
        echo insertUser($username, $password, $email);
        return;
    }
    if(!empty($_POST["loginUser"])){
        $password = $_POST["pass_word"];
        $email = $_POST["user_email"];
        echo userLogin($password, $email);
        return;
    }
    $feedback = array(
        "error" => "failure"
    );
    echo json_encode($feedback);
}
else{
    $feedback = array(
        "error" => "failure"
    );
    echo json_encode($feedback);
}

/*
*  try
{
$db = connectMongoDB();
$collection = $db->selectCollection('Post');

$cursor = $collection->find();
$info;
foreach ($cursor as $document) {
$info = $document;
}
echo json_encode($info);
}
catch(MongoConnectionException $e)
{
die("Failed to connect to database ".$e->getMessage());
}
* */

?>

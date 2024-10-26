<?php
$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

$ProfID = $_POST['ProfID'];
$mail = $_POST['mail'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$password= $_POST['password'];
$Degree = $_POST['Degree'];

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn)
    die(print_r(sqlsrv_errors(),true));
else{
    $tsql = "EXECUTE Insert_professor '$ProfID', '$mail', '$name', null, '$sex', '$password', '$Degree'";
    $stmt = sqlsrv_query($conn,$tsql);
    if($stmt == false){
        $errors = sqlsrv_errors();
        if ($errors != null) {
            foreach ($errors as $error) {
                echo $error['message']."<br>";
            }
        }
        $check = true;
        if(!($sex == 'Male' || $sex == 'Female')){
            $check = false;
            echo 'Gioi tinh khong hop le'."<br>";
        }
        if (strpos($mail, '@hcmut.edu.vn') == false) {
            $check = false;
            echo "Email khong thuoc truong Dai hoc Bach Khoa"."<br>";
        }
        if($check) {
            echo 'Them giang vien thanh cong'."\n";
            $targetUrl = "professors.php";
            $linkText = "Di den danh sach giang vien"; // Text displayed on the link
            echo "<a href='$targetUrl'>$linkText</a>";
        }
    }else {
        echo 'Them giang vien thanh cong'."\n";
        $targetUrl = "professors.php";
        $linkText = "Di den danh sach giang vien"; // Text displayed on the link
        echo "<a href='$targetUrl'>$linkText</a>";
    }
}
$conn = null;
?>
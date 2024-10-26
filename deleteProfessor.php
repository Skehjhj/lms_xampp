<?php
$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn)
    die(print_r(sqlsrv_errors(),true));
else{
    $tsql = "EXECUTE DeleteUnusedProfessor";
    $stmt = sqlsrv_query($conn,$tsql);
    if($stmt == false){
      $errors = sqlsrv_errors();
      foreach ($errors as $error) {
          echo "SQLSTATE: ".$error['SQLSTATE']."\n";
          echo "Code: ".$error['code']."\n";
          echo "Message: ".$error['message']."\n";
      }
    }else {
        echo 'Xoa giang vien khong su dung thanh cong'."\n";
        $targetUrl = "professors.php";
        $linkText = "Di den danh sach giang vien"; // Text displayed on the link
        echo "<a href='$targetUrl'>$linkText</a>";
    }
}
$conn = null;
?>

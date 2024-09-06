<?php
// Database connection

$conn = mysqli_connect('localhost','root','','bharath');
if($conn==true){
    echo "success";
}
else
echo "fail"
$conn->close();
?>

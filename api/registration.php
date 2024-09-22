<?php
include("connect.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$photo = $_FILES['photo']['name'];
$temp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

if ($password == $cpassword) {
    move_uploaded_file($temp_name, "../uploads/$image");

    $sql = "INSERT INTO user (name, mobile, password, address, photo, role, status, votes)
            VALUES ('$name', '$mobile', '$password', '$address', '$photo', '$role', 0, 0)";
    
    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo '<script>
                alert("Registration Successful!");
                window.location = "../";
              </script>';
    } else {
        echo '<script>
                alert("Some error occurred: ' . mysqli_error($connect) . '");
                window.location = "../routes/register.html";
              </script>';
    }
} else {
    echo '<script>
            alert("Password and Confirm Password do not match");
            window.location = "../routes/register.html";
          </script>';
}
?>

<?php
session_start();
include('connect.php');

$votes = $_POST['gvotes'];
$total_votes = $votes + 1;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

$sql = "UPDATE user SET votes='$total_votes' WHERE id='$gid'";
$update_votes = mysqli_query($connect, $sql);

$userstatus = "UPDATE user SET status=1 WHERE id='$uid'";
$update_user_status = mysqli_query($connect, $userstatus);

if($update_votes and $update_user_status){
    $groupfetch = "SELECT * FROM user WHERE role='2'";
    $groups = mysqli_query($connect, $groupfetch);
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;
    echo'
    <script>
        alert("Voted Successful");
        window.location = "../routes/dashboard.php";
    </script>';
}
else{
    echo'
        <script>
            alert("Some error occured");
            window.location = "../routes/dashboard.php";
        </script>';
}
?>
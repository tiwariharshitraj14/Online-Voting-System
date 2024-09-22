<?php 
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
    $status = '<b style="color:red">Not Voted</b>';
}
else{
    $status = '<b style="color:green">Voted</b>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Online Voting System - Dashboard</title>
</head>
<style>
    .btn-left {
        float: left;
        margin: 10px;
    }

    .btn-right {
        float: right;
        margin: 10px;
    }

    img{
        float: right;
    }
    #header{
        padding: 10px;
    }

</style>

<body>
    <div id="main">
        <center>
            <div id="header">
            <a href="../"><button id="btn" class="btn-left">Back</button></a>
            <a href="logout.php"><button id="btn" class="btn-right">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
        </center>
        <hr>
        <div id="mainpanel">
        <div id="profile">
            <center><img src="../uploads/<?php echo $userdata['photo']?>"></center><br><br>
            <b>Name: </b><?php echo $userdata['name']?><br><br>
            <b>Mobile: </b><?php echo $userdata['mobile']?><br><br>
            <b>Address: </b><?php echo $userdata['address']?><br><br>
            <b>Status: </b><?php echo $status?><br><br>
        </div>
        <div id="group">
            <?php
            if($_SESSION['groupsdata']){
                for($i = 0; $i < count($groupsdata); $i++){
                    ?>
                    <div>
                        <img src="../uploads/<?php echo $groupsdata[$i]['photo']?>">
                        <b>Group Name: </b><br><br>
                        <b>Votes: </b><?php echo $groupsdata[$i]['votes']?><br><br>
                        <form action="../api/vote.php" method="post">
                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                            <?php 
                            if($_SESSION['userdata']['status']== 0){
                                ?>
                                 <input type="submit" name="votebtn" value="vote" id="votebtn">
                                <?php
                            }
                            else{
                                ?>
                                <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
                                <?php
                            }
                            ?>
                           
                        </form>
                    </div>
                    <hr>
                    <?php
                }
            }
            else{

            }
            ?>
        </div>
        </div>
    </div>


</body>

</html>
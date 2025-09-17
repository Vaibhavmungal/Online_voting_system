<?php 
include('session.php');
include('dbcon.php');
include('header.php');
?>
<?php
if (isset($_POST['vote'])){
    $gov = $_POST['gov'];
    mysqli_query($conn, "insert into votes (CandidateID)values('$gov')") or die(mysqli_error());

    $vice = $_POST['vice'];
    mysqli_query($conn, "insert into votes (CandidateID)values('$vice')") or die(mysqli_error());

    $rep1 = $_POST['rep1'];
    mysqli_query($conn, "insert into votes (CandidateID)values('$rep1')") or die(mysqli_error());

    mysqli_query($conn, "update voters set Status='Voted' where VoterID='$session_id'") or die(mysqli_error());

    _redirect('thankyou.php');
}
?>

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="admin/css/style.css" />
<script src="jquery.iphone-switch.js" type="text/javascript"></script>
</head>
<body style="background-image: url('../images/college-bg.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">

<div class="navbar navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
    <a class="brand">
        <img src="admin/images/mbes.png" width="60" height="60">
    </a>
    <a class="brand">
        <h2>mbes college of engineering ambajogai Voting System</h2>
        <div class="chmsc_nav"><font size="4" color="white">mbes college of engineering ambajogai</font></div>
    </a>
    <?php include('head.php'); ?>
</div>
</div>
</div>

<div class="wrapper">
<div class="hero-body-voting">
    <div class="vote_wise1"><font color="white" size="6">"Official Ballot"</font></div>
    <div class="back">
        <a class="btn btn-info" id="bak" href="voting.php"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a>
    </div>
</div>

<div class="hero-body-456"></div>

<form method="POST">
<?php 
$governor = $_POST['governor'];
$vice1 = $_POST['vice'];
$representative1 = $_POST['representative1'];

// Governor
$result = mysqli_query($conn, "select * from candidate where CandidateID='$governor'") or die(mysqli_query($conn,));
$row = mysqli_fetch_array($result);
$name = $row['FirstName']."  ".$row['LastName'];

// Vice-Governor
$vice = mysqli_query($conn, "select * from candidate where CandidateID='$vice1'") or die(mysqli_query($conn,));
$row_vice = mysqli_fetch_array($vice);
$name1 = $row_vice['FirstName']."  ".$row_vice['LastName'];

// Representative1
$Representative1 = mysqli_query($conn, "select * from candidate where CandidateID='$representative1'") or die(mysqli_query($conn,));
$Representative1_row = mysqli_fetch_array($Representative1);
$name2 = $Representative1_row['FirstName']."  ".$Representative1_row['LastName'];
?>

<div class="ballot">
<div class="cent">
<p>Governor:&nbsp;&nbsp;</p>
<?php 
echo $name; 
if ($governor == "--Select Candidate--") {
    echo 'NO Candidate Selected'; 
}
?>
<input type="hidden" name="gov" value="<?php echo $governor; ?>"/>
</div>
</br></br>

<div class="cent">
<p>Vice-Governor:&nbsp;&nbsp;</p>
<?php 
echo $name1;
if ($vice1 == "--Select Candidate--") {
    echo 'NO Candidate Selected'; 
}
?>
<input type="hidden" name="vice" value="<?php echo $vice1; ?>"/>
</div>
</br></br>

<div class="cent">
<p>1st Year Representative:&nbsp;&nbsp;</p>
<div class="rep2" style="text-align: center; font-size: 18px; margin-top: 10px;">
<?php
if ($representative1 == '--Select Candidate--') {
    echo 'No Candidate Selected';
} else {
    echo $name2;
}
?>
<input type="hidden" name="rep1" value="<?php echo $representative1; ?>"/>
</div>
</div>

<div class="hero-body-456">
<div class="ok_vote">
    <a class="btn btn-success" id="logout" data-toggle="modal" href="#myModal"><i class="icon-off"></i>&nbsp;Submit Final Votes</a>
    <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3> </h3>
        </div>
        <div class="modal-body">
            <p><font color="gray">Are You Sure you Want to Submit Final Votes?</font></p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">No</a>
            <button id="save_voter" class="btn btn-success" name="vote"><i class="icon-save icon-large"></i>&nbsp;Yes</button>
        </div>
    </div>
</div>
</div>

</form>
<?php include('footer1.php')?>    
</div>
</body>
</html>

<?php
ob_start();
include('session.php');
include('dbcon.php');
include('header.php');

if (isset($_POST['vote'])) {
    $gov = $_POST['gov'];
    $vice = $_POST['vice'];
    $rep1 = $_POST['rep1'];

    // Insert votes
    mysqli_query($conn, "INSERT INTO votes (CandidateID) VALUES ('$gov')") or die(mysqli_error($conn));
    mysqli_query($conn, "INSERT INTO votes (CandidateID) VALUES ('$vice')") or die(mysqli_error($conn));
    mysqli_query($conn, "INSERT INTO votes (CandidateID) VALUES ('$rep1')") or die(mysqli_error($conn));

    // Update voter status
    mysqli_query($conn, "UPDATE voters SET Status='Voted' WHERE VoterID='$session_id'") or die(mysqli_error($conn));

    header('Location: thankyou.php');
    exit();
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
        <h2>MBES College of Engineering Ambajogai Voting System</h2>
        <div class="chmsc_nav"><font size="4" color="white">MBES College of Engineering Ambajogai</font></div>
    </a>
    <?php include('head.php'); ?>
</div>
</div>
</div>

<div class="wrapper">
<div class="hero-body-voting">
    <div class="vote_wise1"><font color="white" size="6">"Official Ballot"</font></div>
    <div class="back">
        <a class="btn btn-info" id="bak" href="voting2.php"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a>
    </div>
</div>

<div class="hero-body-456"></div>

<form method="POST">
<?php
if (isset($_POST['save'])) {
    $governor = $_POST['governor'];
    $vice = $_POST['vice'];
    $representative1 = $_POST['representative1'];

    function getCandidateName($id, $conn) {
        $query = mysqli_query($conn, "SELECT FirstName, LastName FROM candidate WHERE CandidateID='$id'");
        $row = mysqli_fetch_assoc($query);
        return $row ? $row['FirstName'] . ' ' . $row['LastName'] : 'Unknown';
    }

    $nameGov = getCandidateName($governor, $conn);
    $nameVice = getCandidateName($vice, $conn);
    $nameRep1 = getCandidateName($representative1, $conn);
?>

<div class="ballot">
    <div class="cent">
        <p>Governor:</p>
        <?php echo $nameGov; ?>
        <input type="hidden" name="gov" value="<?php echo $governor; ?>" />
    </div><br><br>

    <div class="cent">
        <p>Vice-Governor:</p>
        <?php echo $nameVice; ?>
        <input type="hidden" name="vice" value="<?php echo $vice; ?>" />
    </div><br><br>

    <div class="cent">
        <p>Representative:</p>
        <?php echo $nameRep1; ?>
        <input type="hidden" name="rep1" value="<?php echo $representative1; ?>" />
    </div>
</div>

<div class="hero-body-456">
    <div class="ok_vote">
        <a class="btn btn-success" id="logout" data-toggle="modal" href="#myModal"><i class="icon-off"></i>&nbsp;Submit Final Votes</a>
        <div class="modal hide fade" id="myModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Confirmation</h3>
            </div>
            <div class="modal-body">
                <p><font color="gray">Are you sure you want to submit final votes?</font></p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">No</a>
                <button id="save_voter" class="btn btn-success" name="vote"><i class="icon-save icon-large"></i>&nbsp;Yes</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</form>

<?php include('footer1.php'); ?>
</div>
</body>
</html>
<?php ob_end_flush(); ?>

<?php 
include('session.php');
include('dbcon.php');
include('header.php');
?>
<link rel="stylesheet" type="text/css" href="admin/css/style.css" />
<script src="jquery.iphone-switch.js" type="text/javascript"></script>

<style>
  .gov {
    margin: 10px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s ease;
  }
  .gov:hover {
    transform: scale(1.05);
  }
  .margin-represent {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
  }
</style>

</head>
<body style="background-image: url('../images/college-bg.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand">
        <img src="admin/images/mbes.png" width="60" height="60">
      </a>
      <a class="brand">
        <h2>college of engineering ambajogai Voting System</h2>
        <div class="mbes_nav"><font size="4" color="white">mbes college of engineering ambajogai</font></div>
      </a>
      <?php include('head.php'); ?>
    </div>
  </div>
</div>

<div class="wrapper">
  <div class="hero-body-voting">
    <div class="vote_wise"><font color="white" size="6">"Please Vote Wisely"</font></div>
    <div class="help">
      <a class="btn btn-info" id="help" href="voting4.php"><i class="icon-info-sign icon-large"></i>&nbsp;Help</a>
    </div>
  </div>

  <form method="post" action="vote4.php">

    <!-- Governor -->
    <div class="gov-align">
      <div class="hero-body-candidate_gov">
        <font color="white">Candidate for Governor</font>
      </div>
      <div class="governor">
        <div class="gov-margin">
          <?php 
          $governor = mysqli_query($conn,"SELECT * FROM candidate WHERE Position='Governor'") or die(mysqli_error());
          while($row = mysqli_fetch_array($governor)){ $governor_id = $row['CandidateID']; ?>
            <img class="gov" src="<?php echo $row['Photo'];?>" width="150" height="150" 
              onmouseover="showtrail('<?php echo $row['Photo'];?>','<?php echo $row['FirstName']." ".$row['LastName'];?>',200,5)"
              onmouseout="hidetrail()">
          <?php } ?>
        </div>
      </div>
      <div class="select_gov">
        <div class="margin-gov">
          <select name="governor" class="span222">
            <option class="option">--Select Candidate--</option>
            <?php
            $governor = mysqli_query($conn,"SELECT * FROM candidate WHERE Position='Governor'") or die(mysqli_error());
            while($row = mysqli_fetch_array($governor)){ ?>
              <option value="<?php echo $row['CandidateID']; ?>" class="option"><?php echo $row['FirstName']." ".$row['LastName']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>

    <!-- Vice-Governor -->
    <div class="vice-align">
      <div class="hero-body-candidate1">
        <font color="white">Candidate for Vice-Governor</font>
      </div>
      <div class="governor">
        <div class="gov-margin">
          <?php 
          $vice = mysqli_query($conn,"SELECT * FROM candidate WHERE Position='Vice-Governor'") or die(mysqli_error());
          while($row = mysqli_fetch_array($vice)){ ?>
            <img class="gov" src="<?php echo $row['Photo'];?>" width="150" height="150" 
              onmouseover="showtrail('<?php echo $row['Photo'];?>','<?php echo $row['FirstName']." ".$row['LastName'];?>',200,5)"
              onmouseout="hidetrail()">
          <?php } ?>
        </div>
      </div>
      <div class="select_gov">
        <div class="margin-gov">
          <select name="vice" class="span222">
            <option class="option">--Select Candidate--</option>
            <?php
            $vice = mysqli_query($conn,"SELECT * FROM candidate WHERE Position='Vice-Governor'") or die(mysqli_error());
            while($row = mysqli_fetch_array($vice)){ ?>
              <option value="<?php echo $row['CandidateID']; ?>" class="option"><?php echo $row['FirstName']." ".$row['LastName']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>

    <!-- 4th Year Representative -->
    <div class="rep-align">
      <div class="hero-body-rep">
        <font color="white">Candidate for 4th Year Representative</font>
      </div>
      <div class="represent">
        <div class="margin-represent">
          <?php 
          $representative = mysqli_query($conn,"SELECT * FROM candidate WHERE Position='4th Year Representative' ORDER BY FirstName ASC") or die(mysqli_error());
          while($row = mysqli_fetch_array($representative)){ ?>
            <img class="gov" src="<?php echo $row['Photo'];?>" width="70" height="70" 
              onmouseover="showtrail('<?php echo $row['Photo'];?>','<?php echo $row['FirstName']." ".$row['LastName'];?>',200,5)"
              onmouseout="hidetrail()">
          <?php } ?>
        </div>
      </div>
      <div class="select_rep">
        <div class="margin-gov">
          <div class="span44">
            <select name="representative1" class="span222">
              <option class="option1">--Select Candidate--</option>
              <?php
              $representative = mysqli_query($conn,"SELECT * FROM candidate WHERE Position='4th Year Representative' ORDER BY FirstName ASC") or die(mysqli_error());
              while($row = mysqli_fetch_array($representative)){ ?>
                <option value="<?php echo $row['CandidateID']; ?>" class="option1"><?php echo $row['FirstName']." ".$row['LastName']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Submit Buttons -->
    <div class="thumbnail_widget">
      <div class="submit-vote">
        <button class="btn btn-success" name="save"><i class="icon-thumbs-up icon-large"></i>&nbsp;Submit Vote</button>
      </div>
    </div>

    <div class="thumbnail_widget1">
      <div class="submit-vote">
        <a class="btn" id="index" data-toggle="modal" href="#myModal"><i class="icon-circle-arrow-left icon-large"></i>&nbsp;Vote later</a>
      </div>
    </div>

  </form>

  <br>

  <div class="foot">
    <?php include('footer1.php'); ?>
  </div>
</div>

<!-- Vote Later Modal -->
<div class="modal hide fade" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Vote Later</h3>
  </div>
  <div class="modal-body">
    <p><font color="gray">Are you sure you want to vote later?</font></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">No</a>
    <a href="logout_back.php" class="btn btn-primary">Yes</a>
  </div>
</div>

</body>
</html>

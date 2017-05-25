<?php
/*
 * admin.php
 * - only logged in user can see
 * - check status of file, using "stat <file.pdf>"
 */

require('config.php');

//check if logged in
if (empty($_SESSION['username'])){
    $error_msg = 'You are not admin. Please login first.';
    header('Location: index.php?msg='.$error_msg);
    die($error_msg);

}else if($_SESSION['username'] !== 'admin'){

    $error_msg = 'Admin Only!';
    header('Location: index.php?msg='.$error_msg);
    die($error_msg);

}

// query all private messages from database
$posts = array();
$sql = "select * from messages where receiver=? order by created_date desc;";
$stmt = $db->prepare($sql);
$stmt->execute([$_SESSION['username']]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>OWASP-TH: Admin Page</title>
  <link rel="stylesheet" href="public/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="public/css/style.css">
  <script src="public/js/jquery.min.js"></script>
  <script src="public/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="public/img/logo_sm.png" alt="OWASP Thailand Logo"/>
            OWASP-TH Workshop 2: <?=$team?>
        </a>
      </div><!--/.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li class="active"><a href="admin.php">Admin</a></li>
        </ul><!-- /.navbar -->
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#" class="username"><?=$_SESSION['username']?></a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul><!-- /.navbar-right -->
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->

  <div class="container">

    <div id="header" class="row">
      <div class="col-md-12 center">
        <h1>OWASP-TH Workshop 2: Admin Page</h1>
        <p>
          You're logged in as
          <span class="username"><?=$_SESSION['username']?></span>
        </p>
      </div>
    </div><!-- /#header -->

    <hr/>

    <?php if(!empty($messages)): ?>
      <!-- show all messages -->
      <div id="messages" class="row">
        <div class="col-md-6 col-md-offset-3">
          <h3>Private Messages for <?=$_SESSION['username']?>:</h3>
      	<?php foreach($messages as $message): ?>
          <div class="panel panel-warning">
            <div class="panel-heading">
              From: <?=$message['sender']?> @ <?=$message['created_date']?>
            </div>
            <div class="panel-body"><?=$message['message']?></div>
          </div><!-- /panel -->
      	<?php endforeach; ?>
        </div>
      </div><!-- /#messages -->
    <?php endif; ?>

  </div><!-- /.container -->
</body>
</html>

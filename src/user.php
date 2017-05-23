<?php
/*
 * admin.php
 * - only logged in user can see
 * - check status of file, using "stat <file.pdf>"
 */

require('config.php');

//check if logged in
if (empty($_SESSION['username'])){
    $error_msg = 'You are not login. Please login first.';
    header('Location: index.php?msg='.$error_msg);
    die($error_msg);

}else if($_SESSION['username'] === 'admin'){

    $error_msg = 'redirecting to admin page';
    header('Location: admin.php');
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
  <title>OWASP-TH: User Page</title>
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
        <h1>OWASP-TH Workshop 2: User Page</h1>
        <p>
          You're logged in as
          <span class="username"><?=$_SESSION['username']?></span>
        </p>
      </div>
    </div><!-- /#header -->

    <hr/>

    <?php if(!empty($messages)): ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h2>Private Messages:</h2>
    	<?php foreach($messages as $message): ?>
        <div class="panel panel-primary">
          <div class="panel-heading"></div>
          <div class="panel-body"><?=$message['message']?></div>
          <div class="panel-footer">
            From: <?=$message['sender']?> @ <?=$message['created_date']?>
          </div>
        </div>
    	<?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

  </div><!-- /.container -->
</body>
</html>

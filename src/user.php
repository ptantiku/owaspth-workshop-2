<?php
/*
 * user.php
 * - only logged-in user
 * - can post to public
 * - can private message to admin
 * - can see admin's reply messages
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
          <li class="active"><a href="user.php">User</a></li>
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

    <?php if(!empty($_GET['success_msg'])): ?>
      <!-- display success message -->
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> <?=$_GET['success_msg']?>
          </div><!-- /.alert -->
        </div>
      </div>
    <?php endif; ?>

    <?php if(!empty($_GET['error_msg'])): ?>
      <!-- display error message -->
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> <?=$_GET['error_msg']?>
          </div><!-- /.alert -->
        </div>
      </div>
    <?php endif; ?>

    <div id="public-post" class="row">
      <div class="col-md-6 col-md-offset-3">
        <h3>Post a public message</h3>
        <form method="post" action="post.php">
          <div class="form-group">
            <label for="title">Post Title</label>
            <input id="title" name="title" type="text" class="form-control" placeholder="Post Title">
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="form-control" rows=3 placeholder="Message"></textarea>
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div><!-- /#public-post -->

    <hr/>

    <div id="private-message" class="row">
      <div class="col-md-6 col-md-offset-3">
        <h3>Send a message to admin</h3>
        <form method="post" action="dm.php">
          <div class="panel panel-warning">
            <div class="panel-heading">
              message            
            </div>
	    <div class="panel-body">
              <textarea id="message" name="message" class="form-control" rows=3 placeholder="Message"></textarea>
            </div>
          </div><!-- /panel -->
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div><!-- /#private-message -->

  </div><!-- /.container -->
</body>
</html>

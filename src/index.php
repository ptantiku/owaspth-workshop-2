<?php
/* WARNING: This code is vulnerable. */
/*
 * index.php
 * - main page
 * - display posts
 */
require('config.php');

// query all posts from database
$posts = array();
$sql = "select * from posts order by created_date desc;";
$posts = $db->query($sql,PDO::FETCH_ASSOC)->fetchAll();

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>OWASP-TH</title>
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
          <li class="active"><a href="#">Home</a></li>

          <?php if(isset($_SESSION['username']) && $_SESSION['username']==='admin'): ?>
            <li><a href="admin.php">Admin</a></li>
          <?php endif; ?>
	  <?= session_id() ?>

        </ul><!-- /.navbar -->
        <ul class="nav navbar-nav navbar-right">

          <?php if(!empty($_SESSION['username'])): ?>

            <li><a href="#" class="username"><?=$_SESSION['username']?></a></li>
            <li><a href="logout.php">Logout</a></li>

          <?php else: ?>

	    <li>
	      <form class="form-inline" method="post" action="login.php">
    	        <input type="text" class="form-control" id="username" name="username" placeholder="username">
    	        <input type="password" class="form-control" id="password" name="password" placeholder="password">
		<button type="submit" class="form-control">Login</button>
	      </form>
	    </li>

          <?php endif; ?>

        </ul><!-- /.navbar-right -->
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->

  <div class="container">

    <div id="header" class="row">
      <div class="col-md-12 center">
        <h1>Welcome to OWASP-TH Workshop 2</h1>
      </div>
    </div><!-- /#header -->

    <hr/>

    <?php if(!empty($_GET['msg'])): ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Error!</strong> <?=$_GET['msg']?>
        </div><!-- /.alert -->
      </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($posts)): ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h2>Posts:</h2>
    	<?php foreach($posts as $post): ?>
        <div class="panel panel-primary">
          <div class="panel-heading"><?=$post['title']?></div>
          <div class="panel-body"><?=$post['message']?></div>
          <div class="panel-footer">
            From: <?=$post['owner']?> @ <?=$post['created_date']?>
          </div>
        </div>
    	<?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

  </div><!-- /.container -->

</body>
</html>

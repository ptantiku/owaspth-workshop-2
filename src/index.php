<?php
/* WARNING: This code is vulnerable. */
/*
 * index.php
 * - main page
 * - search for books
 */

require('config.php');

// deal with cookie
if(empty($_COOKIE['username'])){
    setcookie('username', 'anonymous');
    $username = 'anonymous';
}else {
    $username = $_COOKIE['username'];
}

//check if logged in
if ($username == 'anonymous'){
    $loggedin = false;
}else{
    $loggedin = true;
}

// query books from database
if(empty($_GET['query'])){
    $sql = 'select * from users limit 10';
}else{
    $query = '%'.$_GET['query'].'%';
    $sql = "select * from users where username like '$query' limit 10";
}

// set default value for books
$books = array();

try{
    foreach($db->query($sql,PDO::FETCH_ASSOC) as $row){
        // pull data from database into $books
        array_push($books, $row);
    }
}catch (PDOException $ex){
    echo $ex->getMessage();
}
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
            OWASP-TH Workshop 2: <?php echo $team; ?>
        </a>
      </div><!--/.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>

          <?php if($loggedin): ?>

            <li><a href="admin.php">Admin</a></li>

          <?php endif; ?>

        </ul><!-- /.navbar -->
        <ul class="nav navbar-nav navbar-right">

          <?php if($loggedin): ?>

            <li><a href="#" class="username"><?php echo $username; ?></a></li>
            <li><a href="logout.php">Logout</a></li>

          <?php else: ?>

            <li><a href="login.php">Login</a></li>

          <?php endif; ?>

        </ul><!-- /.navbar-right -->
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->

  <div class="container">

    <div id="header" class="row">
      <div class="col-md-12 center">
        <h1>Welcome to OWASP-TH Workshop 2</h1>

        <?php if(empty($username)): ?>

          <h4>You need to login to see the page.</h4>
          <h4><a class="label label-primary" href="login.php">Login here</a></h4>

        <?php endif; ?>

      </div>
    </div><!-- /#header -->

    <hr/>

    <div id="search-form" class="row">
      <div class="col-md-12">
        <form class="form-horizontal" method="GET" action="">
          <div class="form-group">
            <div class="input-group">
              <input id="query" name="query" type="text" class="form-control" placeholder="Search for books using title or author name ...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Search</button>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div><!-- /#search-form -->

    <?php if(isset($_GET['query'])): ?>

      <div class="row">
        <div class="col-md-12">
          <h4>Search for: <?php echo $_GET['query']; ?></h4>
        </div>
      </div>

      <div class="row">
        <pre>
        <?php var_dump($books); ?>
        </pre>
      </div>
    <?php endif; ?>

  </div><!-- /.container -->

</body>
</html>

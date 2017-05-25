<?php
   /* note: in PHP > 5.3:
    *   $_GET['abc'] ?: 'def'
    *      is equivalent to 
    *   isset($_GET['abc'])? $_GET['abc'] : 'def'
    */
?>
<html>
<head>
  <title>Test XSS</title>
</head>
<body>
  <h1> Test Page For XSS </h1>
  <p>Please use the url in this format</p>
  <blockquote>
    http://<?="{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}"?>?q1=AA&amp;q2=BB&amp;q3=CC&amp;q4=DD&amp;q5=EE&amp;q6=FF&amp;q7=GG
  </blockquote>
  <hr/>

  <div>
    <h2>q1 in body</h2>
    <?= $_GET['q1']?:'' ?>
  </div>

  <div>
    <h2>q2 in tag</h2>
    <span><?= $_GET['q2']?:'' ?></span>
  </div>

  <div>
    <h2>q3 in attribute</h2>
    <span <?= $_GET['q3']?:'' ?> >test</span>
  </div>

  <div>
    <h2>q4 in single quote</h2>
    <img src='http://owaspth.securitylab.ninja/?<?= $_GET['q4']?:'' ?>' >
  </div>

  <div>
    <h2>q5 in double quote</h2>
    <img src="http://owaspth.securitylab.ninja/?<?= $_GET['q5']?:'' ?>" >
  </div>

  <div>
    <h2>q6 in script</h2>
    <script>
      <?=$_GET['q6']?>
    </script>
  </div>

  <div>
    <h2>q7 in script quote</h2>
    <script>
      a="test <?= $_GET['q7']?:'' ?>";
    </script>
  </div>

</body>
</html>

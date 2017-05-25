<?php
/* WARNING: This code is vulnerable. */
session_start();

# without fixation
session_unset();
session_regenerate_id(TRUE);

# with fixation
# session_destroy();

header('Location: index.php');

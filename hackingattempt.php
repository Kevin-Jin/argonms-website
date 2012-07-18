<?php
//if we set up a custom ErrorDocument 403, we should just show the contents of that.
header('HTTP/1.0 403 Forbidden');
die("You do not have permission to view this file.");
?>
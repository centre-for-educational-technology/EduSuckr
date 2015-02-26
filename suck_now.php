<?php
// Only runs in CLI mode. This offers protection and removed the execution time limit.
if (!(php_sapi_name() === 'cli')) {
    exit("Not a CLI mode.\n");
}

/* Require suckr */
require_once("includes/suckr.php");
$s = new Suckr;
$s->suckBlogs();

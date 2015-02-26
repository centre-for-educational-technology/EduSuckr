<?php
// Only runs in CLI mode. This offers protection and removed the execution time limit.
if (!(php_sapi_name() === 'cli')) {
    exit("Not a CLI mode.\n");
}

// Run the log clearing procedure
require_once(dirname(__FILE__). '/includes/statistics.php');
Statistics::removeOldLogEntries();

<?php
if (!function_exists('getSVNRev')) {
    function getSVNRev() {
        // SVN property required to be set, e.g. $Rev: 6653 $
        $svnrev = '$Rev: 6653 $';
        $svnrev = substr($svnrev, 6);
        return intval(substr($svnrev, 0, strlen($svnrev) - 2));
    }
}

$modx_version = '1.0.3';           // Current version number
$modx_release_date = '1 Apr 2010'; // Date of release
$modx_branch = 'Evolution';        // Codebase name
$code_name = 'rev '.getSVNRev();   // SVN version number (used mult places)
$modx_full_appname = 'MODx '.$modx_branch.' '.$modx_version.' (Rev: '.getSVNRev().' Date: '.$modx_release_date;
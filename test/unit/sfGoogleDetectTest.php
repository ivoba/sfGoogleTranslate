<?php

include(dirname(__FILE__).'/../bootstrap/unit.php');

$t = new lime_test(2, new lime_output_color());
require $gt_lib_dir.'/sfGoogleTranslate.class.php';

$GT = new sfGoogleTranslate();
$t->is( $GT->detect('Stuhl'), 'de', 'language detection successful.' );

$r = $GT->getRawResult();
$t->is(is_object($r),true);

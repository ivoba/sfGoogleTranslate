<?php

include(dirname(__FILE__).'/../bootstrap/unit.php');

$t = new lime_test(4, new lime_output_color());
require $gt_lib_dir.'/sfGoogleTranslate.class.php';

$gtDE2EN = new sfGoogleTranslate();
$t->is( $gtDE2EN->translate('Stuhl'), 'Chair', 'DE2EN translation successful.' );
$gtEN2DE = new sfGoogleTranslate('en','de');
$t->is( $gtEN2DE->translate('chair'), 'Stuhl', 'EN2DE translation successful.' );
$gtOptions = new sfGoogleTranslate('en','de');
$t->is( $gtOptions->translate('<strong>chair</strong>',array('format' => 'html')), '<strong>Stuhl</strong>', 'EN2DE translation with options successful.' );
$r = $gtOptions->getRawResult();
$t->is(is_object($r),true);
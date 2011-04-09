<?php

include(dirname(__FILE__).'/../bootstrap/unit.php');

$t = new lime_test(5, new lime_output_color());
require $gt_lib_dir.'/sfGoogleTranslate.class.php';

$longtext_de = 'Überall dieselbe alte Leier. Das Layout ist fertig, der Text lässt auf sich warten. Damit das Layout nun nicht nackt im Raume steht und sich klein und leer vorkommt, springe ich ein: der Blindtext. Genau zu diesem Zwecke erschaffen, immer im Schatten meines großen Bruders »Lorem Ipsum«, freue ich mich jedes Mal, wenn Sie ein paar Zeilen lesen. Denn esse est percipi - Sein ist wahrgenommen werden. Und weil Sie nun schon die Güte haben, mich ein paar weitere Sätze lang zu begleiten, möchte ich diese Gelegenheit nutzen, Ihnen nicht nur als Lückenfüller zu dienen, sondern auf etwas hinzuweisen, das es ebenso verdient wahrgenommen zu werden: Webstandards nämlich. Sehen Sie, Webstandards sind das Regelwerk, auf dem Webseiten aufbauen. So gibt es Regeln für HTML, CSS, JavaScript oder auch XML; Worte, die Sie vielleicht schon einmal von Ihrem Entwickler gehört haben. Diese Standards sorgen dafür, dass alle Beteiligten aus einer Webseite den größten Nutzen ziehen. Im Gegensatz zu früheren Webseiten müssen wir zum Beispiel nicht mehr zwei verschiedene Webseiten für den Internet Explorer und einen anderen Browser programmieren.';
//this is the translation from translate.google.de
$longtext_en = 'Everywhere the same old story. The layout is finished, the text is a ways off. Thus, the layout is not now stands naked in space and is small and appears empty, I have a jump: the dummy text. Exactly for this purpose created, always in the shadow of my big brother "Lorem Ipsum" I am delighted every time you read a few lines. For esse est percipi - is being perceived. And now because you already have the goodness to accompany me a few more sentences long, I would like to take this opportunity to serve you not only as a stopgap, but something to note that it is perceived to be well deserved: namely Web standards. You see, Web standards are the rules, build Web pages. Thus there are rules for HTML, CSS, JavaScript or XML, words that you may have heard of your developers. These standards ensure that all stakeholders benefit from a Web page is most beneficial. Unlike older sites we have to program for example no longer two different websites for Internet Explorer and other browsers.';

$gtDE2EN = new sfGoogleTranslate();
$t->is( $gtDE2EN->translate('Stuhl'), 'Chair', 'DE2EN translation successful.' );
$t->is( html_entity_decode($gtDE2EN->translate($longtext_de)), $longtext_en, 'DE2EN longtext translation successful.' );

$gtEN2DE = new sfGoogleTranslate('en','de');
$t->is( $gtEN2DE->translate('chair'), 'Stuhl', 'EN2DE translation successful.' );
$gtOptions = new sfGoogleTranslate('en','de');
$t->is( $gtOptions->translate('<strong>chair</strong>',array('format' => 'html')), '<strong>Stuhl</strong>', 'EN2DE translation with options successful.' );
$r = $gtOptions->getRawResult();
$t->is(is_object($r),true,'Raw Result successful');


<?php
namespace Phoog\Deboog;

// var export true
function vet($var){
	return var_export($var,true);
}
// var info pre
function vip($var){
	return "<pre>".vet($var,true)."</pre>";
}
// echo var info pre
function evi($var){
	echo vip($var);
}
// evi and die
function evid($var){
	evi($var);
	die();
}

// string in pre
function sip($string){
	$style = "display: block; padding: 9.5px; margin: 0 0 10px; font-size: 13px; line-height: 20px; word-break: break-all; word-wrap: break-word; white-space: pre-wrap; background-color: #f5f5f5; border: 1px solid #ccc; border: 1px solid rgba(0, 0, 0, 0.15); -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; page-break-after: always;";
	return "<pre style='$style'>$string</pre>";
}
// echo string in pre
function esp($string){
	echo sip($string);
}
// esp and die
function espd($string){
	esp($string);
	die();
}
// var info td
function vit($var){
	return "<td>".vet($var,true)."</td>";
}
// echo var info td
function evt($var){
	echo vit($var);
}
// echo var CLI
function evc($var){
	echo vet($var).PHP_EOL;
}
// evc and die
function evcd($var){
	evc($var);
	die();
}



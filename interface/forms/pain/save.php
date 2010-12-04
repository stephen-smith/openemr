<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");

require ("C_FormPain.class.php");
$c = new C_FormPain();
echo $c->default_action_process($_POST);
@formJump();
?>

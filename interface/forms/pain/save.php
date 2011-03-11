<?php
/* include globals.php, required. */
require_once('../../globals.php');

/* include api.inc. also required. */
require_once($GLOBALS['srcdir'].'/api.inc');

/* include our smarty derived controller class. */
require('C_FormPain.class.php');

/* Create a form object. */
$c = new C_FormPain();

/* Save the form contents .*/
echo $c->default_action_process($_POST);

/* return to the encounter. */
@formJump();
?>

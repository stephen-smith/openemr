<?php
/* include globals.php, required. */
require_once(dirname(__FILE__).'/../../globals.php');

/* include api.inc. also required. */
require_once($GLOBALS['srcdir'].'/api.inc');

/* include our smarty derived controller class. */
require('C_FormPain.class.php');

/* Create a form object. */
$c = new C_FormPain();

/* Render a 'view/edit form' page. */
echo $c->view_action($_GET['id']);
?>

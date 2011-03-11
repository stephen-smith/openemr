<?php
/* include globals.php, required. */
require_once('../../globals.php');

/* include api.inc, required. */
require_once($GLOBALS['srcdir'].'/api.inc');

/* include our smarty derived controller class. */
require('C_FormPain.class.php');

/**
 * @breif report function, to display a form in the 'view enounter' page, and in the medical records reports.
 */
function pain_report( $pid, $encounter, $cols, $id) {
    /* Create a form object. */
    $c = new C_FormPain();
    /* Render the form. */
    echo $c->report_action($id);
}
?>

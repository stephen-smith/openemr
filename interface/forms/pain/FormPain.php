<?php
/**
 * @file FormPain.php
 *
 * @breif This file ontains the FormPain class, used to model the data contents of a clickmap based form.
 */
/* include the class we are extending. */
require_once ($GLOBALS['fileroot'] . "/interface/clickmap/AbstractClickmapModel.php");

/**
 * @class FormPain
 *
 * @breif This class extends the AbstractClickmapModel class, to create a class for modelling the data in a pain form.
 */
class FormPain extends AbstractClickmapModel {

    /**
     * The database table to place form data in/read form data from.
     *
     * @var TABLE_NAME
     */
    static $TABLE_NAME = "form_pain";

    /* Initializer. just alles parent's initializer. */
    function FormPain($id="") {
    	parent::AbstractClickmapModel(FormPain::$TABLE_NAME, $id);
    }

    /**
     * @breif Return the Title of the form, Useful when calling addform().
     */
    public function getTitle() {
        return C_FormPain::$FORM_TITLE;
    }

    /**
     * @breif Return the 'Code' of the form. Again, used when calling addform().
     */
    public function getCode() {
        return C_FormPain::$FORM_CODE;
    }
}
?>

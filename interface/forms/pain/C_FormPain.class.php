<?php
/**
 * @file C_FormPain.class.php
 *
 * @breif This file contains the C_FormPain class, used to control a clickmap bassed form.
 */

/* Include the class we're extending. */
require_once ($GLOBALS['fileroot'] . "/interface/clickmap/C_AbstractClickmap.php");

/* included so that we can instantiate FormPain in createModel, to model the data contained in this form. */
require_once ("FormPain.php");

/**
 * @class C_FormPain
 *
 * @breif This class extends the C_AbstractClickmap class, to create a form useful for modelling patient pain complaints.
 */
class C_FormPain extends C_AbstractClickmap {
    /**
     * The title of the form, used when calling addform().
     *
     * @var FORM_TITLE
     */
    static $FORM_TITLE = "Pain Form";
    /**
     * The 'code' of the form, also used when calling addform().
     *
     * @var FORM_CODE
     */
    static $FORM_CODE = "pain";

    /* initializer, just calls parent's initializer. */
    public function C_FormPain() {
    	parent::C_AbstractClickmap();
    }

    /**
     * @breif Called by C_AbstractClickmap's members to instantiate a Model object on demand.
     *
     * @param form_id
     *  optional id of a form in the EMR, to populate data from.
     */
    public function createModel($form_id = "") {
        if ( $form_id != "" ) {
            return new FormPain($form_id);
        } else {
            return new FormPain();
        }
    }

    /**
     * @breif return the path to the backing image relative to the webroot.
     */
    function getImage() {
        return $GLOBALS['webroot'] . "/interface/forms/" . C_FormPain::$FORM_CODE ."/templates/painpage.png";
    }

    /**
     * @breif return a n arra containing the options for the dropdown box.
     */
    function getOptionList() {
        return array(  "0"=> "None", "1" => "Low", "2"=> "Medium", "3" => "High", "4" => "Excurciating" );
    }

    /**
     * @breif return a label for the dropdown boxes on the form, as a string.
     */
    function getOptionsLabel() {
        return "Pain Scale";
    }
}
?>

<?php
require_once ($GLOBALS['fileroot'] . "/interface/clickmap/C_AbstractClickmap.php");
require_once ("FormPain.php");
class C_FormPain extends C_AbstractClickmap {

    static $FORM_TITLE = "Pain Form";
    static $FORM_CODE = "pain";

    public function C_FormPain() {
    	parent::C_AbstractClickmap();
    }

    public function createModel($form_id = "") {
        if ( $form_id != "" ) {
            return new FormPain($form_id);
        } else {
            return new FormPain();
        }
    }

    function getImage() {
        return $GLOBALS['webroot'] . "/interface/forms/" . C_FormPain::$FORM_CODE ."/templates/painpage.png";
    }

    function getOptionList() {
        return array(  "0"=> "None", "1" => "Low", "2"=> "Medium", "3" => "High", "4" => "Excurciating" );
    }

    function getOptionsLabel() {
        return "Pain Scale";
    }

}

?>

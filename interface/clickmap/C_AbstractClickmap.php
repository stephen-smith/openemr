<?php

/**
 * @file C_AbstractClickmap.php
 *
 * @breif This file contains the C_AbstractClickmap class.
 *
 */

/* for $GLOBALS['concurrent_layout','encounter','fileroot','pid','srcdir','style','webroot'] */
require_once('../globals.php');

/*  For Controller, the class we're extending. */
require_once ($GLOBALS['srcdir'] . '/classes/Controller.class.php');

/* FIXME: For the forms API */
require_once ($GLOBALS['srcdir'] . '/forms.inc');

/**
 * @class C_AbstractClickmap
 *
 * @breif This class extends the Controller class, which is used to control the smarty templating engine.
 *
 */
abstract class C_AbstractClickmap extends Controller {

    
    var $template_dir;

    /* initialization */
    function C_AbstractClickmap($template_mod = "general") {
    	parent::Controller();
    	$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';
    	$this->template_mod = $template_mod;
    	$this->template_dir = $GLOBALS['fileroot'] . "/interface/clickmap/template/";
    	$this->assign("FORM_ACTION", $GLOBALS['webroot']);
    	$this->assign("DONT_SAVE_LINK",$GLOBALS['webroot'] . "/interface/patient_file/encounter/$returnurl");
    	$this->assign("STYLE", $GLOBALS['style']);
    }

    /**
     * @breif Override this abstract function with your implementation of createModel
     * 
     * @param $form_id 
     *  An optional id of a form, to populate data from.
     *
     * @return Model
     *  An AbstractClickmapModel derived Object.
     */
    abstract public function createModel($form_id="");

    /**
     * @breif Override this abstract function with your implememtation of getImage
     * 
     * @return The path to the image backing this form relative to your form's 
     *
     */
    abstract function getImage();

    /**
     * @breif Override this tabstract function o return the label of the optionlists on this form.
     */
    abstract function getOptionsLabel();

    /**
     * Override this to return a hash of the optionlist (key=>value pairs).
     * @return array
     */
    abstract function getOptionList();

    private function set_context( $model ) {
        $root = $GLOBALS['webroot'] . "/interface/clickmap";
        $model->saveAction = $GLOBALS['webroot'] . "/interface/forms/" . $model->getCode() . "/save.php";
        $model->template_dir = $root . "/template";
        $model->image = $this->getImage();
        $optionList = $this->getOptionList();
        $model->optionList = $optionList != null ? json_encode($optionList) : "null";
        $optionsLabel = $this->getOptionsLabel();
        $model->optionsLabel = isset($optionsLabel) ? "'" . $optionsLabel . "'" : "null";

        $data = $model->get_data();
        $model->data = $data != "" ? "'" . $data . "'" : "null";
        $model->hideNav = "false";
    }

    function default_action() {
        $model = $this->createModel();
    	$this->assign("form", $model);
        $this->set_context($model);
        return $this->fetch($this->template_dir . $this->template_mod . "_new.html");
    }

    function view_action($form_id) {
        $model = $this->createModel($form_id);
    	$this->assign("form",$model);
        $this->set_context($model);
    	return $this->fetch($this->template_dir . $this->template_mod . "_new.html");
    }

    function report_action($form_id) {
        $model = $this->createModel($form_id);
    	$this->assign("form",$model);
        $this->set_context($model);
        $model->hideNav = "true";
    	return $this->fetch($this->template_dir . $this->template_mod . "_new.html");
    }

    function default_action_process() {
        if ($_POST['process'] != "true") {
            return;
        }
        $this->model = $this->createModel($_POST['id']);
        parent::populate_object($this->model);
        $this->model->persist();
        if ($GLOBALS['encounter'] == "") {
            $GLOBALS['encounter'] = date("Ymd");
        }
        if(empty($_POST['id'])) {
            addForm($GLOBALS['encounter'], 
                    $this->model->getTitle(),
                    $this->model->id,
                    $this->model->getCode(),
                    $GLOBALS['pid'],
                    $_SESSION['userauthorized']
            );
            $_POST['process'] = "";
        }
    }
}
?>

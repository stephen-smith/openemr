<?php

/* For the class we're extending. */
require_once ($GLOBALS['srcdir'] . '/classes/Controller.class.php');
/* FIXME: For ??? */
require_once ($GLOBALS['srcdir'] . '/forms.inc');

abstract class C_AbstractClickmap extends Controller {

    var $template_dir;

    /* initialization */
    function C_AbstractClickmap($template_mod = "general") {
    	parent::Controller();
    	$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';
    	$this->template_mod = $template_mod;
    	$this->template_dir = $GLOBALS['fileroot'] . "/interface/clickmap/template/";
    	$this->assign("FORM_ACTION", $GLOBALS['web_root']);
    	$this->assign("DONT_SAVE_LINK",$GLOBALS['webroot'] . "/interface/patient_file/encounter/$returnurl");
    	$this->assign("STYLE", $GLOBALS['style']);
    }

    /**
     * Override this with your implementation of AbstractClickmapModel
     * @return AbstractClickmapModel;
     */
    abstract public function createModel($form_id="");

    /**
     * Override this to return the path to your image relative to your form's the template
     */
    abstract function getImage();

    /**
     * Override this to return the label of your optionlist
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

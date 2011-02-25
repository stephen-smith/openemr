<?php

/**
 *  @breif The class we're extending.
 */
require_once ($GLOBALS['srcdir'] . '/classes/ORDataObject.class.php');

/* FIXME: all of these set functions have a filter on them, and throw errors if the filter is not honoured. verify the necissity of these filters. */

/**
 * @class AbstractClickmapModel
 *
 * @breif A form object, with a click-and-select_from_dropdown UI.
 *
 * This class inherits from OrDataObject.
 *
 */
abstract class AbstractClickmapModel extends ORDataObject {

    /* variables visible as members of this object. */
    var $id;
    var $date;
    var $pid;
    var $user;
    var $groupname;
    var $authorized;
    var $activity;
    var $data;

    /**
    /* initialization */
    public function AbstractClickmapModel($table, $id="") {
        /* Only accept numeric IDs as arguments. */
        if (is_numeric($id)) {
            $this->id = $id;
        } else {
            $id = "";
        }

        $this->date = date("Y-m-d H:i:s");
        $this->_table = $table;
        $this->data = "";
        $this->pid = $GLOBALS['pid'];
        if ($id != "") {
            $this->populate();
        }
    }

    /* FIXME: label here */
    abstract function getTitle();

    /* FIXME: label here */
    abstract function getCode();

    /* FIXME: label here */
    function populate() {
        /* inherit from our parent */
        parent::populate();
    }

    /* FIXME: label here */
    function persist() {
        /* inherit from our parent */
        parent::persist();
    }

    /* The rest of this object consists of set_ and get_ pairs, for setting and getting the value of variables that are members of this object. */

    function get_id() {
        return $this->id;
    }

    function set_id($id) {
        if (!empty($id) && is_numeric($id)) {
            $this->id = $id;
        }
	else
	{
	    trigger_error('API violation: set function called with empty or non numeric string.', E_USER_WARNING);
	}
    }

    function get_pid() {
        return $this->pid;
    }

    function set_pid($pid) {
        if (!empty($pid) && is_numeric($pid)) {
            $this->pid = $pid;
        }
	else
	{
	    trigger_error('API violation: set function called with empty or non numeric string.', E_USER_WARNING);
	}
    }

    function get_activity() {
        return $this->activity;
    }

    function set_activity($tf) {
        if (!empty($tf) && is_numeric($tf)) {
            $this->activity = $tf;
        }
	else
	{
	    trigger_error('API violation: set function called with empty or non numeric string.', E_USER_WARNING);
	}
    }

    /* get_date()
     *
     */
    function get_date() {
        return $this->date;
    }

    /* set_date()
     *
     */
    function set_date($dt) {
        if (!empty($dt)) {
            $this->date = $dt;
        }
	else
	{
	    trigger_error('API violation: set function called with empty string.', E_USER_WARNING);
	}
    }

    function get_user() {
        return $this->user;
    }

    function set_user($u) {
        if (!empty($u)) {
            $this->user = $u;
        }
	else
	{
	    trigger_error('API violation: set function called with empty string.', E_USER_WARNING);
	}
    }

    function get_data() {
        return $this->data;
    }

    function set_data($data) {
        if (!empty($data)) {
            $this->data = $data;
        }
	else
	{
	    trigger_error('API violation: set function called with empty string.', E_USER_WARNING);
	}
    }

}

?>

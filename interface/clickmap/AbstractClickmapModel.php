<?php

/* For the class we're extending. */
require_once ($GLOBALS['srcdir'] . '/classes/ORDataObject.class.php');

abstract class AbstractClickmapModel extends ORDataObject {
    /**
     *
     * @access public
     */

    /**
     *
     * static
     */
    var $id;
    var $date;
    var $pid;
    var $user;
    var $groupname;
    var $authorized;
    var $activity;
    var $data;

    public function AbstractClickmapModel($table, $id="") {
        if (is_numeric($id)) {
            $this->id = $id;
        } else {
            $id = "";
        }

        $this->date = date("Y-m-d H:i:s");
        $this->date_of_onset = date("Y-m-d");
        $this->_table = $table;
        $this->data = "";
        $this->pid = $GLOBALS['pid'];
        if ($id != "") {
            $this->populate();
        }
    }

    abstract function getTitle();

    abstract function getCode();

    function populate() {
        parent::populate();
    }

    function persist() {
        parent::persist();
    }

    function set_id($id) {
        if (!empty($id) && is_numeric($id)) {
            $this->id = $id;
        }
    }

    function get_id() {
        return $this->id;
    }

    function set_pid($pid) {
        if (!empty($pid) && is_numeric($pid)) {
            $this->pid = $pid;
        }
    }

    function get_pid() {
        return $this->pid;
    }

    function set_activity($tf) {
        if (!empty($tf) && is_numeric($tf)) {
            $this->activity = $tf;
        }
    }

    function get_activity() {
        return $this->activity;
    }

    function get_date() {
        return $this->date;
    }

    function set_date($dt) {
        if (!empty($dt)) {
            $this->date = $dt;
        }
    }

    function get_user() {
        return $this->user;
    }

    function set_user($u) {
        if (!empty($u)) {
            $this->user = $u;
        }
    }

    function get_data() {
        return $this->data;
    }

    function set_data($data) {
        if (!empty($data)) {
            $this->data = $data;
        }
    }
}

?>

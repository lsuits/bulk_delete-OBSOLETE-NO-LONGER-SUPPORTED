<?php

// Written at Louisiana State University

class block_bulk_delete extends block_list {

    function init() {
        $this->title = get_string('pluginname', 'block_bulk_delete');
    }

    function applicable_formats() {
        return array('site' => true, 'my' => false, 'course' => false);
    }

    function get_content() {
        global $OUTPUT;

        $_s = function($key) { return get_string($key, 'block_bulk_delete'); };

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;

        $url = new moodle_url('blocks/bulk_delete/index.php');
        $link = html_writer::link($url, $_s('pluginname'));

        $icons = array($OUTPUT->pix_icon('t/delete', $_s('pluginname')));
        $items = array($link);

        $this->content->items = $items;
        $this->content->icons = $icons;
        $this->content->footer = '';

        return $this->content;
    }
}

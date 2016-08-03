<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * Version Details: First Version
 * Block displaying information about whether or not there is an etextbook
 * for the course
 *
 * @package    block_bulk_delete
 * @copyright  2016 Lousiana State University - Philip Cali, Adam Zapletal, David Elliott, Robert Russo
 * @author     Philip Cali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @version 1.0
 */

// Written at Louisiana State University

defined('MOODLE_INTERNAL') || die();

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

        $icons = array(
            $OUTPUT->pix_icon('t/delete', $_s('pluginname'),
                'moodle', array('class' => 'icon'))
            );
        $items = array($link);

        $this->content->items = $items;
        $this->content->icons = $icons;
        $this->content->footer = '';

        return $this->content;
    }
}

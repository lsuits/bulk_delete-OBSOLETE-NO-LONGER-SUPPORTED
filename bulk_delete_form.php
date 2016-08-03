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

require_once $CFG->libdir . '/formslib.php';

$_s = function($key) { return get_string($key, 'block_bulk_delete'); };

class bulk_delete_form extends moodleform {
    public function definition() {
        global $CFG, $_s;

        $settings = 'wrap="virtual" rows="20" cols="50"';

        $mform =& $this->_form;
        $mform->addElement('textarea', 'courses', $_s('courses'), $settings);
        $mform->setType('courses', PARAM_TEXT);

        $buttons = array(
            $mform->createElement('submit', 'submit', $_s('delete_courses')),
            $mform->createElement('cancel', 'cancel', get_string('cancel'))
        );

        $mform->addGroup($buttons, 'actions', '&nbsp;', array(' '), false);

        $mform->addRule('courses', null, 'required', 'client');
    }
}

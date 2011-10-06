<?php

require_once $CFG->libdir . '/formslib.php';

$_s = function($key) { return get_string($key, 'block_bulk_delete'); };

class bulk_delete_form extends moodleform {
    public function definition() {
        global $CFG, $_s;

        $settings = 'wrap="virtual" rows="20" cols="50"';

        $mform =& $this->_form;
        $mform->addElement('textarea', 'courses', $_s('courses'), $settings);

        $buttons = array(
            $mform->createElement('submit', 'submit', $_s('delete_courses')),
            $mform->createElement('cancel', 'cancel', get_string('cancel'))
        );

        $mform->addGroup($buttons, 'actions', '&nbsp;', array(' '), false);

        $mform->addRule('courses', null, 'required', 'client');
    }
}

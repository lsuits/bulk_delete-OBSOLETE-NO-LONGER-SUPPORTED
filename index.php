<?php

// Written at Louisiana State University

require_once('../../config.php');
require_once('bulk_delete_form.php');

$_s = function($key, $a=NULL) { return get_string($key, 'block_bulk_delete', $a); };

require_login();

if (!is_siteadmin($USER->id)) {
    print_error('need_permission', 'block_bulk_delete');
}

// Page Setup
$blockname = $_s('pluginname');
$header = $_s('pluginname');

$context = context_system::instance();

$PAGE->set_context($context);

$PAGE->navbar->add($header);
$PAGE->set_title($blockname);
$PAGE->set_heading($SITE->shortname . ': ' . $blockname);
$PAGE->set_url('/blocks/bulk_delete/index.php');

echo $OUTPUT->header();
echo $OUTPUT->heading($header);

$form = new bulk_delete_form();

if ($form->is_cancelled()) {
    redirect(new moodle_url('/blocks/bulk_delete/'));
} else if ($data = $form->get_data()) {
    $i = 0;
    foreach (explode("\n", $data->courses) as $shortname) {
        $shortname = trim($shortname);

        $course = $DB->get_record('course', array('shortname' => $shortname));

        if ($course) {
            $i++;
            $infostart= '<center><strong>Deleting ' . $course->fullname . ' &mdash; # ' . $i . '</strong></center>';
            mtrace($infostart, $eol="\n", $sleep=0);
            $starttime = microtime(true);
            delete_course($course, false);
            $endtime = microtime(true);
            $timediff = $endtime - $starttime;
            $timediff = round($timediff);
            $infocomplete = '<center><strong>' . $course->fullname . ' Deleted &mdash; # ' . $i . ' &mdash; Deletion took ' . $timediff . ' seconds.</strong></center><br />';
            mtrace($infocomplete, $eol="\n", $sleep=0);
        }
    }

    echo $OUTPUT->notification($_s('success'), 'notifysuccess');
    echo $OUTPUT->footer();
    die();
}

$form->display();

echo $OUTPUT->footer();

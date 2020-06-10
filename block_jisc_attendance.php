<?php
class block_jisc_attendance extends block_base {
    public function init() {
        $this->title = get_string('blocktitle', 'block_jisc_attendance');
    }

    public function applicable_formats() {
        return array('all' => false, 'course-view' => true, 'site-index' => true);
    }

    public function instance_allow_multiple() {
        return false;
    }

    function has_config() {return true;}

    public function hide_header() {
        return false;
    }

    public function get_content() {
        global $COURSE, $PAGE;
        $pageurl = $PAGE->url;
        if (strpos($pageurl, 'course/view') == 0) {
            return false;
        }

        $context = context_course::instance($COURSE->id);
        if (!has_capability('block/jisc_attendance:openjiscattendance', $context)) {
            return false;
        }

        if ($this->content !== null) {
        return $this->content;
        }

        global $COURSE, $DB, $PAGE;

        $this->content =  new stdClass;
        $this->content->text = '';

        $this->content->header = get_string('blocktitle', 'block_jisc_attendance');

        $this->content->text = '<div class="jatt" style="margin:auto; text-align:center;">';
        $this->content->text .= '<a href = "https://datax.jisc.ac.uk/#/tutor/modules/me">';
        $this->content->text .= '<button class = "btn btn-success">';
        $this->content->text .= 'JISC DataX<br>Attendance Logging';
        $this->content->text .= '</button>';
        $this->content->text .= '</a>';
        $this->content->text .= '<p><small class="text-muted">Note: Linking to your individual module list will be enabled once JISC provide this service.</small></p>';

        $this->content->text .= '</div>';

        $this->content->footer = '';
        return $this->content;
    }

}
?>
<?php

class MY_Parser extends CI_Parser {

    const LANG_REPLACE_REGEXP = '!\{_\s*(?<key>[^\}]+)\}!';
    public $CI = null;

    public function parse($template, $data, $return = FALSE) {
        $this->CI = get_instance();
        $template = $this->CI->load->view($template, $data, TRUE);
        $template = $this->replace_lang_keys($template);

        return $this->_parse($template, $data, $return);
    }

    protected function replace_lang_keys($template) {
        return preg_replace_callback(self::LANG_REPLACE_REGEXP, array($this, 'replace_lang_key'), $template);
    }

    protected function replace_lang_key($key) {
        return $this->CI->lang->line($key[1]);
    }
}
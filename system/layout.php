<?php
namespace System;

class Layout {
    private $view;
    private $viewpath;
    
    function __construct($view) {
        if (file_exists($view.'.html')) {
            $this->view = $view;
            $this->viewpath = $view.'.html';
            return true;
        }
        else {
            return false;
        }
    }
    
    function render($data, $output = true) {
        $data['baseurl'] = BASEURL;
        $html = file_get_contents($this->viewpath);
        foreach($data as $k=>$v) {
            $html = str_replace('{'.$k.'}', $v, $html);
        }
        if ($output == true) {
            echo $html;
        }
        else {
            return $html;
        }
    }
    
    function renderPart($view, $data) {
        if (file_exists($view.'.html')) {
            $data['baseurl'] = BASEURL;
            $html = file_get_contents($view.'.html');
            foreach($data as $k=>$v) {
                $html = str_replace('{'.$k.'}', $v, $html);
            }
            return $html;
        }
        else {
            return false;
        }
    }
}
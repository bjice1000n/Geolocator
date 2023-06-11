<?php

    function config($name) {
        $env = parse_ini_file('.env');
        return $env[strtoupper($name)];
    }
    function dd($v) {
        echo '<pre>';
        print_r($v);
        echo '</pre>';
        die;
    }
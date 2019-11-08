<?php

function make_safe_post($variable) {
    $ci = & get_instance();
    if (is_array($ci->input->post($variable))) {
        $variable = $ci->input->post($variable);
        foreach ($variable as $key => $value) {
            if (is_array($value)) {
                //print_r($value);
                foreach ($value as $key1 => $value1) {
                    //echo $key1;
                    $variable1[$key][$key1] = strip_tags((trim($ci->security->xss_clean($value1))));
                }
            } else {
                $variable1[$key] = strip_tags((trim($ci->security->xss_clean($value))));
            }
        }
        $variable = $variable1;
    } else
        $variable = strip_tags((trim($ci->security->xss_clean($ci->input->post($variable)))));

    return $variable;
}

?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This is helper class for sending email.
 *
 * @package 		Email Helper
 * @copyright		Copyright (c) 2016
 * @subpackage      Config
 * @category		Helper
 * 
 */
/* Function for user class starts from here */

function sendResetPasswordEmail($param = array()) {
    $ci = &get_instance();
    $ci->load->library('email', array('mailtype' => 'html'));
    $ci->email->set_newline("\r\n");
    $ci->email->from(FROM_EMAIL, DISPLAY_HEADER_ADMIN_NAME);
    $ci->email->to($param['email']);
    $ci->email->subject("Reset Password");
    $message = "Dear " . $param['userName'] . "<br/><br/>";
    $message .= "<p>Thank you for contacting us. Click the URL link below to reset your password. This link is valid for one time use only and it will expire in 24 hours.</p>";
    $message .= "<br/><br/>";
    $message .= "URL Link:  <a href='" . base_url() . "Auth/resetpassword/" . $param['resetPasswordToken'] . "'>" . base_url() . "Auth/resetpassword/" . $param['resetPasswordToken'] . "</a> <br/><br/></p>";
    $message .= "Thank You<br/>";
    $message .= "Support<br/>";
    $message .= "Coupon App<br/>";

    $ci->email->message($message);
    if (!$ci->email->send()) {
        echo $ci->email->print_debugger();
    }
}

function sendCustomerResetPasswordEmail($param = array()) {
    $ci = &get_instance();
    $ci->load->library('email', array('mailtype' => 'html'));
    $ci->email->from(FROM_EMAIL, DISPLAY_HEADER_ADMIN_NAME);
    $ci->email->to($param['email']);
    $ci->email->subject("Reset Password");
    $message = "Dear " . $param['userName'] . "<br/><br/>";
    $message .= "<p>Thank you for contacting us. Click the URL link below to reset your password. This link is valid for one time use only and it will expire in 24 hours.</p>";
    $message .= "<br/><br/>";
    $message .= "URL Link:  <a href='" . base_url() . "Auth/resetCustomerpassword/" . $param['resetPasswordToken'] . "'>" . base_url() . "Auth/resetCustomerpassword/" . $param['resetPasswordToken'] . "</a> <br/><br/></p>";
    $message .= "Thank You<br/>";
    $message .= "Support<br/>";
    $message .= "Coupon App<br/>";

    $ci->email->message($message);
    if (!$ci->email->send()) {
        echo $ci->email->print_debugger();
    }
}

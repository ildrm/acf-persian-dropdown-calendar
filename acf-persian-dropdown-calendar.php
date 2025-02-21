<?php
/*
Plugin Name: Persian Dropdown Calendar for Advanced Custom Fields
Plugin URI: https://github.com/ildrm/acf-persian-dropdown-calendar
Description: Persian Dropdown Calendar field for using with Advanced Custom Fields.
Version: 1.0.0
Author: Shahin Ilderemi<ildrm@hotmail.com>
Author URI: https://ildrm.com
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if( !defined('ABSPATH') ) exit;

class ACF_Persian_Dropdown_Calendar {

    function __construct() {
        add_action('acf/include_field_types', array($this, 'include_field_types')); 
        add_action('admin_enqueue_scripts', array($this, 'input_admin_enqueue_scripts'));
    }

    function include_field_types( $version ) {
        include_once('fields/class-acf-field-persian-dropdown-calendar.php');
    }

    function input_admin_enqueue_scripts() {
        $plugin_url = plugin_dir_url(__FILE__);
        
        wp_enqueue_script('persian-date', $plugin_url . 'assets/js/persian-date.min.js', array('jquery'), '1.1.0', true);
        wp_enqueue_script('persian-datepicker', $plugin_url . 'assets/js/persian-datepicker.min.js', array('persian-date'), '1.2.0', true);
        wp_enqueue_style('persian-datepicker-css', $plugin_url . 'assets/css/persian-datepicker.min.css', array(), '1.2.0');
        wp_add_inline_script('persian-datepicker', '
            jQuery(document).ready(function($) {
                $(".persian-datepicker").each(function() {
                    var $input = $(this);
                    var savedConfig = {
                        format: $input.attr("data-format") || "YYYY/MM/DD",
                        calendarType: $input.attr("data-calendar-type") || "persian",
                        timePicker: {
                            enabled: $input.attr("data-time-picker") === "1" || false
                        },
                        autoClose: $input.attr("data-auto-close") === "1" || true,
                        onlyTimePicker: $input.attr("data-only-timepicker") === "1" || false,
                        calendar: {
                            persian: {
                                locale: "fa"
                            }
                        },
                        toolbox: {
                            calendarSwitch: {
                                enabled: $input.attr("data-gregorian-switch") === "1" || false
                            }
                        },
                        position: $input.attr("data-position") || "auto",
                        minDate: $input.attr("data-min-date") || null,
                        maxDate: $input.attr("data-max-date") || null,
                        onSelect: function() {
                            $input.trigger("change");
                        }
                    };
                    
                    $input.persianDatepicker(savedConfig);
                });
            });
        ');
    }
}

new ACF_Persian_Dropdown_Calendar();

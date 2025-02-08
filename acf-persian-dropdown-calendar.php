<?php
/*
Plugin Name: Advanced Custom Fields: Persian Dropdown Calendar
Plugin URI: #
Description: Persian Dropdown Calendar field for using with Advanced Custom Fields
Version: 1.0.0
Author: Shahin Ilderemi<ildrm@hotmail.com>
Author URI: https://ildrm.com
License: GPLv2 or later
*/

if (!defined('ABSPATH')) {
    exit;
}

function include_persian_calendar_field() {
    class ACF_Field_Type_Persian_Calendar extends acf_field {
        
        function __construct() {
            $this->name = 'persian_dropdown_calendar';
            $this->label = __('Persian Dropdown Calendar', 'acf');
            $this->category = 'basic';
            $this->defaults = array(
                'format' => 'YYYY/MM/DD',
                'calendar_type' => 'persian',
                'time_picker' => false,
                'auto_close' => true,
                'only_timepicker' => false,
                'gregorian_switch' => false,
                'locale' => 'fa',
                'position' => 'auto',
                'initialValue' => false,
                'min_date' => '',
                'max_date' => ''
            );

            parent::__construct();
        }

        /**
         * Render field settings
         * @param mixed $field
         */
        function render_field_settings($field) {
            acf_render_field_setting($field, array(
                'label'         => __('Date Format','acf'),
                'instructions'  => __('e.g. YYYY/MM/DD HH:mm:ss','acf'),
                'type'         => 'text',
                'name'         => 'format',
                'placeholder'  => 'YYYY/MM/DD'
            ));

            acf_render_field_setting($field, array(
                'label'         => __('Calendar Type','acf'),
                'type'         => 'select',
                'name'         => 'calendar_type',
                'choices'      => array(
                    'persian'    => __('Persian','acf'),
                    'gregorian'  => __('Gregorian','acf')
                )
            ));

            acf_render_field_setting($field, array(
                'label'         => __('Enable Time Picker','acf'),
                'type'         => 'true_false',
                'name'         => 'time_picker',
                'ui'           => 1
            ));

            acf_render_field_setting($field, array(
                'label'         => __('Only Time Picker','acf'),
                'type'         => 'true_false',
                'name'         => 'only_timepicker',
                'ui'           => 1
            ));

            acf_render_field_setting($field, array(
                'label'         => __('Auto Close','acf'),
                'type'         => 'true_false',
                'name'         => 'auto_close',
                'ui'           => 1
            ));

            acf_render_field_setting($field, array(
                'label'         => __('Show Gregorian Switch','acf'),
                'type'         => 'true_false',
                'name'         => 'gregorian_switch',
                'ui'           => 1
            ));

            acf_render_field_setting($field, array(
                'label'         => __('Calendar Position','acf'),
                'type'         => 'select',
                'name'         => 'position',
                'choices'      => array(
                    'auto'      => __('Auto','acf'),
                    'top'       => __('Top','acf'),
                    'right'     => __('Right','acf'),
                    'bottom'    => __('Bottom','acf'),
                    'left'      => __('Left','acf')
                )
            ));

            acf_render_field_setting($field, array(
                'label'         => __('Minimum Date','acf'),
                'instructions'  => __('Format: YYYY/MM/DD','acf'),
                'type'         => 'text',
                'name'         => 'min_date'
            ));

            acf_render_field_setting($field, array(
                'label'         => __('Maximum Date','acf'),
                'instructions'  => __('Format: YYYY/MM/DD','acf'),
                'type'         => 'text',
                'name'         => 'max_date'
            ));
        }

        /**
         * Render field
         * @param mixed $field
         */
        function render_field($field) {
            $field = array_merge($this->defaults, $field);
            
            printf('<input type="text" name="%s" value="%s" class="persian-datepicker" 
                data-format="%s"
                data-calendar-type="%s"
                data-time-picker="%s"
                data-auto-close="%s"
                data-only-timepicker="%s"
                data-gregorian-switch="%s"
                data-position="%s"
                data-min-date="%s"
                data-max-date="%s"
                />', 
                esc_attr($field['name']), 
                esc_attr($field['value']),
                esc_attr($field['format']),
                esc_attr($field['calendar_type']),
                esc_attr($field['time_picker']),
                esc_attr($field['auto_close']),
                esc_attr($field['only_timepicker']),
                esc_attr($field['gregorian_switch']),
                esc_attr($field['position']),
                esc_attr($field['min_date']),
                esc_attr($field['max_date'])
            );
        }
        
        /**
         * Input admin enqueue scripts
         */
        function input_admin_enqueue_scripts() {
            $plugin_url = plugin_dir_url(__FILE__);
            
            wp_enqueue_script('persian-date', 
                $plugin_url . 'assets/js/persian-date.min.js', 
                array('jquery'), 
                '1.1.0'
            );
            
            wp_enqueue_script('persian-datepicker', 
                $plugin_url . 'assets/js/persian-datepicker.min.js', 
                array('persian-date'), 
                '1.2.0'
            );
            
            wp_enqueue_style('persian-datepicker', 
                $plugin_url . 'assets/css/persian-datepicker.min.css', 
                array(), 
                '1.2.0'
            );
        
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
    
    return new ACF_Field_Type_Persian_Calendar();
}


add_action('acf/include_field_types', 'include_persian_calendar_field');

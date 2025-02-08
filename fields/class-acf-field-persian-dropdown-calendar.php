<?php
if (!defined('ABSPATH')) exit;

class ACF_Field_Persian_Dropdown_Calendar extends acf_field {
    
    function __construct() {
        $this->name = 'persian_dropdown_calendar';
        $this->label = __('Persian Dropdown Calendar', 'acf-persian-dropdown-calendar');
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
            'min_date' => '',
            'max_date' => ''
        );

        parent::__construct();
    }

    function render_field_settings($field) {
        acf_render_field_setting($field, array(
            'label' => __('Date Format', 'acf-persian-dropdown-calendar'),
            'instructions' => __('e.g. YYYY/MM/DD HH:mm:ss', 'acf-persian-dropdown-calendar'),
            'type' => 'text',
            'name' => 'format',
            'placeholder' => 'YYYY/MM/DD'
        ));
    
        acf_render_field_setting($field, array(
            'label' => __('Calendar Type', 'acf-persian-dropdown-calendar'),
            'type' => 'select',
            'name' => 'calendar_type',
            'choices' => array(
                'persian' => __('Persian', 'acf-persian-dropdown-calendar'),
                'gregorian' => __('Gregorian', 'acf-persian-dropdown-calendar')
            )
        ));
    
        acf_render_field_setting($field, array(
            'label' => __('Enable Time Picker', 'acf-persian-dropdown-calendar'),
            'type' => 'true_false',
            'name' => 'time_picker',
            'ui' => 1
        ));
    
        acf_render_field_setting($field, array(
            'label' => __('Auto Close Picker', 'acf-persian-dropdown-calendar'),
            'type' => 'true_false',
            'name' => 'auto_close',
            'ui' => 1
        ));
    
        acf_render_field_setting($field, array(
            'label' => __('Only Time Picker', 'acf-persian-dropdown-calendar'),
            'type' => 'true_false',
            'name' => 'only_timepicker',
            'ui' => 1
        ));
    
        acf_render_field_setting($field, array(
            'label' => __('Enable Gregorian Switch', 'acf-persian-dropdown-calendar'),
            'type' => 'true_false',
            'name' => 'gregorian_switch',
            'ui' => 1
        ));
    
        acf_render_field_setting($field, array(
            'label' => __('Date Picker Position', 'acf-persian-dropdown-calendar'),
            'type' => 'select',
            'name' => 'position',
            'choices' => array(
                'auto' => __('Auto', 'acf-persian-dropdown-calendar'),
                'top' => __('Top', 'acf-persian-dropdown-calendar'),
                'bottom' => __('Bottom', 'acf-persian-dropdown-calendar')
            )
        ));
    
        acf_render_field_setting($field, array(
            'label' => __('Minimum Date', 'acf-persian-dropdown-calendar'),
            'type' => 'text',
            'name' => 'min_date',
            'placeholder' => __('YYYY/MM/DD', 'acf-persian-dropdown-calendar')
        ));
    
        acf_render_field_setting($field, array(
            'label' => __('Maximum Date', 'acf-persian-dropdown-calendar'),
            'type' => 'text',
            'name' => 'max_date',
            'placeholder' => __('YYYY/MM/DD', 'acf-persian-dropdown-calendar')
        ));
    }    

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
}

new ACF_Field_Persian_Dropdown_Calendar();

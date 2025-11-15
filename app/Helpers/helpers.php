<?php

if (!function_exists('formatted_date')) {
    /**
     * Format old date value for form fields
     *
     * @param string|null $value The value from the database.
     * @param string $oldValue The old input value from the form.
     * @param string $format The desired date format (default: 'd-m-Y').
     * @return string|null
     */
    function formatted_date($value, $format = 'd-m-Y')
    {
        return $value ? date($format, strtotime($value)) : '';
    }
}

if (!function_exists('formatted_date_time')) {
    /**
     * Format old date value for form fields (includes time if needed)
     *
     * @param string|null $value The value from the database.
     * @param string $format The desired date and time format (default: 'd-m-Y H:i').
     * @return string|null
     */
    function formatted_date_time($value, $format = 'd-m-Y H:i')
    {
        return $value ? date($format, strtotime($value)) : '';
    }
}
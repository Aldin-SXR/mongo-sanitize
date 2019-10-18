<?php

/**
 * Flight: An extensible micro-framework.
 *
 * @copyright   Copyright (c) 2019, Aldin Kovačević <aldin.kovacevic.97@gmail.com>
 * @license     MIT
 */

/**
 * Sanitize MongoDB queries.
 * Remove any array keys starting with a dollar sign ($), to prevent possible MongoDB injection.
 * @param array $data Data to be filtered.
 * @return array Filtered data.
 */
function mongo_sanitize(&$data) {
    foreach ($data as $key => $item) {
        is_array($item) && !empty($item) && $data[$key] = mongo_sanitize($item);
        if (is_array($data) && preg_match('/^\$/', $key)) {
            unset($data[$key]);
        }
    }
    return $data;
}
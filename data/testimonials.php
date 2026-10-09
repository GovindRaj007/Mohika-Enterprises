<?php
/**
 * Real customer reviews only, copied word for word with the customer's
 * permission. Shape:
 *   ['quote' => '…', 'name' => 'First name + initial', 'city' => 'vijayawada',
 *    'service' => 'invisible-grills', 'rating' => 5]
 *
 * Empty until real reviews are supplied: the reviews section renders nothing
 * and no review or rating schema is emitted. Never write one.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [];

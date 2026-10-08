<?php

declare(strict_types=1);

/**
 * Exercise 3 - Create a reference number.
 */
function make_reference(int $id, string $dzongkhag, string $submitted): string
{
    $code = strtoupper(substr(trim($dzongkhag), 0, 3));

    $year = substr($submitted, 0, 4);

    $formattedId = sprintf('%04d', $id);

    // Four digits is the minimum width, not a maximum.
    // Therefore, ID 12345 stays as 12345.

    return $code . '-' . $year . '-' . $formattedId;
}


/**
 * Exercise 4 - Waiting-time band.
 */
function wait_band(int $days): string
{
    if ($days < 0) {
        return 'Check date';
    }

    if ($days <= 7) {
        return 'On time';
    }

    if ($days <= 14) {
        return 'Follow up';
    }

    return 'Overdue';
}


/**
 * Exercise 5 - Status workflow rules.
 */
function can_move(string $from, string $to): bool
{
    $rules = [
        'Submitted' => [
            'Under review'
        ],

        'Under review' => [
            'Approved',
            'Rejected'
        ],

        'Rejected' => [
            'Submitted'
        ],

        'Approved' => []
    ];

    $allowed = $rules[$from] ?? [];

    return in_array($to, $allowed, true);
}


/**
 * Exercise 5 Extension - Check role and status move.
 */
function can_move_as(string $role, string $from, string $to): bool
{
    if (!can_move($from, $to)) {
        return false;
    }

    if ($role === 'officer') {
        return $to === 'Under review';
    }

    if ($role === 'approver') {
        return $to === 'Approved' || $to === 'Rejected';
    }

    if ($role === 'requester') {
        return $to === 'Submitted';
    }

    return false;
}


/**
 * Exercise 7 - Check whether a CID is valid.
 *
 * A valid CID must:
 * 1. Have exactly 11 characters
 * 2. Contain only digits
 */
function is_valid_cid(string $cid): bool
{
    return strlen($cid) === 11 && ctype_digit($cid);
}
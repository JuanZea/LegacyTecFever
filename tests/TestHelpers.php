<?php

/**
 * Tests helpers
 */

function removeTimeKeys(array $userData) : array
{
    unset($userData['email_verified_at']);
    unset($userData['created_at']);
    unset($userData['updated_at']);
    return $userData;
}

function cloneArray(array $original) : array
{
	$clone = [];
    $clone = array_merge($clone, $original);
    return $clone;
}
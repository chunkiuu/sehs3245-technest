<?php
/*
 * File: includes/session.php
 * Author: Chow Chun Kiu
 * Starts the PHP session WITHOUT cookies. Include this at the very top of every page
 * (before any HTML output) instead of calling session_start() directly.
 *
 * The session ID is passed in the URL / forms instead of a cookie:
 * PHP adds ?PHPSESSID=... to every link and a hidden PHPSESSID field to every form.
 */

// Do not store the session ID in a cookie
ini_set('session.use_cookies', '0');
ini_set('session.use_only_cookies', '0');

// Let PHP add the session ID to links (<a href>) and forms automatically
ini_set('session.use_trans_sid', '1');
ini_set('session.trans_sid_tags', 'a=href,form=');

// Only accept session IDs created by this server
ini_set('session.use_strict_mode', '1');

session_start();
?>

<?php
/*
 * File:    includes/session.php
 * Author:  Chow Chun Kiu
 * Purpose: Starts the PHP session WITHOUT using cookies (the project does not allow cookies).
 * Usage:   include 'includes/session.php'; at the very top of every page,
 *          before any HTML is sent, instead of calling session_start() directly.
 *
 * How it works:
 * Normally PHP keeps the session ID in a cookie called PHPSESSID.
 * The settings below turn cookies off and let PHP pass the session ID in the page instead:
 *   - every link becomes   shop1.php?PHPSESSID=abc123...
 *   - every form gets      <input type="hidden" name="PHPSESSID" value="abc123..." />
 * So the server can still find the same shopping cart on every page.
 */

// 1. Do not use cookies at all, and allow the session ID to come from the URL or a form instead
ini_set('session.use_cookies', '0');
ini_set('session.use_only_cookies', '0');

// 2. Ask PHP to add the session ID automatically to every link (<a href>) and every form
ini_set('session.use_trans_sid', '1');
ini_set('session.trans_sid_tags', 'a=href,form=');

// 3. Security: only accept session IDs that this server created
//    (a made-up ID typed into the URL is replaced with a new one)
ini_set('session.use_strict_mode', '1');

// 4. Start (or continue) the session, so $_SESSION can be used on the page
session_start();
?>

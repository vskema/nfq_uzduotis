<?php

/**
 *
 * Returns the user's status
 *
 * @return bool
 */
function isLoggedIn(){

    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];

}

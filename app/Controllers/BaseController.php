<?php

namespace App\Controllers;

class BaseController
{
    protected function view($view, $data = [])
    {
        // Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Pass data to the view
        extract($data);
        require_once APP_ROOT . '/app/views/' . $view . '.php';
    }
}

<?php

function my_session_start()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function my_session_destory()
{
    if (session_status() != PHP_SESSION_NONE) {
        my_session_destory();
        session_destroy();
    }
}
<?php
function showAlert($key)
{
    if (!empty($_SESSION[$key])) {
        $message = $_SESSION[$key];
        echo <<<HTML
        <div class="container dvAlert">
            <button type="button" id="alertmess" class="alert text-light w-30" data-bs-dismiss="alert">
                <span>$message</span>
                <span class="btn btn-close btnClose"></span>
            </button>
        </div> 
        HTML;
    }
    unset($_SESSION[$key]);
}
?>
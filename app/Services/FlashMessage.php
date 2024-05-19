<?php

namespace App\Services;


class FlashMessage
{
    public static function success($message): void
    {
        session()->flash('type', 'success');
        session()->flash('message', $message);
    }

    public static function error($message): void
    {
        session()->flash('type', 'danger');
        session()->flash('message', $message);
    }
}

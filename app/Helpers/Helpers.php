<?php

use Illuminate\Support\Facades\Auth;

function statusRFK()
{
    if (Auth::user()->bidang->skpd->murni == 1) {
        $result = 'murni';
    }

    if (Auth::user()->bidang->skpd->pergeseran == 1) {
        $result = 'pergeseran';
    }

    if (Auth::user()->bidang->skpd->perubahan == 1) {
        $result = 'perubahan';
    }

    return $result;
}

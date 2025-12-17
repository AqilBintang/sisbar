<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule to run expire bookings every minute
Artisan::command('schedule:expire-bookings', function () {
    $this->call('bookings:expire');
})->purpose('Expire unpaid bookings automatically');

<?php

namespace App;

class App extends \Illuminate\Support\Facades\App
{
    /**
     * Cargoes statuses
     */
    const CARGO_STATUS_SHIPPED = 1; // Cargo has been shipped by the client
    const CARGO_STATUS_ARRIVED = 2; // Cargo arrived to the terminal
    const CARGO_STATUS_DEPARTURED = 3; // Cargo left the terminal

    const CARGO_STATUSES = [
        self::CARGO_STATUS_SHIPPED,
        self::CARGO_STATUS_ARRIVED,
        self::CARGO_STATUS_DEPARTURED
    ];
}

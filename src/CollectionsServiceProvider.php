<?php

namespace Konsulting\Laravel;

use Illuminate\Support\ServiceProvider;

class CollectionsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register arr macros, then collection macros
                
        require __DIR__ . '/arr_macros.php';
        require __DIR__ . '/collection_macros.php';
    }
}

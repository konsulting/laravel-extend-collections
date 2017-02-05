<?php

namespace Konsulting\Laravel;

use Illuminate\Support\ServiceProvider;

class CollectionsServiceProvider extends ServiceProvider
{
    public function register()
    {
        load_collection_extensions();
    }
}

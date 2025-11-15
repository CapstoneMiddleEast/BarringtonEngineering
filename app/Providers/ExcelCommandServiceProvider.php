<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Commands\ExportMakeCommand;

class ExcelCommandServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

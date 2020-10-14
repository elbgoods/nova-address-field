<?php

namespace Elbgoods\NovaAddressField;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Nova::serving(static function (ServingNova $event): void {
            Nova::script('nova-address-field', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-address-field', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
    }
}

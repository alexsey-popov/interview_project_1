<?php

namespace App\Providers;

use App\Models\EquipmentType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Проверка серийного номера на соответсвие регулярному выражению его типа
        Validator::extend('serial_number_mask', function ($attribute, $value, $parameters, $validator) {
            $regexp = EquipmentType::getRegexpById($parameters[0]);
            return Validator::make(
                [ 'serial_number' => $value ],
                [ 'serial_number' => 'regex:'.$regexp ],
            )->passes();
        });
    }
}

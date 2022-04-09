<?php

namespace SamPoyigi\Horizon;

use Admin\Facades\AdminAuth;
use Illuminate\Foundation\AliasLoader;
use Laravel\Horizon\Horizon;
use System\Classes\BaseExtension;

/**
 * Horizon Extension Information File
 */
class Extension extends BaseExtension
{
    /**
     * Register method, called when the extension is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/horizon.php', 'horizon'
        );

        $this->app->register(\Laravel\Horizon\HorizonServiceProvider::class);

        AliasLoader::getInstance()->alias('Horizon', \Laravel\Horizon\Horizon::class);

        Horizon::auth(function ($request) {
            if (!AdminAuth::check()) {
                return FALSE;
            }

            return AdminAuth::getUser()->hasPermission('SamPoyigi.Horizon.Access');
        });
    }

    /**
     * Registers scheduled tasks that are executed on a regular basis.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function registerSchedule($schedule)
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }

    /**
     * Registers any back-end permissions used by this extension.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'SamPoyigi.Horizon.Access' => [
                'group' => 'module',
                'description' => 'Access to the Horizon dashboard',
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this extension.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'tools' => [
                'child' => [
                    'horizon' => [
                        'title' => 'Horizon',
                        'class' => 'horizon',
                        'href' => admin_url('sampoyigi/horizon/dashboard'),
                        'priority' => 500,
                        'permissions' => ['SamPoyigi.Horizon.Access'],
                    ],
                ],
            ],
        ];
    }
}

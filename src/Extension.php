<?php

namespace SamPoyigi\Horizon;

use Igniter\Flame\Igniter;
use Igniter\System\Classes\BaseExtension;
use Igniter\User\Facades\AdminAuth;
use Laravel\Horizon\Horizon;

/**
 * Horizon Extension Information File
 */
class Extension extends BaseExtension
{
    public function register()
    {
        config()->set('horizon.path', Igniter::adminUri().'/'.config('horizon.path'));

        Horizon::auth(function ($request) {
            if (!AdminAuth::check()) {
                return false;
            }

            if (request()->bearerToken() && request()->bearerToken() === config('services.horizon.token')) {
                return true;
            }

            return AdminAuth::getUser()->hasPermission('SamPoyigi.Horizon.Access');
        });
    }

    public function registerSchedule($schedule)
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }

    public function registerPermissions()
    {
        return [
            'SamPoyigi.Horizon.Access' => [
                'group' => 'advanced',
                'description' => 'Access to the Horizon dashboard',
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'tools' => [
                'child' => [
                    'horizon' => [
                        'title' => 'Horizon',
                        'class' => 'horizon',
                        'href' => url(config('horizon.path')),
                        'priority' => 500,
                        'target' => '_blank',
                        'permissions' => ['SamPoyigi.Horizon.Access'],
                    ],
                ],
            ],
        ];
    }
}

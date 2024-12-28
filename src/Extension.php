<?php

namespace SamPoyigi\Horizon;

use Igniter\Flame\Support\Facades\Igniter;
use Igniter\System\Classes\BaseExtension;
use Igniter\User\Facades\AdminAuth;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Horizon\Horizon;

/**
 * Horizon Extension Information File
 */
class Extension extends BaseExtension
{
    protected static $authCallbacks = [];

    public static function defineAuth(\Closure $callback)
    {
        self::$authCallbacks[] = $callback;
    }

    public static function checkAuth($user)
    {
        foreach (self::$authCallbacks as $callback) {
            if (!is_null($result = $callback($user))) {
                return $result;
            }
        }

        return Igniter::isAdminUser($user)
            ? $user->hasPermission('SamPoyigi.Horizon.Access')
            : null;
    }

    public function register()
    {
        parent::register();

        Horizon::auth(function($request) {
            if (!AdminAuth::check()) {
                return false;
            }

            if (request()->bearerToken() && request()->bearerToken() === config('services.horizon.token')) {
                return true;
            }

            return AdminAuth::getUser()->hasPermission('SamPoyigi.Horizon.Access');
        });
    }

    public function registerSchedule(Schedule $schedule)
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }

    public function registerPermissions(): array
    {
        return [
            'SamPoyigi.Horizon.Access' => [
                'group' => 'igniter::system.permissions.name',
                'description' => 'Access to the Horizon dashboard',
            ],
        ];
    }

    public function registerNavigation(): array
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

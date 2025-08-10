Laravel Horizon for TastyIgniter
Adds [Laravel Horizon](https://horizon.laravel.com/) to your TastyIgniter application.

## Setup
> You should ensure that your queue connection is set to `redis` in your queue configuration file.

1. Install this extension
2. After installing this extension, run `php artisan horizon:install` to publish horizon assets
3. Run `php artisan horizon` to start the horizon process
5. From the TastyIgniter Admin, go to **Tools > Horizon** or navigate to `/horizon` to access the dashboard.
6. Comment out the `App\Providers\HorizonServiceProvider::class` class from your `config/app.php` file to configure Dashboard Authorization to use TastyIgniter user permissions.
7. To keep the horizon process running, you can use a process manager like [supervisord](http://supervisord.org/) or [systemd](https://www.freedesktop.org/wiki/Software/systemd/).

For production this command needs to be supervised by a tool like supervisord.
Supervisord will take care of restarting a process when it fails.

More information on running Horizon [check the laravel docs.](https://laravel.com/docs/master/horizon#running-horizon)

## Graphs
Horizon provides a queue usage graph, if you want use them you need to have the [TastyIgniter task scheduler](https://tastyigniter.com/docs/master/installation#setting-up-the-task-scheduler) correctly configured.

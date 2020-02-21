Laravel Horizon plugin for TastyIgniter
=
Adds [Laravel Horizon](https://horizon.laravel.com/) to your TastyIgniter application.

## Setup
> You should ensure that your queue connection is set to `redis` in your queue configuration file.

1. Install this extension
2. Publish the laravel horizon vendors `php artisan horizon:install`
3. Edit `config/horizon.php` config file - [see here](https://divinglaravel.com/horizon/before-the-dive)
4. Add `'env' => env('APP_ENV', 'production'),` to the config file `config/horizon` to run the workers defined in the config file
5. Run `php artisan horizon`
6. Go to **Tools > Horizon** or navigate to `/horizon` to access the dashboard.

For production this command needs to be supervised by a tool like supervisord.
Supervisord will take care of restarting a process when it fails.

More information on running Horizon [check the laravel docs.](https://laravel.com/docs/master/horizon#running-horizon)

## Graphs
Horizon provides a queue usage graph, if you want use them you need to have the [TastyIgniter task scheduler](https://tastyigniter.com/docs/master/installation#setting-up-the-task-scheduler) correctly configured.
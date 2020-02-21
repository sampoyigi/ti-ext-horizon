<?php namespace Igniter\Horizon\Controllers;

use Admin\Classes\AdminController;
use Admin\Facades\AdminMenu;
use Admin\Facades\Template;

/**
 * Horizon Admin Controller
 */
class Dashboard extends AdminController
{
    public $requiredPermissions = 'Igniter.Horizon.Access';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('horizon', 'tools');
    }

    public function index()
    {
        Template::setTitle('Horizon Dashboard');
        Template::setHeading('Horizon Dashboard');
    }
}
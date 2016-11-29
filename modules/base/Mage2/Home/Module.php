<?php

namespace Mage2\Home;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;

class Module extends BaseModule {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->registerAdminMenu();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->mapWebRoutes();
        $this->registerViewPath();
        $this->registerViewComposer();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    protected function mapWebRoutes() {
        require __DIR__ . '/routes/web.php';
    }

    protected function registerViewPath() {
        View::addLocation(__DIR__ . '/views');
    }

    public function registerAdminMenu() {
        $adminMenu = [ 'dashboard' => [
            'label' => 'Dashboard',
            'route' => 'admin.dashboard',
        ]];
        AdminMenu::registerMenu('mage2-home',$adminMenu);
    }

    protected function registerViewComposer() {
        View::composer(['layouts.admin-nav', 'layouts.admin-nav'],
                        'Mage2\Home\ViewComposers\AdminNavComposer');
        
        View::composer(['layouts.app'],
                        'Mage2\Home\ViewComposers\LayoutAppComposer');
    }

}

<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    public Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->initialize();
    }

    public function run()
    {
        try {
            $view = $this->router->dispatch();
            if ($view instanceof Renderable) {
                $view->render();
            } else {
                echo $view;
            }
        } catch (\Exception $e) {
            $this->renderException($e);
        }
    }

    public function renderException($e)
    {
        if ($e instanceof Renderable) {
            $e->render();
        } else {
            echo "Код ошибки - " . (($e->getCode() === 0) ? "500" : $e->getCode()) . ". " . $e->getMessage();
        }
    }

    public function initialize()
    {
        $config = Config::getInstance();
        $config->set('db', require APP_DIR . '/configs/db.php');
        $config->set('pagination', require APP_DIR . '/configs/pagination.php');
        $capsule = new Capsule;
        $capsule->addConnection($config->get('db'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}

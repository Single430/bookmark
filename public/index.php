<?php
use Phalcon\Loader;
use Phalcon\Tag;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Events\Manager as EventsManages;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    // Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(
        array(
            '../app/controllers/',
            '../app/models/',
            '../app/library/',
            '../app/plugins/',
        )
    )->register();

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    // 设置数据库服务
    $di->set('db', function () {
        $connection = new PdoMysql(array(
            "host"     => "127.0.0.1",
            "username" => "bm_user",
            "password" => "password",
            "dbname"   => "bookmarks",
            "charset"  => "utf8",   #解决中文乱码问题
        ));

        return $connection;
    });

    // 启动会话（Starting the Session)
    $di->setShared(
        "session",
        function () {
            $session = new Session();

            $session->start();

            return $session;
        }
    );

    // Setting up the view component
    $di['view'] = function() {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    };

    // Setup a base URI so that all generated URIs include the "store" folder
    $di['url'] = function() {
        $url = new Url();
        $url->setBaseUri('/bookmark/');
        return $url;
    };

    // Setup the tag helpers
    $di['tag'] = function() {
        return new Tag();
    };

    //MVC分发器
    $di->set(
        "dispatcher",
        function (){
            // 创建一个事件管理器
            $eventsManages = new EventsManages();

            // 监听分发器中使用安全插件产生的事件
            $eventsManages->attach(
                "dispatch:beforeExecuteRoute",
                new SecurityPlugin()
            );

            // 处理异常和使用 NotFoundPlugin 未找到异常
            $eventsManages->attach(
                "dispatch:beforeException",
                new NotFoundPlugin()
            );

            $dispatcher = new Dispatcher();

            // 分配事件管理器到分发器
            $dispatcher->setEventsManager($eventsManages);

            return $dispatcher;
        }
    );
    /**
     * Read services
     */
    include APP_PATH . "/config/services.php";

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

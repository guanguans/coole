<?php

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace {
    class App extends  \Coole\Foundation\Facades\App{}
    class Console extends \Coole\Console\Facades\Console{}
    class DB extends \Coole\Database\Facades\DB{}
    class ErrorHandler extends \Coole\ErrorHandler\Facades\ErrorHandler{}
    class EventDispatcher extends \Coole\EventDispatcher\Facades\EventDispatcher{}
    class Logger extends \Coole\Logger\Facades\Logger{}
    class Router extends \Coole\Routing\Facades\Router{}
    class View extends \Coole\View\Facades\View{}
}

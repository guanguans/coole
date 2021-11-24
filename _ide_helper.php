<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace {
    class App extends  \Coole\Foundation\Facade\App{}
    class DB extends \Coole\DB\Facade\DB{}
    class Log extends \Coole\Log\Facade\Log{}
    class Router extends \Coole\Routing\Facade\Router{}
    class View extends \Coole\View\Facade\View{}
}

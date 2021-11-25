

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '<ul><li data-name="namespace:Guanguans" class="opened"><div style="padding-left:0px" class="hd"><span class="icon icon-play"></span><a href="Guanguans.html">Guanguans</a></div><div class="bd"><ul><li data-name="namespace:Guanguans_Coole" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole.html">Coole</a></div><div class="bd"><ul><li data-name="namespace:Guanguans_Coole_Able" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Able.html">Able</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Able_AfterRegisterAbleProviderInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Able/AfterRegisterAbleProviderInterface.html">AfterRegisterAbleProviderInterface</a></div></li><li data-name="class:Guanguans_Coole_Able_BeforeRegisterAbleProviderInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Able/BeforeRegisterAbleProviderInterface.html">BeforeRegisterAbleProviderInterface</a></div></li><li data-name="class:Guanguans_Coole_Able_BootAbleProviderInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Able/BootAbleProviderInterface.html">BootAbleProviderInterface</a></div></li><li data-name="class:Guanguans_Coole_Able_EventListenerAbleProviderInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Able/EventListenerAbleProviderInterface.html">EventListenerAbleProviderInterface</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Console" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Console.html">Console</a></div><div class="bd"><ul><li data-name="namespace:Guanguans_Coole_Console_Commands" ><div style="padding-left:54px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Console/Commands.html">Commands</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Console_Commands_ServeCommand" ><div style="padding-left:80px" class="hd leaf"><a href="Guanguans/Coole/Console/Commands/ServeCommand.html">ServeCommand</a></div></li></ul></div></li><li data-name="class:Guanguans_Coole_Console_Application" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Console/Application.html">Application</a></div></li><li data-name="class:Guanguans_Coole_Console_Command" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Console/Command.html">Command</a></div></li><li data-name="class:Guanguans_Coole_Console_CommandDiscoverer" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Console/CommandDiscoverer.html">CommandDiscoverer</a></div></li><li data-name="class:Guanguans_Coole_Console_ConsoleServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Console/ConsoleServiceProvider.html">ConsoleServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Controller" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Controller.html">Controller</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Controller_Controller" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Controller/Controller.html">Controller</a></div></li><li data-name="class:Guanguans_Coole_Controller_ControllerInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Controller/ControllerInterface.html">ControllerInterface</a></div></li><li data-name="class:Guanguans_Coole_Controller_ControllerResolver" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Controller/ControllerResolver.html">ControllerResolver</a></div></li><li data-name="class:Guanguans_Coole_Controller_HasControllerAble" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Controller/HasControllerAble.html">HasControllerAble</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Database" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Database.html">Database</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Database_DatabaseServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Database/DatabaseServiceProvider.html">DatabaseServiceProvider</a></div></li><li data-name="class:Guanguans_Coole_Database_Model" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Database/Model.html">Model</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Event" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Event.html">Event</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Event_Event" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Event/Event.html">Event</a></div></li><li data-name="class:Guanguans_Coole_Event_EventServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Event/EventServiceProvider.html">EventServiceProvider</a></div></li><li data-name="class:Guanguans_Coole_Event_ListenerInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Event/ListenerInterface.html">ListenerInterface</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Exception" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Exception.html">Exception</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Exception_InvalidClassException" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Exception/InvalidClassException.html">InvalidClassException</a></div></li><li data-name="class:Guanguans_Coole_Exception_UnknownFileException" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Exception/UnknownFileException.html">UnknownFileException</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Facade" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Facade.html">Facade</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Facade_App" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Facade/App.html">App</a></div></li><li data-name="class:Guanguans_Coole_Facade_DB" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Facade/DB.html">DB</a></div></li><li data-name="class:Guanguans_Coole_Facade_Facade" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Facade/Facade.html">Facade</a></div></li><li data-name="class:Guanguans_Coole_Facade_Logger" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Facade/Logger.html">Logger</a></div></li><li data-name="class:Guanguans_Coole_Facade_Router" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Facade/Router.html">Router</a></div></li><li data-name="class:Guanguans_Coole_Facade_View" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Facade/View.html">View</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Listener" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Listener.html">Listener</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Listener_LogListener" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Listener/LogListener.html">LogListener</a></div></li><li data-name="class:Guanguans_Coole_Listener_NullResponseListener" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Listener/NullResponseListener.html">NullResponseListener</a></div></li><li data-name="class:Guanguans_Coole_Listener_StringResponseListener" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Listener/StringResponseListener.html">StringResponseListener</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Middleware" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Middleware.html">Middleware</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Middleware_CheckResponseForModifications" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Middleware/CheckResponseForModifications.html">CheckResponseForModifications</a></div></li><li data-name="class:Guanguans_Coole_Middleware_MiddlewareInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Middleware/MiddlewareInterface.html">MiddlewareInterface</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Provider" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Provider.html">Provider</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Provider_AppServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Provider/AppServiceProvider.html">AppServiceProvider</a></div></li><li data-name="class:Guanguans_Coole_Provider_ConfigServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Provider/ConfigServiceProvider.html">ConfigServiceProvider</a></div></li><li data-name="class:Guanguans_Coole_Provider_HttpKernelServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Provider/HttpKernelServiceProvider.html">HttpKernelServiceProvider</a></div></li><li data-name="class:Guanguans_Coole_Provider_InvokerServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Provider/InvokerServiceProvider.html">InvokerServiceProvider</a></div></li><li data-name="class:Guanguans_Coole_Provider_MonologServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Provider/MonologServiceProvider.html">MonologServiceProvider</a></div></li><li data-name="class:Guanguans_Coole_Provider_TwigServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Provider/TwigServiceProvider.html">TwigServiceProvider</a></div></li><li data-name="class:Guanguans_Coole_Provider_WhoopsServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Provider/WhoopsServiceProvider.html">WhoopsServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Guanguans_Coole_Routing" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Guanguans/Coole/Routing.html">Routing</a></div><div class="bd"><ul><li data-name="class:Guanguans_Coole_Routing_Route" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Routing/Route.html">Route</a></div></li><li data-name="class:Guanguans_Coole_Routing_RouteRegistrar" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Routing/RouteRegistrar.html">RouteRegistrar</a></div></li><li data-name="class:Guanguans_Coole_Routing_Router" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Routing/Router.html">Router</a></div></li><li data-name="class:Guanguans_Coole_Routing_RoutingServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Guanguans/Coole/Routing/RoutingServiceProvider.html">RoutingServiceProvider</a></div></li></ul></div></li><li data-name="class:Guanguans_Coole_App" ><div style="padding-left:44px" class="hd leaf"><a href="Guanguans/Coole/App.html">App</a></div></li></ul></div></li></ul></div></li></ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                        {"type":"Namespace","link":"Guanguans.html","name":"Guanguans","doc":"Namespace Guanguans"},{"type":"Namespace","link":"Guanguans/Coole.html","name":"Guanguans\\Coole","doc":"Namespace Guanguans\\Coole"},{"type":"Namespace","link":"Guanguans/Coole/Able.html","name":"Guanguans\\Coole\\Able","doc":"Namespace Guanguans\\Coole\\Able"},{"type":"Namespace","link":"Guanguans/Coole/Console.html","name":"Guanguans\\Coole\\Console","doc":"Namespace Guanguans\\Coole\\Console"},{"type":"Namespace","link":"Guanguans/Coole/Console/Commands.html","name":"Guanguans\\Coole\\Console\\Commands","doc":"Namespace Guanguans\\Coole\\Console\\Commands"},{"type":"Namespace","link":"Guanguans/Coole/Controller.html","name":"Guanguans\\Coole\\Controller","doc":"Namespace Guanguans\\Coole\\Controller"},{"type":"Namespace","link":"Guanguans/Coole/Database.html","name":"Guanguans\\Coole\\Database","doc":"Namespace Guanguans\\Coole\\Database"},{"type":"Namespace","link":"Guanguans/Coole/Event.html","name":"Guanguans\\Coole\\Event","doc":"Namespace Guanguans\\Coole\\Event"},{"type":"Namespace","link":"Guanguans/Coole/Exception.html","name":"Guanguans\\Coole\\Exception","doc":"Namespace Guanguans\\Coole\\Exception"},{"type":"Namespace","link":"Guanguans/Coole/Facade.html","name":"Guanguans\\Coole\\Facade","doc":"Namespace Guanguans\\Coole\\Facade"},{"type":"Namespace","link":"Guanguans/Coole/Listener.html","name":"Guanguans\\Coole\\Listener","doc":"Namespace Guanguans\\Coole\\Listener"},{"type":"Namespace","link":"Guanguans/Coole/Middleware.html","name":"Guanguans\\Coole\\Middleware","doc":"Namespace Guanguans\\Coole\\Middleware"},{"type":"Namespace","link":"Guanguans/Coole/Provider.html","name":"Guanguans\\Coole\\Provider","doc":"Namespace Guanguans\\Coole\\Provider"},{"type":"Namespace","link":"Guanguans/Coole/Routing.html","name":"Guanguans\\Coole\\Routing","doc":"Namespace Guanguans\\Coole\\Routing"},                                                 {"type":"Interface","fromName":"Guanguans\\Coole\\Able","fromLink":"Guanguans/Coole/Able.html","link":"Guanguans/Coole/Able/AfterRegisterAbleProviderInterface.html","name":"Guanguans\\Coole\\Able\\AfterRegisterAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Able\\AfterRegisterAbleProviderInterface","fromLink":"Guanguans/Coole/Able/AfterRegisterAbleProviderInterface.html","link":"Guanguans/Coole/Able/AfterRegisterAbleProviderInterface.html#method_afterRegister","name":"Guanguans\\Coole\\Able\\AfterRegisterAbleProviderInterface::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                 {"type":"Interface","fromName":"Guanguans\\Coole\\Able","fromLink":"Guanguans/Coole/Able.html","link":"Guanguans/Coole/Able/BeforeRegisterAbleProviderInterface.html","name":"Guanguans\\Coole\\Able\\BeforeRegisterAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Able\\BeforeRegisterAbleProviderInterface","fromLink":"Guanguans/Coole/Able/BeforeRegisterAbleProviderInterface.html","link":"Guanguans/Coole/Able/BeforeRegisterAbleProviderInterface.html#method_beforeRegister","name":"Guanguans\\Coole\\Able\\BeforeRegisterAbleProviderInterface::beforeRegister","doc":"<p>注册服务之前.</p>"},
            
                                                 {"type":"Interface","fromName":"Guanguans\\Coole\\Able","fromLink":"Guanguans/Coole/Able.html","link":"Guanguans/Coole/Able/BootAbleProviderInterface.html","name":"Guanguans\\Coole\\Able\\BootAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Able\\BootAbleProviderInterface","fromLink":"Guanguans/Coole/Able/BootAbleProviderInterface.html","link":"Guanguans/Coole/Able/BootAbleProviderInterface.html#method_boot","name":"Guanguans\\Coole\\Able\\BootAbleProviderInterface::boot","doc":"<p>引导应用程序.</p>"},
            
                                                 {"type":"Interface","fromName":"Guanguans\\Coole\\Able","fromLink":"Guanguans/Coole/Able.html","link":"Guanguans/Coole/Able/EventListenerAbleProviderInterface.html","name":"Guanguans\\Coole\\Able\\EventListenerAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Able\\EventListenerAbleProviderInterface","fromLink":"Guanguans/Coole/Able/EventListenerAbleProviderInterface.html","link":"Guanguans/Coole/Able/EventListenerAbleProviderInterface.html#method_subscribe","name":"Guanguans\\Coole\\Able\\EventListenerAbleProviderInterface::subscribe","doc":"<p>服务订阅事件.</p>"},
            
                                                 {"type":"Interface","fromName":"Guanguans\\Coole\\Controller","fromLink":"Guanguans/Coole/Controller.html","link":"Guanguans/Coole/Controller/ControllerInterface.html","name":"Guanguans\\Coole\\Controller\\ControllerInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\ControllerInterface","fromLink":"Guanguans/Coole/Controller/ControllerInterface.html","link":"Guanguans/Coole/Controller/ControllerInterface.html#method_render","name":"Guanguans\\Coole\\Controller\\ControllerInterface::render","doc":"<p>渲染模板</p>"},
            
                                                 {"type":"Interface","fromName":"Guanguans\\Coole\\Event","fromLink":"Guanguans/Coole/Event.html","link":"Guanguans/Coole/Event/ListenerInterface.html","name":"Guanguans\\Coole\\Event\\ListenerInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Event\\ListenerInterface","fromLink":"Guanguans/Coole/Event/ListenerInterface.html","link":"Guanguans/Coole/Event/ListenerInterface.html#method_handle","name":"Guanguans\\Coole\\Event\\ListenerInterface::handle","doc":"<p>事件处理.</p>"},
            
                                                 {"type":"Interface","fromName":"Guanguans\\Coole\\Middleware","fromLink":"Guanguans/Coole/Middleware.html","link":"Guanguans/Coole/Middleware/MiddlewareInterface.html","name":"Guanguans\\Coole\\Middleware\\MiddlewareInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Middleware\\MiddlewareInterface","fromLink":"Guanguans/Coole/Middleware/MiddlewareInterface.html","link":"Guanguans/Coole/Middleware/MiddlewareInterface.html#method_handle","name":"Guanguans\\Coole\\Middleware\\MiddlewareInterface::handle","doc":""},
            
                                                        {"type":"Class","fromName":"Guanguans\\Coole\\Able","fromLink":"Guanguans/Coole/Able.html","link":"Guanguans/Coole/Able/AfterRegisterAbleProviderInterface.html","name":"Guanguans\\Coole\\Able\\AfterRegisterAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Able\\AfterRegisterAbleProviderInterface","fromLink":"Guanguans/Coole/Able/AfterRegisterAbleProviderInterface.html","link":"Guanguans/Coole/Able/AfterRegisterAbleProviderInterface.html#method_afterRegister","name":"Guanguans\\Coole\\Able\\AfterRegisterAbleProviderInterface::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Able","fromLink":"Guanguans/Coole/Able.html","link":"Guanguans/Coole/Able/BeforeRegisterAbleProviderInterface.html","name":"Guanguans\\Coole\\Able\\BeforeRegisterAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Able\\BeforeRegisterAbleProviderInterface","fromLink":"Guanguans/Coole/Able/BeforeRegisterAbleProviderInterface.html","link":"Guanguans/Coole/Able/BeforeRegisterAbleProviderInterface.html#method_beforeRegister","name":"Guanguans\\Coole\\Able\\BeforeRegisterAbleProviderInterface::beforeRegister","doc":"<p>注册服务之前.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Able","fromLink":"Guanguans/Coole/Able.html","link":"Guanguans/Coole/Able/BootAbleProviderInterface.html","name":"Guanguans\\Coole\\Able\\BootAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Able\\BootAbleProviderInterface","fromLink":"Guanguans/Coole/Able/BootAbleProviderInterface.html","link":"Guanguans/Coole/Able/BootAbleProviderInterface.html#method_boot","name":"Guanguans\\Coole\\Able\\BootAbleProviderInterface::boot","doc":"<p>引导应用程序.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Able","fromLink":"Guanguans/Coole/Able.html","link":"Guanguans/Coole/Able/EventListenerAbleProviderInterface.html","name":"Guanguans\\Coole\\Able\\EventListenerAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Able\\EventListenerAbleProviderInterface","fromLink":"Guanguans/Coole/Able/EventListenerAbleProviderInterface.html","link":"Guanguans/Coole/Able/EventListenerAbleProviderInterface.html#method_subscribe","name":"Guanguans\\Coole\\Able\\EventListenerAbleProviderInterface::subscribe","doc":"<p>服务订阅事件.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole","fromLink":"Guanguans/Coole.html","link":"Guanguans/Coole/App.html","name":"Guanguans\\Coole\\App","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method___construct","name":"Guanguans\\Coole\\App::__construct","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_register","name":"Guanguans\\Coole\\App::register","doc":"<p>注册服务.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_addOptions","name":"Guanguans\\Coole\\App::addOptions","doc":"<p>添加全局配置.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_version","name":"Guanguans\\Coole\\App::version","doc":"<p>获取版本号.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_loadEnv","name":"Guanguans\\Coole\\App::loadEnv","doc":"<p>加载 env.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_loadConfig","name":"Guanguans\\Coole\\App::loadConfig","doc":"<p>加载配置.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_loadRoute","name":"Guanguans\\Coole\\App::loadRoute","doc":"<p>加载路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_loadCommand","name":"Guanguans\\Coole\\App::loadCommand","doc":"<p>加载命令.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_setOptions","name":"Guanguans\\Coole\\App::setOptions","doc":"<p>设置全局配置.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_mergeConfig","name":"Guanguans\\Coole\\App::mergeConfig","doc":"<p>合并配置.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_addConfig","name":"Guanguans\\Coole\\App::addConfig","doc":"<p>添加配置.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_registerProviders","name":"Guanguans\\Coole\\App::registerProviders","doc":"<p>批量注册服务.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_run","name":"Guanguans\\Coole\\App::run","doc":"<p>启动运行服务.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_boot","name":"Guanguans\\Coole\\App::boot","doc":"<p>引导应用程序.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_sendRequestThroughPipeline","name":"Guanguans\\Coole\\App::sendRequestThroughPipeline","doc":"<p>通过管道发送响应.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_handle","name":"Guanguans\\Coole\\App::handle","doc":"<p>处理请求为响应且发送响应.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_terminate","name":"Guanguans\\Coole\\App::terminate","doc":"<p>终止请求/响应生命周期.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_makeMiddleware","name":"Guanguans\\Coole\\App::makeMiddleware","doc":"<p>批量实例化中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_getCurrentRequestShouldExecutedMiddleware","name":"Guanguans\\Coole\\App::getCurrentRequestShouldExecutedMiddleware","doc":"<p>获取当前请求应该被执行的中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_getCurrentRequestExcludedMiddleware","name":"Guanguans\\Coole\\App::getCurrentRequestExcludedMiddleware","doc":"<p>获取当前请求排除中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_getCurrentRequestMiddleware","name":"Guanguans\\Coole\\App::getCurrentRequestMiddleware","doc":"<p>获取当前请求中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_getControllerExcludedMiddleware","name":"Guanguans\\Coole\\App::getControllerExcludedMiddleware","doc":"<p>获取控制器排除中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_getRouteExcludedMiddleware","name":"Guanguans\\Coole\\App::getRouteExcludedMiddleware","doc":"<p>获取路由排除中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_getControllerMiddleware","name":"Guanguans\\Coole\\App::getControllerMiddleware","doc":"<p>获取控制器中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_getRouteMiddleware","name":"Guanguans\\Coole\\App::getRouteMiddleware","doc":"<p>获取路由中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_getCurrentRoute","name":"Guanguans\\Coole\\App::getCurrentRoute","doc":"<p>获取当前路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\App","fromLink":"Guanguans/Coole/App.html","link":"Guanguans/Coole/App.html#method_getCurrentController","name":"Guanguans\\Coole\\App::getCurrentController","doc":"<p>获取当前控制器.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Console","fromLink":"Guanguans/Coole/Console.html","link":"Guanguans/Coole/Console/Application.html","name":"Guanguans\\Coole\\Console\\Application","doc":"<pre><code class=\"language-php\">\nuse Guanguans\\Coole\\Console\\Application;.</code></pre>"},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Application","fromLink":"Guanguans/Coole/Console/Application.html","link":"Guanguans/Coole/Console/Application.html#method___construct","name":"Guanguans\\Coole\\Console\\Application::__construct","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Application","fromLink":"Guanguans/Coole/Console/Application.html","link":"Guanguans/Coole/Console/Application.html#method_doRun","name":"Guanguans\\Coole\\Console\\Application::doRun","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Application","fromLink":"Guanguans/Coole/Console/Application.html","link":"Guanguans/Coole/Console/Application.html#method_getHelp","name":"Guanguans\\Coole\\Console\\Application::getHelp","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Console","fromLink":"Guanguans/Coole/Console.html","link":"Guanguans/Coole/Console/Command.html","name":"Guanguans\\Coole\\Console\\Command","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Command","fromLink":"Guanguans/Coole/Console/Command.html","link":"Guanguans/Coole/Console/Command.html#method___construct","name":"Guanguans\\Coole\\Console\\Command::__construct","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Command","fromLink":"Guanguans/Coole/Console/Command.html","link":"Guanguans/Coole/Console/Command.html#method_initialize","name":"Guanguans\\Coole\\Console\\Command::initialize","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Command","fromLink":"Guanguans/Coole/Console/Command.html","link":"Guanguans/Coole/Console/Command.html#method_specifyParameters","name":"Guanguans\\Coole\\Console\\Command::specifyParameters","doc":"<p>添加参数和选项.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Command","fromLink":"Guanguans/Coole/Console/Command.html","link":"Guanguans/Coole/Console/Command.html#method_getArguments","name":"Guanguans\\Coole\\Console\\Command::getArguments","doc":"<p>获取参数.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Command","fromLink":"Guanguans/Coole/Console/Command.html","link":"Guanguans/Coole/Console/Command.html#method_getOptions","name":"Guanguans\\Coole\\Console\\Command::getOptions","doc":"<p>获取选项.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Console","fromLink":"Guanguans/Coole/Console.html","link":"Guanguans/Coole/Console/CommandDiscoverer.html","name":"Guanguans\\Coole\\Console\\CommandDiscoverer","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Console\\CommandDiscoverer","fromLink":"Guanguans/Coole/Console/CommandDiscoverer.html","link":"Guanguans/Coole/Console/CommandDiscoverer.html#method___construct","name":"Guanguans\\Coole\\Console\\CommandDiscoverer::__construct","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\CommandDiscoverer","fromLink":"Guanguans/Coole/Console/CommandDiscoverer.html","link":"Guanguans/Coole/Console/CommandDiscoverer.html#method_getCommands","name":"Guanguans\\Coole\\Console\\CommandDiscoverer::getCommands","doc":"<p>获取命令.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\CommandDiscoverer","fromLink":"Guanguans/Coole/Console/CommandDiscoverer.html","link":"Guanguans/Coole/Console/CommandDiscoverer.html#method_getDir","name":"Guanguans\\Coole\\Console\\CommandDiscoverer::getDir","doc":"<p>获取目录.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\CommandDiscoverer","fromLink":"Guanguans/Coole/Console/CommandDiscoverer.html","link":"Guanguans/Coole/Console/CommandDiscoverer.html#method_setDir","name":"Guanguans\\Coole\\Console\\CommandDiscoverer::setDir","doc":"<p>设置目录.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\CommandDiscoverer","fromLink":"Guanguans/Coole/Console/CommandDiscoverer.html","link":"Guanguans/Coole/Console/CommandDiscoverer.html#method_getNamespace","name":"Guanguans\\Coole\\Console\\CommandDiscoverer::getNamespace","doc":"<p>获取命名空间.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\CommandDiscoverer","fromLink":"Guanguans/Coole/Console/CommandDiscoverer.html","link":"Guanguans/Coole/Console/CommandDiscoverer.html#method_setNamespace","name":"Guanguans\\Coole\\Console\\CommandDiscoverer::setNamespace","doc":"<p>设置命名空间.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\CommandDiscoverer","fromLink":"Guanguans/Coole/Console/CommandDiscoverer.html","link":"Guanguans/Coole/Console/CommandDiscoverer.html#method_getSuffix","name":"Guanguans\\Coole\\Console\\CommandDiscoverer::getSuffix","doc":"<p>获取后缀</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\CommandDiscoverer","fromLink":"Guanguans/Coole/Console/CommandDiscoverer.html","link":"Guanguans/Coole/Console/CommandDiscoverer.html#method_setSuffix","name":"Guanguans\\Coole\\Console\\CommandDiscoverer::setSuffix","doc":"<p>设置后缀</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Console\\Commands","fromLink":"Guanguans/Coole/Console/Commands.html","link":"Guanguans/Coole/Console/Commands/ServeCommand.html","name":"Guanguans\\Coole\\Console\\Commands\\ServeCommand","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Commands\\ServeCommand","fromLink":"Guanguans/Coole/Console/Commands/ServeCommand.html","link":"Guanguans/Coole/Console/Commands/ServeCommand.html#method_execute","name":"Guanguans\\Coole\\Console\\Commands\\ServeCommand::execute","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\Commands\\ServeCommand","fromLink":"Guanguans/Coole/Console/Commands/ServeCommand.html","link":"Guanguans/Coole/Console/Commands/ServeCommand.html#method_serverCommand","name":"Guanguans\\Coole\\Console\\Commands\\ServeCommand::serverCommand","doc":null},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Console","fromLink":"Guanguans/Coole/Console.html","link":"Guanguans/Coole/Console/ConsoleServiceProvider.html","name":"Guanguans\\Coole\\Console\\ConsoleServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Console\\ConsoleServiceProvider","fromLink":"Guanguans/Coole/Console/ConsoleServiceProvider.html","link":"Guanguans/Coole/Console/ConsoleServiceProvider.html#method_beforeRegister","name":"Guanguans\\Coole\\Console\\ConsoleServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\ConsoleServiceProvider","fromLink":"Guanguans/Coole/Console/ConsoleServiceProvider.html","link":"Guanguans/Coole/Console/ConsoleServiceProvider.html#method_register","name":"Guanguans\\Coole\\Console\\ConsoleServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Console\\ConsoleServiceProvider","fromLink":"Guanguans/Coole/Console/ConsoleServiceProvider.html","link":"Guanguans/Coole/Console/ConsoleServiceProvider.html#method_afterRegister","name":"Guanguans\\Coole\\Console\\ConsoleServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Controller","fromLink":"Guanguans/Coole/Controller.html","link":"Guanguans/Coole/Controller/Controller.html","name":"Guanguans\\Coole\\Controller\\Controller","doc":null},
                
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Controller","fromLink":"Guanguans/Coole/Controller.html","link":"Guanguans/Coole/Controller/ControllerInterface.html","name":"Guanguans\\Coole\\Controller\\ControllerInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\ControllerInterface","fromLink":"Guanguans/Coole/Controller/ControllerInterface.html","link":"Guanguans/Coole/Controller/ControllerInterface.html#method_render","name":"Guanguans\\Coole\\Controller\\ControllerInterface::render","doc":"<p>渲染模板</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Controller","fromLink":"Guanguans/Coole/Controller.html","link":"Guanguans/Coole/Controller/ControllerResolver.html","name":"Guanguans\\Coole\\Controller\\ControllerResolver","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\ControllerResolver","fromLink":"Guanguans/Coole/Controller/ControllerResolver.html","link":"Guanguans/Coole/Controller/ControllerResolver.html#method_instantiateController","name":"Guanguans\\Coole\\Controller\\ControllerResolver::instantiateController","doc":"<p>{@inheritDoc}</p>"},
            
                                                {"type":"Trait","fromName":"Guanguans\\Coole\\Controller","fromLink":"Guanguans/Coole/Controller.html","link":"Guanguans/Coole/Controller/HasControllerAble.html","name":"Guanguans\\Coole\\Controller\\HasControllerAble","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_render","name":"Guanguans\\Coole\\Controller\\HasControllerAble::render","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_redirect","name":"Guanguans\\Coole\\Controller\\HasControllerAble::redirect","doc":"<p>重定 url.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_abort","name":"Guanguans\\Coole\\Controller\\HasControllerAble::abort","doc":"<p>抛出 http 异常.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_stream","name":"Guanguans\\Coole\\Controller\\HasControllerAble::stream","doc":"<p>返回流响应.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_json","name":"Guanguans\\Coole\\Controller\\HasControllerAble::json","doc":"<p>返回 json 响应.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_sendFile","name":"Guanguans\\Coole\\Controller\\HasControllerAble::sendFile","doc":"<p>返回二进制文件响应.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_getMiddleware","name":"Guanguans\\Coole\\Controller\\HasControllerAble::getMiddleware","doc":"<p>获取中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_setMiddleware","name":"Guanguans\\Coole\\Controller\\HasControllerAble::setMiddleware","doc":"<p>设置中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_addMiddleware","name":"Guanguans\\Coole\\Controller\\HasControllerAble::addMiddleware","doc":"<p>添加中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_getExcludedMiddleware","name":"Guanguans\\Coole\\Controller\\HasControllerAble::getExcludedMiddleware","doc":"<p>获取排除的中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_withoutMiddleware","name":"Guanguans\\Coole\\Controller\\HasControllerAble::withoutMiddleware","doc":"<p>排除中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_setExcludedMiddleware","name":"Guanguans\\Coole\\Controller\\HasControllerAble::setExcludedMiddleware","doc":"<p>设置排除的中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_addExcludedMiddleware","name":"Guanguans\\Coole\\Controller\\HasControllerAble::addExcludedMiddleware","doc":"<p>添加排除的中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_addFinishHandler","name":"Guanguans\\Coole\\Controller\\HasControllerAble::addFinishHandler","doc":"<p>添加一个 <code>KernelEvents::TERMINATE</code> 事件监听处理器.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Controller\\HasControllerAble","fromLink":"Guanguans/Coole/Controller/HasControllerAble.html","link":"Guanguans/Coole/Controller/HasControllerAble.html#method_setFinishHandler","name":"Guanguans\\Coole\\Controller\\HasControllerAble::setFinishHandler","doc":"<p>设置一个 <code>KernelEvents::TERMINATE</code> 事件监听处理器.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Database","fromLink":"Guanguans/Coole/Database.html","link":"Guanguans/Coole/Database/DatabaseServiceProvider.html","name":"Guanguans\\Coole\\Database\\DatabaseServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Database\\DatabaseServiceProvider","fromLink":"Guanguans/Coole/Database/DatabaseServiceProvider.html","link":"Guanguans/Coole/Database/DatabaseServiceProvider.html#method_beforeRegister","name":"Guanguans\\Coole\\Database\\DatabaseServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Database\\DatabaseServiceProvider","fromLink":"Guanguans/Coole/Database/DatabaseServiceProvider.html","link":"Guanguans/Coole/Database/DatabaseServiceProvider.html#method_register","name":"Guanguans\\Coole\\Database\\DatabaseServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Database\\DatabaseServiceProvider","fromLink":"Guanguans/Coole/Database/DatabaseServiceProvider.html","link":"Guanguans/Coole/Database/DatabaseServiceProvider.html#method_boot","name":"Guanguans\\Coole\\Database\\DatabaseServiceProvider::boot","doc":"<p>引导应用程序.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Database","fromLink":"Guanguans/Coole/Database.html","link":"Guanguans/Coole/Database/Model.html","name":"Guanguans\\Coole\\Database\\Model","doc":null},
                
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Event","fromLink":"Guanguans/Coole/Event.html","link":"Guanguans/Coole/Event/Event.html","name":"Guanguans\\Coole\\Event\\Event","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Event\\Event","fromLink":"Guanguans/Coole/Event/Event.html","link":"Guanguans/Coole/Event/Event.html#method_getName","name":"Guanguans\\Coole\\Event\\Event::getName","doc":"<p>获取事件名称.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Event","fromLink":"Guanguans/Coole/Event.html","link":"Guanguans/Coole/Event/EventServiceProvider.html","name":"Guanguans\\Coole\\Event\\EventServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Event\\EventServiceProvider","fromLink":"Guanguans/Coole/Event/EventServiceProvider.html","link":"Guanguans/Coole/Event/EventServiceProvider.html#method_register","name":"Guanguans\\Coole\\Event\\EventServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Event\\EventServiceProvider","fromLink":"Guanguans/Coole/Event/EventServiceProvider.html","link":"Guanguans/Coole/Event/EventServiceProvider.html#method_afterRegister","name":"Guanguans\\Coole\\Event\\EventServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Event","fromLink":"Guanguans/Coole/Event.html","link":"Guanguans/Coole/Event/ListenerInterface.html","name":"Guanguans\\Coole\\Event\\ListenerInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Event\\ListenerInterface","fromLink":"Guanguans/Coole/Event/ListenerInterface.html","link":"Guanguans/Coole/Event/ListenerInterface.html#method_handle","name":"Guanguans\\Coole\\Event\\ListenerInterface::handle","doc":"<p>事件处理.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Exception","fromLink":"Guanguans/Coole/Exception.html","link":"Guanguans/Coole/Exception/InvalidClassException.html","name":"Guanguans\\Coole\\Exception\\InvalidClassException","doc":null},
                
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Exception","fromLink":"Guanguans/Coole/Exception.html","link":"Guanguans/Coole/Exception/UnknownFileException.html","name":"Guanguans\\Coole\\Exception\\UnknownFileException","doc":null},
                
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Facade","fromLink":"Guanguans/Coole/Facade.html","link":"Guanguans/Coole/Facade/App.html","name":"Guanguans\\Coole\\Facade\\App","doc":""},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_getFacadeAccessor","name":"Guanguans\\Coole\\Facade\\App::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_register","name":"Guanguans\\Coole\\Facade\\App::register","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_addOptions","name":"Guanguans\\Coole\\Facade\\App::addOptions","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_version","name":"Guanguans\\Coole\\Facade\\App::version","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_loadEnv","name":"Guanguans\\Coole\\Facade\\App::loadEnv","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_loadConfig","name":"Guanguans\\Coole\\Facade\\App::loadConfig","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_loadRoute","name":"Guanguans\\Coole\\Facade\\App::loadRoute","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_loadCommand","name":"Guanguans\\Coole\\Facade\\App::loadCommand","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_setOptions","name":"Guanguans\\Coole\\Facade\\App::setOptions","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_mergeConfig","name":"Guanguans\\Coole\\Facade\\App::mergeConfig","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_addConfig","name":"Guanguans\\Coole\\Facade\\App::addConfig","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_registerProviders","name":"Guanguans\\Coole\\Facade\\App::registerProviders","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_makeMiddleware","name":"Guanguans\\Coole\\Facade\\App::makeMiddleware","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_getCurrentRequestShouldExecutedMiddleware","name":"Guanguans\\Coole\\Facade\\App::getCurrentRequestShouldExecutedMiddleware","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_getControllerShouldExecutedMiddleware","name":"Guanguans\\Coole\\Facade\\App::getControllerShouldExecutedMiddleware","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_getRouteShouldExecutedMiddleware","name":"Guanguans\\Coole\\Facade\\App::getRouteShouldExecutedMiddleware","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_render","name":"Guanguans\\Coole\\Facade\\App::render","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_redirect","name":"Guanguans\\Coole\\Facade\\App::redirect","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_abort","name":"Guanguans\\Coole\\Facade\\App::abort","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_stream","name":"Guanguans\\Coole\\Facade\\App::stream","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_json","name":"Guanguans\\Coole\\Facade\\App::json","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_sendFile","name":"Guanguans\\Coole\\Facade\\App::sendFile","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_getMiddleware","name":"Guanguans\\Coole\\Facade\\App::getMiddleware","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_setMiddleware","name":"Guanguans\\Coole\\Facade\\App::setMiddleware","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_addMiddleware","name":"Guanguans\\Coole\\Facade\\App::addMiddleware","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_addFinishHandler","name":"Guanguans\\Coole\\Facade\\App::addFinishHandler","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_make","name":"Guanguans\\Coole\\Facade\\App::make","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_makeWith","name":"Guanguans\\Coole\\Facade\\App::makeWith","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_build","name":"Guanguans\\Coole\\Facade\\App::build","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_refresh","name":"Guanguans\\Coole\\Facade\\App::refresh","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_rebinding","name":"Guanguans\\Coole\\Facade\\App::rebinding","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_bindIf","name":"Guanguans\\Coole\\Facade\\App::bindIf","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_singleton","name":"Guanguans\\Coole\\Facade\\App::singleton","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_bind","name":"Guanguans\\Coole\\Facade\\App::bind","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_extend","name":"Guanguans\\Coole\\Facade\\App::extend","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_call","name":"Guanguans\\Coole\\Facade\\App::call","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_alias","name":"Guanguans\\Coole\\Facade\\App::alias","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_tag","name":"Guanguans\\Coole\\Facade\\App::tag","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_tagged","name":"Guanguans\\Coole\\Facade\\App::tagged","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_factory","name":"Guanguans\\Coole\\Facade\\App::factory","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_wrap","name":"Guanguans\\Coole\\Facade\\App::wrap","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_has","name":"Guanguans\\Coole\\Facade\\App::has","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\App","fromLink":"Guanguans/Coole/Facade/App.html","link":"Guanguans/Coole/Facade/App.html#method_get","name":"Guanguans\\Coole\\Facade\\App::get","doc":""},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Facade","fromLink":"Guanguans/Coole/Facade.html","link":"Guanguans/Coole/Facade/DB.html","name":"Guanguans\\Coole\\Facade\\DB","doc":""},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_getFacadeAccessor","name":"Guanguans\\Coole\\Facade\\DB::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_connection","name":"Guanguans\\Coole\\Facade\\DB::connection","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_table","name":"Guanguans\\Coole\\Facade\\DB::table","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_raw","name":"Guanguans\\Coole\\Facade\\DB::raw","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_prepareBindings","name":"Guanguans\\Coole\\Facade\\DB::prepareBindings","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_pretend","name":"Guanguans\\Coole\\Facade\\DB::pretend","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_select","name":"Guanguans\\Coole\\Facade\\DB::select","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_insert","name":"Guanguans\\Coole\\Facade\\DB::insert","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_statement","name":"Guanguans\\Coole\\Facade\\DB::statement","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_unprepared","name":"Guanguans\\Coole\\Facade\\DB::unprepared","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_affectingStatement","name":"Guanguans\\Coole\\Facade\\DB::affectingStatement","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_delete","name":"Guanguans\\Coole\\Facade\\DB::delete","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_transactionLevel","name":"Guanguans\\Coole\\Facade\\DB::transactionLevel","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_update","name":"Guanguans\\Coole\\Facade\\DB::update","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_selectOne","name":"Guanguans\\Coole\\Facade\\DB::selectOne","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_transaction","name":"Guanguans\\Coole\\Facade\\DB::transaction","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_getDefaultConnection","name":"Guanguans\\Coole\\Facade\\DB::getDefaultConnection","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_beginTransaction","name":"Guanguans\\Coole\\Facade\\DB::beginTransaction","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_commit","name":"Guanguans\\Coole\\Facade\\DB::commit","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_listen","name":"Guanguans\\Coole\\Facade\\DB::listen","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_rollBack","name":"Guanguans\\Coole\\Facade\\DB::rollBack","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\DB","fromLink":"Guanguans/Coole/Facade/DB.html","link":"Guanguans/Coole/Facade/DB.html#method_setDefaultConnection","name":"Guanguans\\Coole\\Facade\\DB::setDefaultConnection","doc":""},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Facade","fromLink":"Guanguans/Coole/Facade.html","link":"Guanguans/Coole/Facade/Facade.html","name":"Guanguans\\Coole\\Facade\\Facade","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Facade","fromLink":"Guanguans/Coole/Facade/Facade.html","link":"Guanguans/Coole/Facade/Facade.html#method_getFacadeRoot","name":"Guanguans\\Coole\\Facade\\Facade::getFacadeRoot","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Facade","fromLink":"Guanguans/Coole/Facade/Facade.html","link":"Guanguans/Coole/Facade/Facade.html#method_getFacadeAccessor","name":"Guanguans\\Coole\\Facade\\Facade::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Facade","fromLink":"Guanguans/Coole/Facade/Facade.html","link":"Guanguans/Coole/Facade/Facade.html#method_resolveFacadeInstance","name":"Guanguans\\Coole\\Facade\\Facade::resolveFacadeInstance","doc":"<p>解析门面实例.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Facade","fromLink":"Guanguans/Coole/Facade/Facade.html","link":"Guanguans/Coole/Facade/Facade.html#method_getFacadeApplication","name":"Guanguans\\Coole\\Facade\\Facade::getFacadeApplication","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Facade","fromLink":"Guanguans/Coole/Facade/Facade.html","link":"Guanguans/Coole/Facade/Facade.html#method_setFacadeApplication","name":"Guanguans\\Coole\\Facade\\Facade::setFacadeApplication","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Facade","fromLink":"Guanguans/Coole/Facade/Facade.html","link":"Guanguans/Coole/Facade/Facade.html#method___callStatic","name":"Guanguans\\Coole\\Facade\\Facade::__callStatic","doc":""},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Facade","fromLink":"Guanguans/Coole/Facade.html","link":"Guanguans/Coole/Facade/Logger.html","name":"Guanguans\\Coole\\Facade\\Logger","doc":""},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_getFacadeAccessor","name":"Guanguans\\Coole\\Facade\\Logger::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_log","name":"Guanguans\\Coole\\Facade\\Logger::log","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_debug","name":"Guanguans\\Coole\\Facade\\Logger::debug","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_info","name":"Guanguans\\Coole\\Facade\\Logger::info","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_notice","name":"Guanguans\\Coole\\Facade\\Logger::notice","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_warning","name":"Guanguans\\Coole\\Facade\\Logger::warning","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_error","name":"Guanguans\\Coole\\Facade\\Logger::error","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_critical","name":"Guanguans\\Coole\\Facade\\Logger::critical","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_alert","name":"Guanguans\\Coole\\Facade\\Logger::alert","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Logger","fromLink":"Guanguans/Coole/Facade/Logger.html","link":"Guanguans/Coole/Facade/Logger.html#method_emergency","name":"Guanguans\\Coole\\Facade\\Logger::emergency","doc":""},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Facade","fromLink":"Guanguans/Coole/Facade.html","link":"Guanguans/Coole/Facade/Router.html","name":"Guanguans\\Coole\\Facade\\Router","doc":""},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_getFacadeAccessor","name":"Guanguans\\Coole\\Facade\\Router::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_any","name":"Guanguans\\Coole\\Facade\\Router::any","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_delete","name":"Guanguans\\Coole\\Facade\\Router::delete","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_get","name":"Guanguans\\Coole\\Facade\\Router::get","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_match","name":"Guanguans\\Coole\\Facade\\Router::match","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_options","name":"Guanguans\\Coole\\Facade\\Router::options","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_patch","name":"Guanguans\\Coole\\Facade\\Router::patch","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_post","name":"Guanguans\\Coole\\Facade\\Router::post","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_put","name":"Guanguans\\Coole\\Facade\\Router::put","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setPath","name":"Guanguans\\Coole\\Facade\\Router::setPath","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setHost","name":"Guanguans\\Coole\\Facade\\Router::setHost","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setSchemes","name":"Guanguans\\Coole\\Facade\\Router::setSchemes","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setMethods","name":"Guanguans\\Coole\\Facade\\Router::setMethods","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setOptions","name":"Guanguans\\Coole\\Facade\\Router::setOptions","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setOption","name":"Guanguans\\Coole\\Facade\\Router::setOption","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setDefaults","name":"Guanguans\\Coole\\Facade\\Router::setDefaults","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setDefault","name":"Guanguans\\Coole\\Facade\\Router::setDefault","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setRequirements","name":"Guanguans\\Coole\\Facade\\Router::setRequirements","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setRequirement","name":"Guanguans\\Coole\\Facade\\Router::setRequirement","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_setCondition","name":"Guanguans\\Coole\\Facade\\Router::setCondition","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_prefix","name":"Guanguans\\Coole\\Facade\\Router::prefix","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\Router","fromLink":"Guanguans/Coole/Facade/Router.html","link":"Guanguans/Coole/Facade/Router.html#method_group","name":"Guanguans\\Coole\\Facade\\Router::group","doc":""},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Facade","fromLink":"Guanguans/Coole/Facade.html","link":"Guanguans/Coole/Facade/View.html","name":"Guanguans\\Coole\\Facade\\View","doc":""},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\View","fromLink":"Guanguans/Coole/Facade/View.html","link":"Guanguans/Coole/Facade/View.html#method_getFacadeAccessor","name":"Guanguans\\Coole\\Facade\\View::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\View","fromLink":"Guanguans/Coole/Facade/View.html","link":"Guanguans/Coole/Facade/View.html#method_render","name":"Guanguans\\Coole\\Facade\\View::render","doc":""},
        {"type":"Method","fromName":"Guanguans\\Coole\\Facade\\View","fromLink":"Guanguans/Coole/Facade/View.html","link":"Guanguans/Coole/Facade/View.html#method_display","name":"Guanguans\\Coole\\Facade\\View::display","doc":""},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Listener","fromLink":"Guanguans/Coole/Listener.html","link":"Guanguans/Coole/Listener/LogListener.html","name":"Guanguans\\Coole\\Listener\\LogListener","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Listener\\LogListener","fromLink":"Guanguans/Coole/Listener/LogListener.html","link":"Guanguans/Coole/Listener/LogListener.html#method___construct","name":"Guanguans\\Coole\\Listener\\LogListener::__construct","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Listener\\LogListener","fromLink":"Guanguans/Coole/Listener/LogListener.html","link":"Guanguans/Coole/Listener/LogListener.html#method_onKernelRequest","name":"Guanguans\\Coole\\Listener\\LogListener::onKernelRequest","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Listener\\LogListener","fromLink":"Guanguans/Coole/Listener/LogListener.html","link":"Guanguans/Coole/Listener/LogListener.html#method_onKernelResponse","name":"Guanguans\\Coole\\Listener\\LogListener::onKernelResponse","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Listener\\LogListener","fromLink":"Guanguans/Coole/Listener/LogListener.html","link":"Guanguans/Coole/Listener/LogListener.html#method_onKernelException","name":"Guanguans\\Coole\\Listener\\LogListener::onKernelException","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Listener\\LogListener","fromLink":"Guanguans/Coole/Listener/LogListener.html","link":"Guanguans/Coole/Listener/LogListener.html#method_getSubscribedEvents","name":"Guanguans\\Coole\\Listener\\LogListener::getSubscribedEvents","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Listener","fromLink":"Guanguans/Coole/Listener.html","link":"Guanguans/Coole/Listener/NullResponseListener.html","name":"Guanguans\\Coole\\Listener\\NullResponseListener","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Listener\\NullResponseListener","fromLink":"Guanguans/Coole/Listener/NullResponseListener.html","link":"Guanguans/Coole/Listener/NullResponseListener.html#method_onKernelView","name":"Guanguans\\Coole\\Listener\\NullResponseListener::onKernelView","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Listener\\NullResponseListener","fromLink":"Guanguans/Coole/Listener/NullResponseListener.html","link":"Guanguans/Coole/Listener/NullResponseListener.html#method_getSubscribedEvents","name":"Guanguans\\Coole\\Listener\\NullResponseListener::getSubscribedEvents","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Listener","fromLink":"Guanguans/Coole/Listener.html","link":"Guanguans/Coole/Listener/StringResponseListener.html","name":"Guanguans\\Coole\\Listener\\StringResponseListener","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Listener\\StringResponseListener","fromLink":"Guanguans/Coole/Listener/StringResponseListener.html","link":"Guanguans/Coole/Listener/StringResponseListener.html#method_onKernelView","name":"Guanguans\\Coole\\Listener\\StringResponseListener::onKernelView","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Listener\\StringResponseListener","fromLink":"Guanguans/Coole/Listener/StringResponseListener.html","link":"Guanguans/Coole/Listener/StringResponseListener.html#method_getSubscribedEvents","name":"Guanguans\\Coole\\Listener\\StringResponseListener::getSubscribedEvents","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Middleware","fromLink":"Guanguans/Coole/Middleware.html","link":"Guanguans/Coole/Middleware/CheckResponseForModifications.html","name":"Guanguans\\Coole\\Middleware\\CheckResponseForModifications","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Middleware\\CheckResponseForModifications","fromLink":"Guanguans/Coole/Middleware/CheckResponseForModifications.html","link":"Guanguans/Coole/Middleware/CheckResponseForModifications.html#method_handle","name":"Guanguans\\Coole\\Middleware\\CheckResponseForModifications::handle","doc":""},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Middleware","fromLink":"Guanguans/Coole/Middleware.html","link":"Guanguans/Coole/Middleware/MiddlewareInterface.html","name":"Guanguans\\Coole\\Middleware\\MiddlewareInterface","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Middleware\\MiddlewareInterface","fromLink":"Guanguans/Coole/Middleware/MiddlewareInterface.html","link":"Guanguans/Coole/Middleware/MiddlewareInterface.html#method_handle","name":"Guanguans\\Coole\\Middleware\\MiddlewareInterface::handle","doc":""},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Provider","fromLink":"Guanguans/Coole/Provider.html","link":"Guanguans/Coole/Provider/AppServiceProvider.html","name":"Guanguans\\Coole\\Provider\\AppServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\AppServiceProvider","fromLink":"Guanguans/Coole/Provider/AppServiceProvider.html","link":"Guanguans/Coole/Provider/AppServiceProvider.html#method_beforeRegister","name":"Guanguans\\Coole\\Provider\\AppServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\AppServiceProvider","fromLink":"Guanguans/Coole/Provider/AppServiceProvider.html","link":"Guanguans/Coole/Provider/AppServiceProvider.html#method_setUpConfig","name":"Guanguans\\Coole\\Provider\\AppServiceProvider::setUpConfig","doc":"<p>设置配置.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\AppServiceProvider","fromLink":"Guanguans/Coole/Provider/AppServiceProvider.html","link":"Guanguans/Coole/Provider/AppServiceProvider.html#method_register","name":"Guanguans\\Coole\\Provider\\AppServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Provider","fromLink":"Guanguans/Coole/Provider.html","link":"Guanguans/Coole/Provider/ConfigServiceProvider.html","name":"Guanguans\\Coole\\Provider\\ConfigServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\ConfigServiceProvider","fromLink":"Guanguans/Coole/Provider/ConfigServiceProvider.html","link":"Guanguans/Coole/Provider/ConfigServiceProvider.html#method_beforeRegister","name":"Guanguans\\Coole\\Provider\\ConfigServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\ConfigServiceProvider","fromLink":"Guanguans/Coole/Provider/ConfigServiceProvider.html","link":"Guanguans/Coole/Provider/ConfigServiceProvider.html#method_register","name":"Guanguans\\Coole\\Provider\\ConfigServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\ConfigServiceProvider","fromLink":"Guanguans/Coole/Provider/ConfigServiceProvider.html","link":"Guanguans/Coole/Provider/ConfigServiceProvider.html#method_afterRegister","name":"Guanguans\\Coole\\Provider\\ConfigServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Provider","fromLink":"Guanguans/Coole/Provider.html","link":"Guanguans/Coole/Provider/HttpKernelServiceProvider.html","name":"Guanguans\\Coole\\Provider\\HttpKernelServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\HttpKernelServiceProvider","fromLink":"Guanguans/Coole/Provider/HttpKernelServiceProvider.html","link":"Guanguans/Coole/Provider/HttpKernelServiceProvider.html#method_register","name":"Guanguans\\Coole\\Provider\\HttpKernelServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\HttpKernelServiceProvider","fromLink":"Guanguans/Coole/Provider/HttpKernelServiceProvider.html","link":"Guanguans/Coole/Provider/HttpKernelServiceProvider.html#method_subscribe","name":"Guanguans\\Coole\\Provider\\HttpKernelServiceProvider::subscribe","doc":"<p>服务订阅事件.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Provider","fromLink":"Guanguans/Coole/Provider.html","link":"Guanguans/Coole/Provider/InvokerServiceProvider.html","name":"Guanguans\\Coole\\Provider\\InvokerServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\InvokerServiceProvider","fromLink":"Guanguans/Coole/Provider/InvokerServiceProvider.html","link":"Guanguans/Coole/Provider/InvokerServiceProvider.html#method_register","name":"Guanguans\\Coole\\Provider\\InvokerServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Provider","fromLink":"Guanguans/Coole/Provider.html","link":"Guanguans/Coole/Provider/MonologServiceProvider.html","name":"Guanguans\\Coole\\Provider\\MonologServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\MonologServiceProvider","fromLink":"Guanguans/Coole/Provider/MonologServiceProvider.html","link":"Guanguans/Coole/Provider/MonologServiceProvider.html#method_beforeRegister","name":"Guanguans\\Coole\\Provider\\MonologServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\MonologServiceProvider","fromLink":"Guanguans/Coole/Provider/MonologServiceProvider.html","link":"Guanguans/Coole/Provider/MonologServiceProvider.html#method_register","name":"Guanguans\\Coole\\Provider\\MonologServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\MonologServiceProvider","fromLink":"Guanguans/Coole/Provider/MonologServiceProvider.html","link":"Guanguans/Coole/Provider/MonologServiceProvider.html#method_subscribe","name":"Guanguans\\Coole\\Provider\\MonologServiceProvider::subscribe","doc":"<p>服务订阅事件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\MonologServiceProvider","fromLink":"Guanguans/Coole/Provider/MonologServiceProvider.html","link":"Guanguans/Coole/Provider/MonologServiceProvider.html#method_boot","name":"Guanguans\\Coole\\Provider\\MonologServiceProvider::boot","doc":"<p>引导应用程序.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Provider","fromLink":"Guanguans/Coole/Provider.html","link":"Guanguans/Coole/Provider/TwigServiceProvider.html","name":"Guanguans\\Coole\\Provider\\TwigServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\TwigServiceProvider","fromLink":"Guanguans/Coole/Provider/TwigServiceProvider.html","link":"Guanguans/Coole/Provider/TwigServiceProvider.html#method_beforeRegister","name":"Guanguans\\Coole\\Provider\\TwigServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\TwigServiceProvider","fromLink":"Guanguans/Coole/Provider/TwigServiceProvider.html","link":"Guanguans/Coole/Provider/TwigServiceProvider.html#method_register","name":"Guanguans\\Coole\\Provider\\TwigServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Provider","fromLink":"Guanguans/Coole/Provider.html","link":"Guanguans/Coole/Provider/WhoopsServiceProvider.html","name":"Guanguans\\Coole\\Provider\\WhoopsServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\WhoopsServiceProvider","fromLink":"Guanguans/Coole/Provider/WhoopsServiceProvider.html","link":"Guanguans/Coole/Provider/WhoopsServiceProvider.html#method_register","name":"Guanguans\\Coole\\Provider\\WhoopsServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\WhoopsServiceProvider","fromLink":"Guanguans/Coole/Provider/WhoopsServiceProvider.html","link":"Guanguans/Coole/Provider/WhoopsServiceProvider.html#method_afterRegister","name":"Guanguans\\Coole\\Provider\\WhoopsServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Provider\\WhoopsServiceProvider","fromLink":"Guanguans/Coole/Provider/WhoopsServiceProvider.html","link":"Guanguans/Coole/Provider/WhoopsServiceProvider.html#method_boot","name":"Guanguans\\Coole\\Provider\\WhoopsServiceProvider::boot","doc":"<p>引导应用程序.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Routing","fromLink":"Guanguans/Coole/Routing.html","link":"Guanguans/Coole/Routing/Route.html","name":"Guanguans\\Coole\\Routing\\Route","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Route","fromLink":"Guanguans/Coole/Routing/Route.html","link":"Guanguans/Coole/Routing/Route.html#method___construct","name":"Guanguans\\Coole\\Routing\\Route::__construct","doc":null},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Routing","fromLink":"Guanguans/Coole/Routing.html","link":"Guanguans/Coole/Routing/RouteRegistrar.html","name":"Guanguans\\Coole\\Routing\\RouteRegistrar","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\RouteRegistrar","fromLink":"Guanguans/Coole/Routing/RouteRegistrar.html","link":"Guanguans/Coole/Routing/RouteRegistrar.html#method___construct","name":"Guanguans\\Coole\\Routing\\RouteRegistrar::__construct","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\RouteRegistrar","fromLink":"Guanguans/Coole/Routing/RouteRegistrar.html","link":"Guanguans/Coole/Routing/RouteRegistrar.html#method_prefix","name":"Guanguans\\Coole\\Routing\\RouteRegistrar::prefix","doc":"<p>路由组前缀</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\RouteRegistrar","fromLink":"Guanguans/Coole/Routing/RouteRegistrar.html","link":"Guanguans/Coole/Routing/RouteRegistrar.html#method_middleware","name":"Guanguans\\Coole\\Routing\\RouteRegistrar::middleware","doc":"<p>路由组中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\RouteRegistrar","fromLink":"Guanguans/Coole/Routing/RouteRegistrar.html","link":"Guanguans/Coole/Routing/RouteRegistrar.html#method_group","name":"Guanguans\\Coole\\Routing\\RouteRegistrar::group","doc":"<p>路由组.</p>"},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Routing","fromLink":"Guanguans/Coole/Routing.html","link":"Guanguans/Coole/Routing/Router.html","name":"Guanguans\\Coole\\Routing\\Router","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method___construct","name":"Guanguans\\Coole\\Routing\\Router::__construct","doc":null},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_match","name":"Guanguans\\Coole\\Routing\\Router::match","doc":"<p>添加任意请求路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_any","name":"Guanguans\\Coole\\Routing\\Router::any","doc":"<p>添加任意请求路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_get","name":"Guanguans\\Coole\\Routing\\Router::get","doc":"<p>添加 get 求路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_post","name":"Guanguans\\Coole\\Routing\\Router::post","doc":"<p>添加 post 请求路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_put","name":"Guanguans\\Coole\\Routing\\Router::put","doc":"<p>添加 put 请求路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_delete","name":"Guanguans\\Coole\\Routing\\Router::delete","doc":"<p>添加 delete 请求路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_options","name":"Guanguans\\Coole\\Routing\\Router::options","doc":"<p>添加 options 请求路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_patch","name":"Guanguans\\Coole\\Routing\\Router::patch","doc":"<p>添加 patch 请求路由.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_getGroupPattern","name":"Guanguans\\Coole\\Routing\\Router::getGroupPattern","doc":"<p>获取路由组 pattern.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_getGroupMiddleware","name":"Guanguans\\Coole\\Routing\\Router::getGroupMiddleware","doc":"<p>获取路由组中间件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_updateGroupStack","name":"Guanguans\\Coole\\Routing\\Router::updateGroupStack","doc":"<p>更新路由组栈.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method_group","name":"Guanguans\\Coole\\Routing\\Router::group","doc":"<p>路由组.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\Router","fromLink":"Guanguans/Coole/Routing/Router.html","link":"Guanguans/Coole/Routing/Router.html#method___call","name":"Guanguans\\Coole\\Routing\\Router::__call","doc":""},
            
                                                {"type":"Class","fromName":"Guanguans\\Coole\\Routing","fromLink":"Guanguans/Coole/Routing.html","link":"Guanguans/Coole/Routing/RoutingServiceProvider.html","name":"Guanguans\\Coole\\Routing\\RoutingServiceProvider","doc":null},
                                {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\RoutingServiceProvider","fromLink":"Guanguans/Coole/Routing/RoutingServiceProvider.html","link":"Guanguans/Coole/Routing/RoutingServiceProvider.html#method_register","name":"Guanguans\\Coole\\Routing\\RoutingServiceProvider::register","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\RoutingServiceProvider","fromLink":"Guanguans/Coole/Routing/RoutingServiceProvider.html","link":"Guanguans/Coole/Routing/RoutingServiceProvider.html#method_subscribe","name":"Guanguans\\Coole\\Routing\\RoutingServiceProvider::subscribe","doc":"<p>服务订阅事件.</p>"},
        {"type":"Method","fromName":"Guanguans\\Coole\\Routing\\RoutingServiceProvider","fromLink":"Guanguans/Coole/Routing/RoutingServiceProvider.html","link":"Guanguans/Coole/Routing/RoutingServiceProvider.html#method_afterRegister","name":"Guanguans\\Coole\\Routing\\RoutingServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Doctum = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Doctum.injectApiTree($('#api-tree'));
    });

    return root.Doctum;
})(window);

$(function() {

        // Enable the version switcher
    $('#version-switcher').on('change', function() {
        window.location = $(this).val()
    });
    var versionSwitcher = document.getElementById('version-switcher');
    if (versionSwitcher) {
        var versionToSelect = document.evaluate(
            '//option[@data-version="1.x"]',
            versionSwitcher,
            null,
            XPathResult.FIRST_ORDERED_NODE_TYPE,
            null
        ).singleNodeValue;

        if (versionToSelect && typeof versionToSelect.selected === 'boolean') {
            versionToSelect.selected = true;
        }
    }
    
    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').on('click', function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Doctum.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});



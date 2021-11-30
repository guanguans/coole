

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '<ul><li data-name="namespace:Coole" class="opened"><div style="padding-left:0px" class="hd"><span class="icon icon-play"></span><a href="Coole.html">Coole</a></div><div class="bd"><ul><li data-name="namespace:Coole_Config" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/Config.html">Config</a></div><div class="bd"><ul><li data-name="class:Coole_Config_Config" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Config/Config.html">Config</a></div></li><li data-name="class:Coole_Config_ConfigServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Config/ConfigServiceProvider.html">ConfigServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Coole_Console" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/Console.html">Console</a></div><div class="bd"><ul><li data-name="namespace:Coole_Console_Commands" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/Console/Commands.html">Commands</a></div><div class="bd"><ul><li data-name="class:Coole_Console_Commands_ServeCommand" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Console/Commands/ServeCommand.html">ServeCommand</a></div></li></ul></div></li><li data-name="class:Coole_Console_Application" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Console/Application.html">Application</a></div></li><li data-name="class:Coole_Console_Command" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Console/Command.html">Command</a></div></li><li data-name="class:Coole_Console_CommandDiscoverer" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Console/CommandDiscoverer.html">CommandDiscoverer</a></div></li><li data-name="class:Coole_Console_ConsoleServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Console/ConsoleServiceProvider.html">ConsoleServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Coole_DB" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/DB.html">DB</a></div><div class="bd"><ul><li data-name="namespace:Coole_DB_Facades" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/DB/Facades.html">Facades</a></div><div class="bd"><ul><li data-name="class:Coole_DB_Facades_DB" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/DB/Facades/DB.html">DB</a></div></li></ul></div></li><li data-name="class:Coole_DB_DBServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/DB/DBServiceProvider.html">DBServiceProvider</a></div></li><li data-name="class:Coole_DB_Model" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/DB/Model.html">Model</a></div></li></ul></div></li><li data-name="namespace:Coole_ErrorHandler" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/ErrorHandler.html">ErrorHandler</a></div><div class="bd"><ul><li data-name="class:Coole_ErrorHandler_ErrorHandlerServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/ErrorHandler/ErrorHandlerServiceProvider.html">ErrorHandlerServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Coole_Event" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/Event.html">Event</a></div><div class="bd"><ul><li data-name="class:Coole_Event_Event" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Event/Event.html">Event</a></div></li><li data-name="class:Coole_Event_EventServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Event/EventServiceProvider.html">EventServiceProvider</a></div></li><li data-name="class:Coole_Event_ListenerInterface" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Event/ListenerInterface.html">ListenerInterface</a></div></li></ul></div></li><li data-name="namespace:Coole_Foundation" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/Foundation.html">Foundation</a></div><div class="bd"><ul><li data-name="namespace:Coole_Foundation_Able" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/Foundation/Able.html">Able</a></div><div class="bd"><ul><li data-name="class:Coole_Foundation_Able_AfterRegisterAbleProviderInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Able/AfterRegisterAbleProviderInterface.html">AfterRegisterAbleProviderInterface</a></div></li><li data-name="class:Coole_Foundation_Able_BeforeRegisterAbleProviderInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Able/BeforeRegisterAbleProviderInterface.html">BeforeRegisterAbleProviderInterface</a></div></li><li data-name="class:Coole_Foundation_Able_BootAbleProviderInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Able/BootAbleProviderInterface.html">BootAbleProviderInterface</a></div></li><li data-name="class:Coole_Foundation_Able_ServiceProvider" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Able/ServiceProvider.html">ServiceProvider</a></div></li><li data-name="class:Coole_Foundation_Able_ServiceProviderInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Able/ServiceProviderInterface.html">ServiceProviderInterface</a></div></li><li data-name="class:Coole_Foundation_Able_SubscribeEventAbleProviderInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Able/SubscribeEventAbleProviderInterface.html">SubscribeEventAbleProviderInterface</a></div></li></ul></div></li><li data-name="namespace:Coole_Foundation_Exceptions" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/Foundation/Exceptions.html">Exceptions</a></div><div class="bd"><ul><li data-name="class:Coole_Foundation_Exceptions_InvalidClassException" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Exceptions/InvalidClassException.html">InvalidClassException</a></div></li><li data-name="class:Coole_Foundation_Exceptions_UnknownFileException" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Exceptions/UnknownFileException.html">UnknownFileException</a></div></li></ul></div></li><li data-name="namespace:Coole_Foundation_Facades" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/Foundation/Facades.html">Facades</a></div><div class="bd"><ul><li data-name="class:Coole_Foundation_Facades_App" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Facades/App.html">App</a></div></li><li data-name="class:Coole_Foundation_Facades_Facade" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Facades/Facade.html">Facade</a></div></li></ul></div></li><li data-name="namespace:Coole_Foundation_Listeners" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/Foundation/Listeners.html">Listeners</a></div><div class="bd"><ul><li data-name="class:Coole_Foundation_Listeners_LogListener" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Listeners/LogListener.html">LogListener</a></div></li><li data-name="class:Coole_Foundation_Listeners_NullResponseListener" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Listeners/NullResponseListener.html">NullResponseListener</a></div></li><li data-name="class:Coole_Foundation_Listeners_StringResponseListener" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Listeners/StringResponseListener.html">StringResponseListener</a></div></li></ul></div></li><li data-name="namespace:Coole_Foundation_Middlewares" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/Foundation/Middlewares.html">Middlewares</a></div><div class="bd"><ul><li data-name="class:Coole_Foundation_Middlewares_CheckResponseForModifications" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Middlewares/CheckResponseForModifications.html">CheckResponseForModifications</a></div></li><li data-name="class:Coole_Foundation_Middlewares_MiddlewareInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Foundation/Middlewares/MiddlewareInterface.html">MiddlewareInterface</a></div></li></ul></div></li><li data-name="class:Coole_Foundation_App" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Foundation/App.html">App</a></div></li><li data-name="class:Coole_Foundation_AppServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Foundation/AppServiceProvider.html">AppServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Coole_HttpKernel" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/HttpKernel.html">HttpKernel</a></div><div class="bd"><ul><li data-name="namespace:Coole_HttpKernel_Controller" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/HttpKernel/Controller.html">Controller</a></div><div class="bd"><ul><li data-name="class:Coole_HttpKernel_Controller_Controller" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/HttpKernel/Controller/Controller.html">Controller</a></div></li><li data-name="class:Coole_HttpKernel_Controller_ControllerInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/HttpKernel/Controller/ControllerInterface.html">ControllerInterface</a></div></li><li data-name="class:Coole_HttpKernel_Controller_ControllerResolver" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/HttpKernel/Controller/ControllerResolver.html">ControllerResolver</a></div></li><li data-name="class:Coole_HttpKernel_Controller_HasControllerAble" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/HttpKernel/Controller/HasControllerAble.html">HasControllerAble</a></div></li></ul></div></li><li data-name="class:Coole_HttpKernel_HttpKernelServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/HttpKernel/HttpKernelServiceProvider.html">HttpKernelServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Coole_Invoker" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/Invoker.html">Invoker</a></div><div class="bd"><ul><li data-name="namespace:Coole_Invoker_Facades" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/Invoker/Facades.html">Facades</a></div><div class="bd"><ul><li data-name="class:Coole_Invoker_Facades_Invoker" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Invoker/Facades/Invoker.html">Invoker</a></div></li></ul></div></li><li data-name="class:Coole_Invoker_InvokerServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Invoker/InvokerServiceProvider.html">InvokerServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Coole_Log" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/Log.html">Log</a></div><div class="bd"><ul><li data-name="namespace:Coole_Log_Facades" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/Log/Facades.html">Facades</a></div><div class="bd"><ul><li data-name="class:Coole_Log_Facades_Log" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Log/Facades/Log.html">Log</a></div></li></ul></div></li><li data-name="class:Coole_Log_LogServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Log/LogServiceProvider.html">LogServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Coole_Routing" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/Routing.html">Routing</a></div><div class="bd"><ul><li data-name="namespace:Coole_Routing_Facades" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/Routing/Facades.html">Facades</a></div><div class="bd"><ul><li data-name="class:Coole_Routing_Facades_Router" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/Routing/Facades/Router.html">Router</a></div></li></ul></div></li><li data-name="class:Coole_Routing_Route" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Routing/Route.html">Route</a></div></li><li data-name="class:Coole_Routing_RouteRegistrar" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Routing/RouteRegistrar.html">RouteRegistrar</a></div></li><li data-name="class:Coole_Routing_Router" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Routing/Router.html">Router</a></div></li><li data-name="class:Coole_Routing_RoutingServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/Routing/RoutingServiceProvider.html">RoutingServiceProvider</a></div></li></ul></div></li><li data-name="namespace:Coole_View" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Coole/View.html">View</a></div><div class="bd"><ul><li data-name="namespace:Coole_View_Facades" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Coole/View/Facades.html">Facades</a></div><div class="bd"><ul><li data-name="class:Coole_View_Facades_View" ><div style="padding-left:62px" class="hd leaf"><a href="Coole/View/Facades/View.html">View</a></div></li></ul></div></li><li data-name="class:Coole_View_ViewServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Coole/View/ViewServiceProvider.html">ViewServiceProvider</a></div></li></ul></div></li></ul></div></li></ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                        {"type":"Namespace","link":"Coole.html","name":"Coole","doc":"Namespace Coole"},{"type":"Namespace","link":"Coole/Config.html","name":"Coole\\Config","doc":"Namespace Coole\\Config"},{"type":"Namespace","link":"Coole/Console.html","name":"Coole\\Console","doc":"Namespace Coole\\Console"},{"type":"Namespace","link":"Coole/Console/Commands.html","name":"Coole\\Console\\Commands","doc":"Namespace Coole\\Console\\Commands"},{"type":"Namespace","link":"Coole/DB.html","name":"Coole\\DB","doc":"Namespace Coole\\DB"},{"type":"Namespace","link":"Coole/DB/Facades.html","name":"Coole\\DB\\Facades","doc":"Namespace Coole\\DB\\Facades"},{"type":"Namespace","link":"Coole/ErrorHandler.html","name":"Coole\\ErrorHandler","doc":"Namespace Coole\\ErrorHandler"},{"type":"Namespace","link":"Coole/Event.html","name":"Coole\\Event","doc":"Namespace Coole\\Event"},{"type":"Namespace","link":"Coole/Foundation.html","name":"Coole\\Foundation","doc":"Namespace Coole\\Foundation"},{"type":"Namespace","link":"Coole/Foundation/Able.html","name":"Coole\\Foundation\\Able","doc":"Namespace Coole\\Foundation\\Able"},{"type":"Namespace","link":"Coole/Foundation/Exceptions.html","name":"Coole\\Foundation\\Exceptions","doc":"Namespace Coole\\Foundation\\Exceptions"},{"type":"Namespace","link":"Coole/Foundation/Facades.html","name":"Coole\\Foundation\\Facades","doc":"Namespace Coole\\Foundation\\Facades"},{"type":"Namespace","link":"Coole/Foundation/Listeners.html","name":"Coole\\Foundation\\Listeners","doc":"Namespace Coole\\Foundation\\Listeners"},{"type":"Namespace","link":"Coole/Foundation/Middlewares.html","name":"Coole\\Foundation\\Middlewares","doc":"Namespace Coole\\Foundation\\Middlewares"},{"type":"Namespace","link":"Coole/HttpKernel.html","name":"Coole\\HttpKernel","doc":"Namespace Coole\\HttpKernel"},{"type":"Namespace","link":"Coole/HttpKernel/Controller.html","name":"Coole\\HttpKernel\\Controller","doc":"Namespace Coole\\HttpKernel\\Controller"},{"type":"Namespace","link":"Coole/Invoker.html","name":"Coole\\Invoker","doc":"Namespace Coole\\Invoker"},{"type":"Namespace","link":"Coole/Invoker/Facades.html","name":"Coole\\Invoker\\Facades","doc":"Namespace Coole\\Invoker\\Facades"},{"type":"Namespace","link":"Coole/Log.html","name":"Coole\\Log","doc":"Namespace Coole\\Log"},{"type":"Namespace","link":"Coole/Log/Facades.html","name":"Coole\\Log\\Facades","doc":"Namespace Coole\\Log\\Facades"},{"type":"Namespace","link":"Coole/Routing.html","name":"Coole\\Routing","doc":"Namespace Coole\\Routing"},{"type":"Namespace","link":"Coole/Routing/Facades.html","name":"Coole\\Routing\\Facades","doc":"Namespace Coole\\Routing\\Facades"},{"type":"Namespace","link":"Coole/View.html","name":"Coole\\View","doc":"Namespace Coole\\View"},{"type":"Namespace","link":"Coole/View/Facades.html","name":"Coole\\View\\Facades","doc":"Namespace Coole\\View\\Facades"},                                                 {"type":"Interface","fromName":"Coole\\Event","fromLink":"Coole/Event.html","link":"Coole/Event/ListenerInterface.html","name":"Coole\\Event\\ListenerInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Event\\ListenerInterface","fromLink":"Coole/Event/ListenerInterface.html","link":"Coole/Event/ListenerInterface.html#method_handle","name":"Coole\\Event\\ListenerInterface::handle","doc":"<p>事件处理.</p>"},
            
                                                 {"type":"Interface","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/AfterRegisterAbleProviderInterface.html","name":"Coole\\Foundation\\Able\\AfterRegisterAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\AfterRegisterAbleProviderInterface","fromLink":"Coole/Foundation/Able/AfterRegisterAbleProviderInterface.html","link":"Coole/Foundation/Able/AfterRegisterAbleProviderInterface.html#method_afterRegister","name":"Coole\\Foundation\\Able\\AfterRegisterAbleProviderInterface::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                 {"type":"Interface","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/BeforeRegisterAbleProviderInterface.html","name":"Coole\\Foundation\\Able\\BeforeRegisterAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\BeforeRegisterAbleProviderInterface","fromLink":"Coole/Foundation/Able/BeforeRegisterAbleProviderInterface.html","link":"Coole/Foundation/Able/BeforeRegisterAbleProviderInterface.html#method_beforeRegister","name":"Coole\\Foundation\\Able\\BeforeRegisterAbleProviderInterface::beforeRegister","doc":"<p>注册服务之前.</p>"},
            
                                                 {"type":"Interface","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/BootAbleProviderInterface.html","name":"Coole\\Foundation\\Able\\BootAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\BootAbleProviderInterface","fromLink":"Coole/Foundation/Able/BootAbleProviderInterface.html","link":"Coole/Foundation/Able/BootAbleProviderInterface.html#method_boot","name":"Coole\\Foundation\\Able\\BootAbleProviderInterface::boot","doc":"<p>引导应用程序.</p>"},
            
                                                 {"type":"Interface","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/ServiceProviderInterface.html","name":"Coole\\Foundation\\Able\\ServiceProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\ServiceProviderInterface","fromLink":"Coole/Foundation/Able/ServiceProviderInterface.html","link":"Coole/Foundation/Able/ServiceProviderInterface.html#method_register","name":"Coole\\Foundation\\Able\\ServiceProviderInterface::register","doc":"<p>Registers services on the given container.</p>"},
            
                                                 {"type":"Interface","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/SubscribeEventAbleProviderInterface.html","name":"Coole\\Foundation\\Able\\SubscribeEventAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\SubscribeEventAbleProviderInterface","fromLink":"Coole/Foundation/Able/SubscribeEventAbleProviderInterface.html","link":"Coole/Foundation/Able/SubscribeEventAbleProviderInterface.html#method_subscribe","name":"Coole\\Foundation\\Able\\SubscribeEventAbleProviderInterface::subscribe","doc":"<p>服务订阅事件.</p>"},
            
                                                 {"type":"Interface","fromName":"Coole\\Foundation\\Middlewares","fromLink":"Coole/Foundation/Middlewares.html","link":"Coole/Foundation/Middlewares/MiddlewareInterface.html","name":"Coole\\Foundation\\Middlewares\\MiddlewareInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Middlewares\\MiddlewareInterface","fromLink":"Coole/Foundation/Middlewares/MiddlewareInterface.html","link":"Coole/Foundation/Middlewares/MiddlewareInterface.html#method_handle","name":"Coole\\Foundation\\Middlewares\\MiddlewareInterface::handle","doc":""},
            
                                                 {"type":"Interface","fromName":"Coole\\HttpKernel\\Controller","fromLink":"Coole/HttpKernel/Controller.html","link":"Coole/HttpKernel/Controller/ControllerInterface.html","name":"Coole\\HttpKernel\\Controller\\ControllerInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\ControllerInterface","fromLink":"Coole/HttpKernel/Controller/ControllerInterface.html","link":"Coole/HttpKernel/Controller/ControllerInterface.html#method_render","name":"Coole\\HttpKernel\\Controller\\ControllerInterface::render","doc":"<p>渲染模板</p>"},
            
                                                        {"type":"Class","fromName":"Coole\\Config","fromLink":"Coole/Config.html","link":"Coole/Config/Config.html","name":"Coole\\Config\\Config","doc":null},
                
                                                {"type":"Class","fromName":"Coole\\Config","fromLink":"Coole/Config.html","link":"Coole/Config/ConfigServiceProvider.html","name":"Coole\\Config\\ConfigServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\Config\\ConfigServiceProvider","fromLink":"Coole/Config/ConfigServiceProvider.html","link":"Coole/Config/ConfigServiceProvider.html#method_beforeRegister","name":"Coole\\Config\\ConfigServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Coole\\Config\\ConfigServiceProvider","fromLink":"Coole/Config/ConfigServiceProvider.html","link":"Coole/Config/ConfigServiceProvider.html#method_register","name":"Coole\\Config\\ConfigServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
        {"type":"Method","fromName":"Coole\\Config\\ConfigServiceProvider","fromLink":"Coole/Config/ConfigServiceProvider.html","link":"Coole/Config/ConfigServiceProvider.html#method_afterRegister","name":"Coole\\Config\\ConfigServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Console","fromLink":"Coole/Console.html","link":"Coole/Console/Application.html","name":"Coole\\Console\\Application","doc":"<pre><code class=\"language-php\">\nuse Coole\\Console\\Application;.</code></pre>"},
                                {"type":"Method","fromName":"Coole\\Console\\Application","fromLink":"Coole/Console/Application.html","link":"Coole/Console/Application.html#method___construct","name":"Coole\\Console\\Application::__construct","doc":null},
        {"type":"Method","fromName":"Coole\\Console\\Application","fromLink":"Coole/Console/Application.html","link":"Coole/Console/Application.html#method_doRun","name":"Coole\\Console\\Application::doRun","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Coole\\Console\\Application","fromLink":"Coole/Console/Application.html","link":"Coole/Console/Application.html#method_getHelp","name":"Coole\\Console\\Application::getHelp","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Console","fromLink":"Coole/Console.html","link":"Coole/Console/Command.html","name":"Coole\\Console\\Command","doc":null},
                                {"type":"Method","fromName":"Coole\\Console\\Command","fromLink":"Coole/Console/Command.html","link":"Coole/Console/Command.html#method___construct","name":"Coole\\Console\\Command::__construct","doc":null},
        {"type":"Method","fromName":"Coole\\Console\\Command","fromLink":"Coole/Console/Command.html","link":"Coole/Console/Command.html#method_initialize","name":"Coole\\Console\\Command::initialize","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Coole\\Console\\Command","fromLink":"Coole/Console/Command.html","link":"Coole/Console/Command.html#method_specifyParameters","name":"Coole\\Console\\Command::specifyParameters","doc":"<p>添加参数和选项.</p>"},
        {"type":"Method","fromName":"Coole\\Console\\Command","fromLink":"Coole/Console/Command.html","link":"Coole/Console/Command.html#method_getArguments","name":"Coole\\Console\\Command::getArguments","doc":"<p>获取参数.</p>"},
        {"type":"Method","fromName":"Coole\\Console\\Command","fromLink":"Coole/Console/Command.html","link":"Coole/Console/Command.html#method_getOptions","name":"Coole\\Console\\Command::getOptions","doc":"<p>获取选项.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Console","fromLink":"Coole/Console.html","link":"Coole/Console/CommandDiscoverer.html","name":"Coole\\Console\\CommandDiscoverer","doc":null},
                                {"type":"Method","fromName":"Coole\\Console\\CommandDiscoverer","fromLink":"Coole/Console/CommandDiscoverer.html","link":"Coole/Console/CommandDiscoverer.html#method___construct","name":"Coole\\Console\\CommandDiscoverer::__construct","doc":null},
        {"type":"Method","fromName":"Coole\\Console\\CommandDiscoverer","fromLink":"Coole/Console/CommandDiscoverer.html","link":"Coole/Console/CommandDiscoverer.html#method_getCommands","name":"Coole\\Console\\CommandDiscoverer::getCommands","doc":"<p>获取命令.</p>"},
        {"type":"Method","fromName":"Coole\\Console\\CommandDiscoverer","fromLink":"Coole/Console/CommandDiscoverer.html","link":"Coole/Console/CommandDiscoverer.html#method_getDir","name":"Coole\\Console\\CommandDiscoverer::getDir","doc":"<p>获取目录.</p>"},
        {"type":"Method","fromName":"Coole\\Console\\CommandDiscoverer","fromLink":"Coole/Console/CommandDiscoverer.html","link":"Coole/Console/CommandDiscoverer.html#method_setDir","name":"Coole\\Console\\CommandDiscoverer::setDir","doc":"<p>设置目录.</p>"},
        {"type":"Method","fromName":"Coole\\Console\\CommandDiscoverer","fromLink":"Coole/Console/CommandDiscoverer.html","link":"Coole/Console/CommandDiscoverer.html#method_getNamespace","name":"Coole\\Console\\CommandDiscoverer::getNamespace","doc":"<p>获取命名空间.</p>"},
        {"type":"Method","fromName":"Coole\\Console\\CommandDiscoverer","fromLink":"Coole/Console/CommandDiscoverer.html","link":"Coole/Console/CommandDiscoverer.html#method_setNamespace","name":"Coole\\Console\\CommandDiscoverer::setNamespace","doc":"<p>设置命名空间.</p>"},
        {"type":"Method","fromName":"Coole\\Console\\CommandDiscoverer","fromLink":"Coole/Console/CommandDiscoverer.html","link":"Coole/Console/CommandDiscoverer.html#method_getSuffix","name":"Coole\\Console\\CommandDiscoverer::getSuffix","doc":"<p>获取后缀</p>"},
        {"type":"Method","fromName":"Coole\\Console\\CommandDiscoverer","fromLink":"Coole/Console/CommandDiscoverer.html","link":"Coole/Console/CommandDiscoverer.html#method_setSuffix","name":"Coole\\Console\\CommandDiscoverer::setSuffix","doc":"<p>设置后缀</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Console\\Commands","fromLink":"Coole/Console/Commands.html","link":"Coole/Console/Commands/ServeCommand.html","name":"Coole\\Console\\Commands\\ServeCommand","doc":null},
                                {"type":"Method","fromName":"Coole\\Console\\Commands\\ServeCommand","fromLink":"Coole/Console/Commands/ServeCommand.html","link":"Coole/Console/Commands/ServeCommand.html#method_execute","name":"Coole\\Console\\Commands\\ServeCommand::execute","doc":null},
        {"type":"Method","fromName":"Coole\\Console\\Commands\\ServeCommand","fromLink":"Coole/Console/Commands/ServeCommand.html","link":"Coole/Console/Commands/ServeCommand.html#method_serverCommand","name":"Coole\\Console\\Commands\\ServeCommand::serverCommand","doc":null},
            
                                                {"type":"Class","fromName":"Coole\\Console","fromLink":"Coole/Console.html","link":"Coole/Console/ConsoleServiceProvider.html","name":"Coole\\Console\\ConsoleServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\Console\\ConsoleServiceProvider","fromLink":"Coole/Console/ConsoleServiceProvider.html","link":"Coole/Console/ConsoleServiceProvider.html#method_beforeRegister","name":"Coole\\Console\\ConsoleServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Coole\\Console\\ConsoleServiceProvider","fromLink":"Coole/Console/ConsoleServiceProvider.html","link":"Coole/Console/ConsoleServiceProvider.html#method_register","name":"Coole\\Console\\ConsoleServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
        {"type":"Method","fromName":"Coole\\Console\\ConsoleServiceProvider","fromLink":"Coole/Console/ConsoleServiceProvider.html","link":"Coole/Console/ConsoleServiceProvider.html#method_afterRegister","name":"Coole\\Console\\ConsoleServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\DB","fromLink":"Coole/DB.html","link":"Coole/DB/DBServiceProvider.html","name":"Coole\\DB\\DBServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\DB\\DBServiceProvider","fromLink":"Coole/DB/DBServiceProvider.html","link":"Coole/DB/DBServiceProvider.html#method_beforeRegister","name":"Coole\\DB\\DBServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Coole\\DB\\DBServiceProvider","fromLink":"Coole/DB/DBServiceProvider.html","link":"Coole/DB/DBServiceProvider.html#method_register","name":"Coole\\DB\\DBServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
        {"type":"Method","fromName":"Coole\\DB\\DBServiceProvider","fromLink":"Coole/DB/DBServiceProvider.html","link":"Coole/DB/DBServiceProvider.html#method_boot","name":"Coole\\DB\\DBServiceProvider::boot","doc":"<p>引导应用程序.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\DB\\Facades","fromLink":"Coole/DB/Facades.html","link":"Coole/DB/Facades/DB.html","name":"Coole\\DB\\Facades\\DB","doc":""},
                                {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_getFacadeAccessor","name":"Coole\\DB\\Facades\\DB::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_connection","name":"Coole\\DB\\Facades\\DB::connection","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_table","name":"Coole\\DB\\Facades\\DB::table","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_raw","name":"Coole\\DB\\Facades\\DB::raw","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_prepareBindings","name":"Coole\\DB\\Facades\\DB::prepareBindings","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_pretend","name":"Coole\\DB\\Facades\\DB::pretend","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_select","name":"Coole\\DB\\Facades\\DB::select","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_insert","name":"Coole\\DB\\Facades\\DB::insert","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_statement","name":"Coole\\DB\\Facades\\DB::statement","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_unprepared","name":"Coole\\DB\\Facades\\DB::unprepared","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_affectingStatement","name":"Coole\\DB\\Facades\\DB::affectingStatement","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_delete","name":"Coole\\DB\\Facades\\DB::delete","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_transactionLevel","name":"Coole\\DB\\Facades\\DB::transactionLevel","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_update","name":"Coole\\DB\\Facades\\DB::update","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_selectOne","name":"Coole\\DB\\Facades\\DB::selectOne","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_transaction","name":"Coole\\DB\\Facades\\DB::transaction","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_getDefaultConnection","name":"Coole\\DB\\Facades\\DB::getDefaultConnection","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_beginTransaction","name":"Coole\\DB\\Facades\\DB::beginTransaction","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_commit","name":"Coole\\DB\\Facades\\DB::commit","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_listen","name":"Coole\\DB\\Facades\\DB::listen","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_rollBack","name":"Coole\\DB\\Facades\\DB::rollBack","doc":""},
        {"type":"Method","fromName":"Coole\\DB\\Facades\\DB","fromLink":"Coole/DB/Facades/DB.html","link":"Coole/DB/Facades/DB.html#method_setDefaultConnection","name":"Coole\\DB\\Facades\\DB::setDefaultConnection","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\DB","fromLink":"Coole/DB.html","link":"Coole/DB/Model.html","name":"Coole\\DB\\Model","doc":null},
                
                                                {"type":"Class","fromName":"Coole\\ErrorHandler","fromLink":"Coole/ErrorHandler.html","link":"Coole/ErrorHandler/ErrorHandlerServiceProvider.html","name":"Coole\\ErrorHandler\\ErrorHandlerServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\ErrorHandler\\ErrorHandlerServiceProvider","fromLink":"Coole/ErrorHandler/ErrorHandlerServiceProvider.html","link":"Coole/ErrorHandler/ErrorHandlerServiceProvider.html#method_register","name":"Coole\\ErrorHandler\\ErrorHandlerServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
        {"type":"Method","fromName":"Coole\\ErrorHandler\\ErrorHandlerServiceProvider","fromLink":"Coole/ErrorHandler/ErrorHandlerServiceProvider.html","link":"Coole/ErrorHandler/ErrorHandlerServiceProvider.html#method_afterRegister","name":"Coole\\ErrorHandler\\ErrorHandlerServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
        {"type":"Method","fromName":"Coole\\ErrorHandler\\ErrorHandlerServiceProvider","fromLink":"Coole/ErrorHandler/ErrorHandlerServiceProvider.html","link":"Coole/ErrorHandler/ErrorHandlerServiceProvider.html#method_boot","name":"Coole\\ErrorHandler\\ErrorHandlerServiceProvider::boot","doc":"<p>引导应用程序.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Event","fromLink":"Coole/Event.html","link":"Coole/Event/Event.html","name":"Coole\\Event\\Event","doc":null},
                                {"type":"Method","fromName":"Coole\\Event\\Event","fromLink":"Coole/Event/Event.html","link":"Coole/Event/Event.html#method_getName","name":"Coole\\Event\\Event::getName","doc":"<p>获取事件名称.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Event","fromLink":"Coole/Event.html","link":"Coole/Event/EventServiceProvider.html","name":"Coole\\Event\\EventServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\Event\\EventServiceProvider","fromLink":"Coole/Event/EventServiceProvider.html","link":"Coole/Event/EventServiceProvider.html#method_register","name":"Coole\\Event\\EventServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
        {"type":"Method","fromName":"Coole\\Event\\EventServiceProvider","fromLink":"Coole/Event/EventServiceProvider.html","link":"Coole/Event/EventServiceProvider.html#method_afterRegister","name":"Coole\\Event\\EventServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Event","fromLink":"Coole/Event.html","link":"Coole/Event/ListenerInterface.html","name":"Coole\\Event\\ListenerInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Event\\ListenerInterface","fromLink":"Coole/Event/ListenerInterface.html","link":"Coole/Event/ListenerInterface.html#method_handle","name":"Coole\\Event\\ListenerInterface::handle","doc":"<p>事件处理.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/AfterRegisterAbleProviderInterface.html","name":"Coole\\Foundation\\Able\\AfterRegisterAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\AfterRegisterAbleProviderInterface","fromLink":"Coole/Foundation/Able/AfterRegisterAbleProviderInterface.html","link":"Coole/Foundation/Able/AfterRegisterAbleProviderInterface.html#method_afterRegister","name":"Coole\\Foundation\\Able\\AfterRegisterAbleProviderInterface::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/BeforeRegisterAbleProviderInterface.html","name":"Coole\\Foundation\\Able\\BeforeRegisterAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\BeforeRegisterAbleProviderInterface","fromLink":"Coole/Foundation/Able/BeforeRegisterAbleProviderInterface.html","link":"Coole/Foundation/Able/BeforeRegisterAbleProviderInterface.html#method_beforeRegister","name":"Coole\\Foundation\\Able\\BeforeRegisterAbleProviderInterface::beforeRegister","doc":"<p>注册服务之前.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/BootAbleProviderInterface.html","name":"Coole\\Foundation\\Able\\BootAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\BootAbleProviderInterface","fromLink":"Coole/Foundation/Able/BootAbleProviderInterface.html","link":"Coole/Foundation/Able/BootAbleProviderInterface.html#method_boot","name":"Coole\\Foundation\\Able\\BootAbleProviderInterface::boot","doc":"<p>引导应用程序.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/ServiceProvider.html","name":"Coole\\Foundation\\Able\\ServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\ServiceProvider","fromLink":"Coole/Foundation/Able/ServiceProvider.html","link":"Coole/Foundation/Able/ServiceProvider.html#method_beforeRegister","name":"Coole\\Foundation\\Able\\ServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\Able\\ServiceProvider","fromLink":"Coole/Foundation/Able/ServiceProvider.html","link":"Coole/Foundation/Able/ServiceProvider.html#method_register","name":"Coole\\Foundation\\Able\\ServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\Able\\ServiceProvider","fromLink":"Coole/Foundation/Able/ServiceProvider.html","link":"Coole/Foundation/Able/ServiceProvider.html#method_afterRegister","name":"Coole\\Foundation\\Able\\ServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\Able\\ServiceProvider","fromLink":"Coole/Foundation/Able/ServiceProvider.html","link":"Coole/Foundation/Able/ServiceProvider.html#method_boot","name":"Coole\\Foundation\\Able\\ServiceProvider::boot","doc":"<p>引导应用程序.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\Able\\ServiceProvider","fromLink":"Coole/Foundation/Able/ServiceProvider.html","link":"Coole/Foundation/Able/ServiceProvider.html#method_subscribe","name":"Coole\\Foundation\\Able\\ServiceProvider::subscribe","doc":"<p>服务订阅事件.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/ServiceProviderInterface.html","name":"Coole\\Foundation\\Able\\ServiceProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\ServiceProviderInterface","fromLink":"Coole/Foundation/Able/ServiceProviderInterface.html","link":"Coole/Foundation/Able/ServiceProviderInterface.html#method_register","name":"Coole\\Foundation\\Able\\ServiceProviderInterface::register","doc":"<p>Registers services on the given container.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Able","fromLink":"Coole/Foundation/Able.html","link":"Coole/Foundation/Able/SubscribeEventAbleProviderInterface.html","name":"Coole\\Foundation\\Able\\SubscribeEventAbleProviderInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Able\\SubscribeEventAbleProviderInterface","fromLink":"Coole/Foundation/Able/SubscribeEventAbleProviderInterface.html","link":"Coole/Foundation/Able/SubscribeEventAbleProviderInterface.html#method_subscribe","name":"Coole\\Foundation\\Able\\SubscribeEventAbleProviderInterface::subscribe","doc":"<p>服务订阅事件.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation","fromLink":"Coole/Foundation.html","link":"Coole/Foundation/App.html","name":"Coole\\Foundation\\App","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method___construct","name":"Coole\\Foundation\\App::__construct","doc":null},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_register","name":"Coole\\Foundation\\App::register","doc":"<p>注册服务.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_addOptions","name":"Coole\\Foundation\\App::addOptions","doc":"<p>添加全局配置.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_version","name":"Coole\\Foundation\\App::version","doc":"<p>获取版本号.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_loadEnv","name":"Coole\\Foundation\\App::loadEnv","doc":"<p>加载 env.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_loadConfig","name":"Coole\\Foundation\\App::loadConfig","doc":"<p>加载配置.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_loadRoute","name":"Coole\\Foundation\\App::loadRoute","doc":"<p>加载路由.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_loadCommand","name":"Coole\\Foundation\\App::loadCommand","doc":"<p>加载命令.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_setOptions","name":"Coole\\Foundation\\App::setOptions","doc":"<p>设置全局配置.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_mergeConfig","name":"Coole\\Foundation\\App::mergeConfig","doc":"<p>合并配置.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_addConfig","name":"Coole\\Foundation\\App::addConfig","doc":"<p>添加配置.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_registerProviders","name":"Coole\\Foundation\\App::registerProviders","doc":"<p>批量注册服务.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_run","name":"Coole\\Foundation\\App::run","doc":"<p>启动运行服务.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_boot","name":"Coole\\Foundation\\App::boot","doc":"<p>引导应用程序.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_sendRequestThroughPipeline","name":"Coole\\Foundation\\App::sendRequestThroughPipeline","doc":"<p>通过管道发送响应.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_handle","name":"Coole\\Foundation\\App::handle","doc":"<p>处理请求为响应且发送响应.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_terminate","name":"Coole\\Foundation\\App::terminate","doc":"<p>终止请求/响应生命周期.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_makeMiddleware","name":"Coole\\Foundation\\App::makeMiddleware","doc":"<p>批量实例化中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_getCurrentRequestShouldExecutedMiddleware","name":"Coole\\Foundation\\App::getCurrentRequestShouldExecutedMiddleware","doc":"<p>获取当前请求应该被执行的中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_getCurrentRequestExcludedMiddleware","name":"Coole\\Foundation\\App::getCurrentRequestExcludedMiddleware","doc":"<p>获取当前请求排除中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_getCurrentRequestMiddleware","name":"Coole\\Foundation\\App::getCurrentRequestMiddleware","doc":"<p>获取当前请求中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_getControllerExcludedMiddleware","name":"Coole\\Foundation\\App::getControllerExcludedMiddleware","doc":"<p>获取控制器排除中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_getRouteExcludedMiddleware","name":"Coole\\Foundation\\App::getRouteExcludedMiddleware","doc":"<p>获取路由排除中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_getControllerMiddleware","name":"Coole\\Foundation\\App::getControllerMiddleware","doc":"<p>获取控制器中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_getRouteMiddleware","name":"Coole\\Foundation\\App::getRouteMiddleware","doc":"<p>获取路由中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_getCurrentRoute","name":"Coole\\Foundation\\App::getCurrentRoute","doc":"<p>获取当前路由.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\App","fromLink":"Coole/Foundation/App.html","link":"Coole/Foundation/App.html#method_getCurrentController","name":"Coole\\Foundation\\App::getCurrentController","doc":"<p>获取当前控制器.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation","fromLink":"Coole/Foundation.html","link":"Coole/Foundation/AppServiceProvider.html","name":"Coole\\Foundation\\AppServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\AppServiceProvider","fromLink":"Coole/Foundation/AppServiceProvider.html","link":"Coole/Foundation/AppServiceProvider.html#method_beforeRegister","name":"Coole\\Foundation\\AppServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\AppServiceProvider","fromLink":"Coole/Foundation/AppServiceProvider.html","link":"Coole/Foundation/AppServiceProvider.html#method_setUpConfig","name":"Coole\\Foundation\\AppServiceProvider::setUpConfig","doc":"<p>设置配置.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\AppServiceProvider","fromLink":"Coole/Foundation/AppServiceProvider.html","link":"Coole/Foundation/AppServiceProvider.html#method_register","name":"Coole\\Foundation\\AppServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\AppServiceProvider","fromLink":"Coole/Foundation/AppServiceProvider.html","link":"Coole/Foundation/AppServiceProvider.html#method_subscribe","name":"Coole\\Foundation\\AppServiceProvider::subscribe","doc":"<p>服务订阅事件.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Exceptions","fromLink":"Coole/Foundation/Exceptions.html","link":"Coole/Foundation/Exceptions/InvalidClassException.html","name":"Coole\\Foundation\\Exceptions\\InvalidClassException","doc":null},
                
                                                {"type":"Class","fromName":"Coole\\Foundation\\Exceptions","fromLink":"Coole/Foundation/Exceptions.html","link":"Coole/Foundation/Exceptions/UnknownFileException.html","name":"Coole\\Foundation\\Exceptions\\UnknownFileException","doc":null},
                
                                                {"type":"Class","fromName":"Coole\\Foundation\\Facades","fromLink":"Coole/Foundation/Facades.html","link":"Coole/Foundation/Facades/App.html","name":"Coole\\Foundation\\Facades\\App","doc":""},
                                {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_getFacadeAccessor","name":"Coole\\Foundation\\Facades\\App::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_register","name":"Coole\\Foundation\\Facades\\App::register","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_addOptions","name":"Coole\\Foundation\\Facades\\App::addOptions","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_version","name":"Coole\\Foundation\\Facades\\App::version","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_loadEnv","name":"Coole\\Foundation\\Facades\\App::loadEnv","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_loadConfig","name":"Coole\\Foundation\\Facades\\App::loadConfig","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_loadRoute","name":"Coole\\Foundation\\Facades\\App::loadRoute","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_loadCommand","name":"Coole\\Foundation\\Facades\\App::loadCommand","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_setOptions","name":"Coole\\Foundation\\Facades\\App::setOptions","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_mergeConfig","name":"Coole\\Foundation\\Facades\\App::mergeConfig","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_addConfig","name":"Coole\\Foundation\\Facades\\App::addConfig","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_registerProviders","name":"Coole\\Foundation\\Facades\\App::registerProviders","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_makeMiddleware","name":"Coole\\Foundation\\Facades\\App::makeMiddleware","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_getCurrentRequestShouldExecutedMiddleware","name":"Coole\\Foundation\\Facades\\App::getCurrentRequestShouldExecutedMiddleware","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_getControllerShouldExecutedMiddleware","name":"Coole\\Foundation\\Facades\\App::getControllerShouldExecutedMiddleware","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_getRouteShouldExecutedMiddleware","name":"Coole\\Foundation\\Facades\\App::getRouteShouldExecutedMiddleware","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_render","name":"Coole\\Foundation\\Facades\\App::render","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_redirect","name":"Coole\\Foundation\\Facades\\App::redirect","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_abort","name":"Coole\\Foundation\\Facades\\App::abort","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_stream","name":"Coole\\Foundation\\Facades\\App::stream","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_json","name":"Coole\\Foundation\\Facades\\App::json","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_sendFile","name":"Coole\\Foundation\\Facades\\App::sendFile","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_getMiddleware","name":"Coole\\Foundation\\Facades\\App::getMiddleware","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_setMiddleware","name":"Coole\\Foundation\\Facades\\App::setMiddleware","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_addMiddleware","name":"Coole\\Foundation\\Facades\\App::addMiddleware","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_addFinishHandler","name":"Coole\\Foundation\\Facades\\App::addFinishHandler","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_make","name":"Coole\\Foundation\\Facades\\App::make","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_makeWith","name":"Coole\\Foundation\\Facades\\App::makeWith","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_build","name":"Coole\\Foundation\\Facades\\App::build","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_refresh","name":"Coole\\Foundation\\Facades\\App::refresh","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_rebinding","name":"Coole\\Foundation\\Facades\\App::rebinding","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_bindIf","name":"Coole\\Foundation\\Facades\\App::bindIf","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_singleton","name":"Coole\\Foundation\\Facades\\App::singleton","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_bind","name":"Coole\\Foundation\\Facades\\App::bind","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_extend","name":"Coole\\Foundation\\Facades\\App::extend","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_call","name":"Coole\\Foundation\\Facades\\App::call","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_alias","name":"Coole\\Foundation\\Facades\\App::alias","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_tag","name":"Coole\\Foundation\\Facades\\App::tag","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_tagged","name":"Coole\\Foundation\\Facades\\App::tagged","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_factory","name":"Coole\\Foundation\\Facades\\App::factory","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_wrap","name":"Coole\\Foundation\\Facades\\App::wrap","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_has","name":"Coole\\Foundation\\Facades\\App::has","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\App","fromLink":"Coole/Foundation/Facades/App.html","link":"Coole/Foundation/Facades/App.html#method_get","name":"Coole\\Foundation\\Facades\\App::get","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Facades","fromLink":"Coole/Foundation/Facades.html","link":"Coole/Foundation/Facades/Facade.html","name":"Coole\\Foundation\\Facades\\Facade","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Facades\\Facade","fromLink":"Coole/Foundation/Facades/Facade.html","link":"Coole/Foundation/Facades/Facade.html#method_getFacadeRoot","name":"Coole\\Foundation\\Facades\\Facade::getFacadeRoot","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\Facade","fromLink":"Coole/Foundation/Facades/Facade.html","link":"Coole/Foundation/Facades/Facade.html#method_getFacadeAccessor","name":"Coole\\Foundation\\Facades\\Facade::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\Facade","fromLink":"Coole/Foundation/Facades/Facade.html","link":"Coole/Foundation/Facades/Facade.html#method_resolveFacadeInstance","name":"Coole\\Foundation\\Facades\\Facade::resolveFacadeInstance","doc":"<p>解析门面实例.</p>"},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\Facade","fromLink":"Coole/Foundation/Facades/Facade.html","link":"Coole/Foundation/Facades/Facade.html#method_getFacadeApplication","name":"Coole\\Foundation\\Facades\\Facade::getFacadeApplication","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\Facade","fromLink":"Coole/Foundation/Facades/Facade.html","link":"Coole/Foundation/Facades/Facade.html#method_setFacadeApplication","name":"Coole\\Foundation\\Facades\\Facade::setFacadeApplication","doc":""},
        {"type":"Method","fromName":"Coole\\Foundation\\Facades\\Facade","fromLink":"Coole/Foundation/Facades/Facade.html","link":"Coole/Foundation/Facades/Facade.html#method___callStatic","name":"Coole\\Foundation\\Facades\\Facade::__callStatic","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Listeners","fromLink":"Coole/Foundation/Listeners.html","link":"Coole/Foundation/Listeners/LogListener.html","name":"Coole\\Foundation\\Listeners\\LogListener","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Listeners\\LogListener","fromLink":"Coole/Foundation/Listeners/LogListener.html","link":"Coole/Foundation/Listeners/LogListener.html#method___construct","name":"Coole\\Foundation\\Listeners\\LogListener::__construct","doc":null},
        {"type":"Method","fromName":"Coole\\Foundation\\Listeners\\LogListener","fromLink":"Coole/Foundation/Listeners/LogListener.html","link":"Coole/Foundation/Listeners/LogListener.html#method_onKernelRequest","name":"Coole\\Foundation\\Listeners\\LogListener::onKernelRequest","doc":null},
        {"type":"Method","fromName":"Coole\\Foundation\\Listeners\\LogListener","fromLink":"Coole/Foundation/Listeners/LogListener.html","link":"Coole/Foundation/Listeners/LogListener.html#method_onKernelResponse","name":"Coole\\Foundation\\Listeners\\LogListener::onKernelResponse","doc":null},
        {"type":"Method","fromName":"Coole\\Foundation\\Listeners\\LogListener","fromLink":"Coole/Foundation/Listeners/LogListener.html","link":"Coole/Foundation/Listeners/LogListener.html#method_onKernelException","name":"Coole\\Foundation\\Listeners\\LogListener::onKernelException","doc":null},
        {"type":"Method","fromName":"Coole\\Foundation\\Listeners\\LogListener","fromLink":"Coole/Foundation/Listeners/LogListener.html","link":"Coole/Foundation/Listeners/LogListener.html#method_getSubscribedEvents","name":"Coole\\Foundation\\Listeners\\LogListener::getSubscribedEvents","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Listeners","fromLink":"Coole/Foundation/Listeners.html","link":"Coole/Foundation/Listeners/NullResponseListener.html","name":"Coole\\Foundation\\Listeners\\NullResponseListener","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Listeners\\NullResponseListener","fromLink":"Coole/Foundation/Listeners/NullResponseListener.html","link":"Coole/Foundation/Listeners/NullResponseListener.html#method_onKernelView","name":"Coole\\Foundation\\Listeners\\NullResponseListener::onKernelView","doc":null},
        {"type":"Method","fromName":"Coole\\Foundation\\Listeners\\NullResponseListener","fromLink":"Coole/Foundation/Listeners/NullResponseListener.html","link":"Coole/Foundation/Listeners/NullResponseListener.html#method_getSubscribedEvents","name":"Coole\\Foundation\\Listeners\\NullResponseListener::getSubscribedEvents","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Listeners","fromLink":"Coole/Foundation/Listeners.html","link":"Coole/Foundation/Listeners/StringResponseListener.html","name":"Coole\\Foundation\\Listeners\\StringResponseListener","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Listeners\\StringResponseListener","fromLink":"Coole/Foundation/Listeners/StringResponseListener.html","link":"Coole/Foundation/Listeners/StringResponseListener.html#method_onKernelView","name":"Coole\\Foundation\\Listeners\\StringResponseListener::onKernelView","doc":null},
        {"type":"Method","fromName":"Coole\\Foundation\\Listeners\\StringResponseListener","fromLink":"Coole/Foundation/Listeners/StringResponseListener.html","link":"Coole/Foundation/Listeners/StringResponseListener.html#method_getSubscribedEvents","name":"Coole\\Foundation\\Listeners\\StringResponseListener::getSubscribedEvents","doc":"<p>{@inheritdoc}</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Middlewares","fromLink":"Coole/Foundation/Middlewares.html","link":"Coole/Foundation/Middlewares/CheckResponseForModifications.html","name":"Coole\\Foundation\\Middlewares\\CheckResponseForModifications","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Middlewares\\CheckResponseForModifications","fromLink":"Coole/Foundation/Middlewares/CheckResponseForModifications.html","link":"Coole/Foundation/Middlewares/CheckResponseForModifications.html#method_handle","name":"Coole\\Foundation\\Middlewares\\CheckResponseForModifications::handle","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\Foundation\\Middlewares","fromLink":"Coole/Foundation/Middlewares.html","link":"Coole/Foundation/Middlewares/MiddlewareInterface.html","name":"Coole\\Foundation\\Middlewares\\MiddlewareInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\Foundation\\Middlewares\\MiddlewareInterface","fromLink":"Coole/Foundation/Middlewares/MiddlewareInterface.html","link":"Coole/Foundation/Middlewares/MiddlewareInterface.html#method_handle","name":"Coole\\Foundation\\Middlewares\\MiddlewareInterface::handle","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\HttpKernel\\Controller","fromLink":"Coole/HttpKernel/Controller.html","link":"Coole/HttpKernel/Controller/Controller.html","name":"Coole\\HttpKernel\\Controller\\Controller","doc":null},
                
                                                {"type":"Class","fromName":"Coole\\HttpKernel\\Controller","fromLink":"Coole/HttpKernel/Controller.html","link":"Coole/HttpKernel/Controller/ControllerInterface.html","name":"Coole\\HttpKernel\\Controller\\ControllerInterface","doc":null},
                                {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\ControllerInterface","fromLink":"Coole/HttpKernel/Controller/ControllerInterface.html","link":"Coole/HttpKernel/Controller/ControllerInterface.html#method_render","name":"Coole\\HttpKernel\\Controller\\ControllerInterface::render","doc":"<p>渲染模板</p>"},
            
                                                {"type":"Class","fromName":"Coole\\HttpKernel\\Controller","fromLink":"Coole/HttpKernel/Controller.html","link":"Coole/HttpKernel/Controller/ControllerResolver.html","name":"Coole\\HttpKernel\\Controller\\ControllerResolver","doc":null},
                                {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\ControllerResolver","fromLink":"Coole/HttpKernel/Controller/ControllerResolver.html","link":"Coole/HttpKernel/Controller/ControllerResolver.html#method_instantiateController","name":"Coole\\HttpKernel\\Controller\\ControllerResolver::instantiateController","doc":"<p>{@inheritDoc}</p>"},
            
                                                {"type":"Trait","fromName":"Coole\\HttpKernel\\Controller","fromLink":"Coole/HttpKernel/Controller.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html","name":"Coole\\HttpKernel\\Controller\\HasControllerAble","doc":null},
                                {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_render","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::render","doc":"<p>{@inheritdoc}</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_redirect","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::redirect","doc":"<p>重定 url.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_abort","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::abort","doc":"<p>抛出 http 异常.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_stream","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::stream","doc":"<p>返回流响应.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_json","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::json","doc":"<p>返回 json 响应.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_sendFile","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::sendFile","doc":"<p>返回二进制文件响应.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_getMiddleware","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::getMiddleware","doc":"<p>获取中间件.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_setMiddleware","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::setMiddleware","doc":"<p>设置中间件.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_addMiddleware","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::addMiddleware","doc":"<p>添加中间件.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_getExcludedMiddleware","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::getExcludedMiddleware","doc":"<p>获取排除的中间件.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_withoutMiddleware","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::withoutMiddleware","doc":"<p>排除中间件.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_setExcludedMiddleware","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::setExcludedMiddleware","doc":"<p>设置排除的中间件.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_addExcludedMiddleware","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::addExcludedMiddleware","doc":"<p>添加排除的中间件.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_addFinishHandler","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::addFinishHandler","doc":"<p>添加一个 <code>KernelEvents::TERMINATE</code> 事件监听处理器.</p>"},
        {"type":"Method","fromName":"Coole\\HttpKernel\\Controller\\HasControllerAble","fromLink":"Coole/HttpKernel/Controller/HasControllerAble.html","link":"Coole/HttpKernel/Controller/HasControllerAble.html#method_setFinishHandler","name":"Coole\\HttpKernel\\Controller\\HasControllerAble::setFinishHandler","doc":"<p>设置一个 <code>KernelEvents::TERMINATE</code> 事件监听处理器.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\HttpKernel","fromLink":"Coole/HttpKernel.html","link":"Coole/HttpKernel/HttpKernelServiceProvider.html","name":"Coole\\HttpKernel\\HttpKernelServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\HttpKernel\\HttpKernelServiceProvider","fromLink":"Coole/HttpKernel/HttpKernelServiceProvider.html","link":"Coole/HttpKernel/HttpKernelServiceProvider.html#method_register","name":"Coole\\HttpKernel\\HttpKernelServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Invoker\\Facades","fromLink":"Coole/Invoker/Facades.html","link":"Coole/Invoker/Facades/Invoker.html","name":"Coole\\Invoker\\Facades\\Invoker","doc":""},
                                {"type":"Method","fromName":"Coole\\Invoker\\Facades\\Invoker","fromLink":"Coole/Invoker/Facades/Invoker.html","link":"Coole/Invoker/Facades/Invoker.html#method_getFacadeAccessor","name":"Coole\\Invoker\\Facades\\Invoker::getFacadeAccessor","doc":null},
        {"type":"Method","fromName":"Coole\\Invoker\\Facades\\Invoker","fromLink":"Coole/Invoker/Facades/Invoker.html","link":"Coole/Invoker/Facades/Invoker.html#method_call","name":"Coole\\Invoker\\Facades\\Invoker::call","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\Invoker","fromLink":"Coole/Invoker.html","link":"Coole/Invoker/InvokerServiceProvider.html","name":"Coole\\Invoker\\InvokerServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\Invoker\\InvokerServiceProvider","fromLink":"Coole/Invoker/InvokerServiceProvider.html","link":"Coole/Invoker/InvokerServiceProvider.html#method_register","name":"Coole\\Invoker\\InvokerServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Log\\Facades","fromLink":"Coole/Log/Facades.html","link":"Coole/Log/Facades/Log.html","name":"Coole\\Log\\Facades\\Log","doc":""},
                                {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_getFacadeAccessor","name":"Coole\\Log\\Facades\\Log::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_log","name":"Coole\\Log\\Facades\\Log::log","doc":""},
        {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_debug","name":"Coole\\Log\\Facades\\Log::debug","doc":""},
        {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_info","name":"Coole\\Log\\Facades\\Log::info","doc":""},
        {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_notice","name":"Coole\\Log\\Facades\\Log::notice","doc":""},
        {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_warning","name":"Coole\\Log\\Facades\\Log::warning","doc":""},
        {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_error","name":"Coole\\Log\\Facades\\Log::error","doc":""},
        {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_critical","name":"Coole\\Log\\Facades\\Log::critical","doc":""},
        {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_alert","name":"Coole\\Log\\Facades\\Log::alert","doc":""},
        {"type":"Method","fromName":"Coole\\Log\\Facades\\Log","fromLink":"Coole/Log/Facades/Log.html","link":"Coole/Log/Facades/Log.html#method_emergency","name":"Coole\\Log\\Facades\\Log::emergency","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\Log","fromLink":"Coole/Log.html","link":"Coole/Log/LogServiceProvider.html","name":"Coole\\Log\\LogServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\Log\\LogServiceProvider","fromLink":"Coole/Log/LogServiceProvider.html","link":"Coole/Log/LogServiceProvider.html#method_beforeRegister","name":"Coole\\Log\\LogServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Coole\\Log\\LogServiceProvider","fromLink":"Coole/Log/LogServiceProvider.html","link":"Coole/Log/LogServiceProvider.html#method_register","name":"Coole\\Log\\LogServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
        {"type":"Method","fromName":"Coole\\Log\\LogServiceProvider","fromLink":"Coole/Log/LogServiceProvider.html","link":"Coole/Log/LogServiceProvider.html#method_subscribe","name":"Coole\\Log\\LogServiceProvider::subscribe","doc":"<p>服务订阅事件.</p>"},
        {"type":"Method","fromName":"Coole\\Log\\LogServiceProvider","fromLink":"Coole/Log/LogServiceProvider.html","link":"Coole/Log/LogServiceProvider.html#method_boot","name":"Coole\\Log\\LogServiceProvider::boot","doc":"<p>引导应用程序.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Routing\\Facades","fromLink":"Coole/Routing/Facades.html","link":"Coole/Routing/Facades/Router.html","name":"Coole\\Routing\\Facades\\Router","doc":""},
                                {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_getFacadeAccessor","name":"Coole\\Routing\\Facades\\Router::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_any","name":"Coole\\Routing\\Facades\\Router::any","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_delete","name":"Coole\\Routing\\Facades\\Router::delete","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_get","name":"Coole\\Routing\\Facades\\Router::get","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_match","name":"Coole\\Routing\\Facades\\Router::match","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_options","name":"Coole\\Routing\\Facades\\Router::options","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_patch","name":"Coole\\Routing\\Facades\\Router::patch","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_post","name":"Coole\\Routing\\Facades\\Router::post","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_put","name":"Coole\\Routing\\Facades\\Router::put","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setPath","name":"Coole\\Routing\\Facades\\Router::setPath","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setHost","name":"Coole\\Routing\\Facades\\Router::setHost","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setSchemes","name":"Coole\\Routing\\Facades\\Router::setSchemes","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setMethods","name":"Coole\\Routing\\Facades\\Router::setMethods","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setOptions","name":"Coole\\Routing\\Facades\\Router::setOptions","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setOption","name":"Coole\\Routing\\Facades\\Router::setOption","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setDefaults","name":"Coole\\Routing\\Facades\\Router::setDefaults","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setDefault","name":"Coole\\Routing\\Facades\\Router::setDefault","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setRequirements","name":"Coole\\Routing\\Facades\\Router::setRequirements","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setRequirement","name":"Coole\\Routing\\Facades\\Router::setRequirement","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_setCondition","name":"Coole\\Routing\\Facades\\Router::setCondition","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_prefix","name":"Coole\\Routing\\Facades\\Router::prefix","doc":""},
        {"type":"Method","fromName":"Coole\\Routing\\Facades\\Router","fromLink":"Coole/Routing/Facades/Router.html","link":"Coole/Routing/Facades/Router.html#method_group","name":"Coole\\Routing\\Facades\\Router::group","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\Routing","fromLink":"Coole/Routing.html","link":"Coole/Routing/Route.html","name":"Coole\\Routing\\Route","doc":null},
                                {"type":"Method","fromName":"Coole\\Routing\\Route","fromLink":"Coole/Routing/Route.html","link":"Coole/Routing/Route.html#method___construct","name":"Coole\\Routing\\Route::__construct","doc":null},
            
                                                {"type":"Class","fromName":"Coole\\Routing","fromLink":"Coole/Routing.html","link":"Coole/Routing/RouteRegistrar.html","name":"Coole\\Routing\\RouteRegistrar","doc":null},
                                {"type":"Method","fromName":"Coole\\Routing\\RouteRegistrar","fromLink":"Coole/Routing/RouteRegistrar.html","link":"Coole/Routing/RouteRegistrar.html#method___construct","name":"Coole\\Routing\\RouteRegistrar::__construct","doc":null},
        {"type":"Method","fromName":"Coole\\Routing\\RouteRegistrar","fromLink":"Coole/Routing/RouteRegistrar.html","link":"Coole/Routing/RouteRegistrar.html#method_prefix","name":"Coole\\Routing\\RouteRegistrar::prefix","doc":"<p>路由组前缀</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\RouteRegistrar","fromLink":"Coole/Routing/RouteRegistrar.html","link":"Coole/Routing/RouteRegistrar.html#method_middleware","name":"Coole\\Routing\\RouteRegistrar::middleware","doc":"<p>路由组中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\RouteRegistrar","fromLink":"Coole/Routing/RouteRegistrar.html","link":"Coole/Routing/RouteRegistrar.html#method_group","name":"Coole\\Routing\\RouteRegistrar::group","doc":"<p>路由组.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\Routing","fromLink":"Coole/Routing.html","link":"Coole/Routing/Router.html","name":"Coole\\Routing\\Router","doc":null},
                                {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method___construct","name":"Coole\\Routing\\Router::__construct","doc":null},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_match","name":"Coole\\Routing\\Router::match","doc":"<p>添加任意请求路由.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_any","name":"Coole\\Routing\\Router::any","doc":"<p>添加任意请求路由.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_get","name":"Coole\\Routing\\Router::get","doc":"<p>添加 get 求路由.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_post","name":"Coole\\Routing\\Router::post","doc":"<p>添加 post 请求路由.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_put","name":"Coole\\Routing\\Router::put","doc":"<p>添加 put 请求路由.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_delete","name":"Coole\\Routing\\Router::delete","doc":"<p>添加 delete 请求路由.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_options","name":"Coole\\Routing\\Router::options","doc":"<p>添加 options 请求路由.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_patch","name":"Coole\\Routing\\Router::patch","doc":"<p>添加 patch 请求路由.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_getGroupPattern","name":"Coole\\Routing\\Router::getGroupPattern","doc":"<p>获取路由组 pattern.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_getGroupMiddleware","name":"Coole\\Routing\\Router::getGroupMiddleware","doc":"<p>获取路由组中间件.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_updateGroupStack","name":"Coole\\Routing\\Router::updateGroupStack","doc":"<p>更新路由组栈.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method_group","name":"Coole\\Routing\\Router::group","doc":"<p>路由组.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\Router","fromLink":"Coole/Routing/Router.html","link":"Coole/Routing/Router.html#method___call","name":"Coole\\Routing\\Router::__call","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\Routing","fromLink":"Coole/Routing.html","link":"Coole/Routing/RoutingServiceProvider.html","name":"Coole\\Routing\\RoutingServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\Routing\\RoutingServiceProvider","fromLink":"Coole/Routing/RoutingServiceProvider.html","link":"Coole/Routing/RoutingServiceProvider.html#method_register","name":"Coole\\Routing\\RoutingServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\RoutingServiceProvider","fromLink":"Coole/Routing/RoutingServiceProvider.html","link":"Coole/Routing/RoutingServiceProvider.html#method_subscribe","name":"Coole\\Routing\\RoutingServiceProvider::subscribe","doc":"<p>服务订阅事件.</p>"},
        {"type":"Method","fromName":"Coole\\Routing\\RoutingServiceProvider","fromLink":"Coole/Routing/RoutingServiceProvider.html","link":"Coole/Routing/RoutingServiceProvider.html#method_afterRegister","name":"Coole\\Routing\\RoutingServiceProvider::afterRegister","doc":"<p>注册服务之后.</p>"},
            
                                                {"type":"Class","fromName":"Coole\\View\\Facades","fromLink":"Coole/View/Facades.html","link":"Coole/View/Facades/View.html","name":"Coole\\View\\Facades\\View","doc":""},
                                {"type":"Method","fromName":"Coole\\View\\Facades\\View","fromLink":"Coole/View/Facades/View.html","link":"Coole/View/Facades/View.html#method_getFacadeAccessor","name":"Coole\\View\\Facades\\View::getFacadeAccessor","doc":""},
        {"type":"Method","fromName":"Coole\\View\\Facades\\View","fromLink":"Coole/View/Facades/View.html","link":"Coole/View/Facades/View.html#method_render","name":"Coole\\View\\Facades\\View::render","doc":""},
        {"type":"Method","fromName":"Coole\\View\\Facades\\View","fromLink":"Coole/View/Facades/View.html","link":"Coole/View/Facades/View.html#method_display","name":"Coole\\View\\Facades\\View::display","doc":""},
            
                                                {"type":"Class","fromName":"Coole\\View","fromLink":"Coole/View.html","link":"Coole/View/ViewServiceProvider.html","name":"Coole\\View\\ViewServiceProvider","doc":null},
                                {"type":"Method","fromName":"Coole\\View\\ViewServiceProvider","fromLink":"Coole/View/ViewServiceProvider.html","link":"Coole/View/ViewServiceProvider.html#method_beforeRegister","name":"Coole\\View\\ViewServiceProvider::beforeRegister","doc":"<p>注册服务之前.</p>"},
        {"type":"Method","fromName":"Coole\\View\\ViewServiceProvider","fromLink":"Coole/View/ViewServiceProvider.html","link":"Coole/View/ViewServiceProvider.html#method_register","name":"Coole\\View\\ViewServiceProvider::register","doc":"<p>Registers services on the given container.</p>"},
            
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
            '//option[@data-version="main"]',
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



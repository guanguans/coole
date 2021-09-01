<?php

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel\Tests;

use Coole\Foundation\Middleware\CheckResponseForModifications;
use Coole\HttpKernel\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HasControllerAbleTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        $this->controller = new Controller();
    }

    public function testAddMiddleware()
    {
        $this->controller->addMiddleware($middleware = [CheckResponseForModifications::class]);
        $this->assertSame($middleware, $this->controller->getMiddleware());
    }

    public function testAddExcludedMiddleware()
    {
        $this->controller->addExcludedMiddleware($middleware = [CheckResponseForModifications::class]);
        $this->assertSame($middleware, $this->controller->getExcludedMiddleware());
    }

    public function testSetExcludedMiddleware()
    {
        $this->controller->setExcludedMiddleware($middleware = [CheckResponseForModifications::class]);
        $this->assertSame($middleware, $this->controller->getExcludedMiddleware());
    }

    public function testWithoutMiddleware()
    {
        $this->controller->withoutMiddleware($middleware = [CheckResponseForModifications::class]);
        $this->assertSame($middleware, $this->controller->getExcludedMiddleware());
    }

    public function testAddFinishHandler()
    {
        $controller = $this->controller->addFinishHandler(function () {});

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function testSetFinishHandler()
    {
        $controller = $this->controller->setFinishHandler(function () {});

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function testJson()
    {
        $this->assertInstanceOf(JsonResponse::class, $this->controller->json());
    }

    public function testSendFile()
    {
        $this->assertInstanceOf(BinaryFileResponse::class, $this->controller->sendFile(__FILE__));
    }

    public function testStream()
    {
        $this->assertInstanceOf(StreamedResponse::class, $this->controller->stream());
    }

    public function testAbort()
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('服务器错误');
        $this->controller->abort(500, '服务器错误');
    }

    public function testRedirect()
    {
        $this->assertInstanceOf(RedirectResponse::class, $this->controller->redirect('https::www.baidu.com'));
    }
}

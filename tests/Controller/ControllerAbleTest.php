<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Tests\Controller;

use Guanguans\Coole\Controller\Controller;
use Guanguans\Coole\Middleware\CheckResponseForModifications;
use Guanguans\Coole\Tests\TestCase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ControllerAbleTest extends TestCase
{
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new Controller();
    }

    public function testAddMiddleware()
    {
        $middleware = [CheckResponseForModifications::class];
        $this->controller->addMiddleware($middleware);
        $this->assertSame($middleware, $this->controller->getMiddleware());
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
        $this->controller->abort(400, '服务器错误');
    }

    public function testRedirect()
    {
        $this->assertInstanceOf(RedirectResponse::class, $this->controller->redirect('https::www.baidu.com'));
    }
}

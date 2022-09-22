<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel\Tests;

use Coole\Foundation\Middlewares\CheckResponseForModifications;
use Coole\HttpKernel\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HasControllerAbleTest extends TestCase
{
    private Controller $controller;

    protected function setUp(): void
    {
        $this->controller = new Controller();
    }

    public function testAddMiddleware(): void
    {
        $this->controller->addMiddleware($middleware = [CheckResponseForModifications::class]);
        self::assertSame($middleware, $this->controller->getMiddleware());
    }

    public function testAddExcludedMiddleware(): void
    {
        $this->controller->setWithoutMiddleware($middleware = [CheckResponseForModifications::class]);
        self::assertSame($middleware, $this->controller->getWithoutMiddleware());
    }

    public function testSetExcludedMiddleware(): void
    {
        $this->controller->setWithoutMiddleware($middleware = [CheckResponseForModifications::class]);
        self::assertSame($middleware, $this->controller->getWithoutMiddleware());
    }

    public function testWithoutMiddleware(): void
    {
        $this->controller->setWithoutMiddleware($middleware = [CheckResponseForModifications::class]);
        self::assertSame($middleware, $this->controller->getWithoutMiddleware());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddFinishHandler(): void
    {
        // $controller = $this->controller->addFinishHandler(static function (): void {
        // });
        //
        // $this->assertInstanceOf(Controller::class, $controller);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetFinishHandler(): void
    {
        // $controller = $this->controller->setFinishHandler(static function (): void {
        // });
        //
        // $this->assertInstanceOf(Controller::class, $controller);
    }

    public function testJson(): void
    {
        self::assertInstanceOf(JsonResponse::class, $this->controller->json());
    }

    public function testSendFile(): void
    {
        self::assertInstanceOf(BinaryFileResponse::class, $this->controller->sendFile(__FILE__));
    }

    public function testStream(): void
    {
        self::assertInstanceOf(StreamedResponse::class, $this->controller->stream());
    }

    public function testAbort(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('服务器错误');
        $this->controller->abort(500, '服务器错误');
    }

    public function testRedirect(): void
    {
        self::assertInstanceOf(RedirectResponse::class, $this->controller->redirect('https::www.baidu.com'));
    }
}

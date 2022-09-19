<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Concerns;

use SplFileInfo;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait InteractsWithResponse
{
    /**
     * 返回响应.
     */
    public function response(?string $content = '', int $status = 200, array $headers = []): Response
    {
        new Response($content, $status, $headers);
    }

    /**
     * 返回 Json 响应.
     */
    public function json(array $data = [], int $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $status, $headers);
    }

    /**
     * 重定 Url.
     */
    public function redirect(string $url, int $status = 302, array $headers = []): RedirectResponse
    {
        return new RedirectResponse($url, $status, $headers);
    }

    /**
     * 返回流响应.
     */
    public function stream(callable $callback = null, int $status = 200, array $headers = []): StreamedResponse
    {
        return new StreamedResponse($callback, $status, $headers);
    }

    /**
     * 返回二进制文件响应.
     */
    public function sendFile(SplFileInfo|string $file, int $status = 200, array $headers = [], string $contentDisposition = null): BinaryFileResponse
    {
        return new BinaryFileResponse($file, $status, $headers, true, $contentDisposition);
    }
}

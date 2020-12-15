# 响应

响应对象(Request) 由 [symfony/http-foundation](https://github.com/symfony/http-foundation) 提供实现支持。

``` php
namespace App\Controller;

use Guanguans\Coole\Controller\Controller;

class IndexController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function render($name, $context = []): string
    {
        return app('view')->render($name, $context);
    }

    /**
     * 重定 url.
     *
     * @param $url
     * @param int $status
     */
    public function redirect($url, $status = 302, array $headers = []): RedirectResponse
    {
        return new RedirectResponse($url, $status, $headers);
    }

    /**
     * 抛出 http 异常.
     *
     * @param $statusCode
     * @param string $message
     */
    public function abort($statusCode, $message = '', array $headers = []): HttpException
    {
        throw new HttpException($statusCode, $message, null, $headers);
    }

    /**
     * 返回流响应.
     *
     * @param null $callback
     * @param int  $status
     */
    public function stream($callback = null, $status = 200, array $headers = []): StreamedResponse
    {
        return new StreamedResponse($callback, $status, $headers);
    }

    /**
     * 返回 json 响应.
     *
     * @param array $data
     * @param int   $status
     */
    public function json($data = [], $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $status, $headers);
    }

    /**
     * 返回二进制文件响应.
     *
     * @param $file
     * @param int  $status
     * @param null $contentDisposition
     */
    public function sendFile($file, $status = 200, array $headers = [], $contentDisposition = null): BinaryFileResponse
    {
        return new BinaryFileResponse($file, $status, $headers, true, $contentDisposition);
    }
}
```
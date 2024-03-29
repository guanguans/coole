<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Routing;

use Coole\Foundation\Concerns\InteractsWithController;
use Symfony\Component\Routing\Route as SymfonyRoute;

class Route extends SymfonyRoute
{
    use InteractsWithController;

    private ?string $name = null;

    public function __construct(string $path = '', array $defaults = [], array $requirements = [], array $options = [], ?string $host = '', string|array $schemes = [], string|array $methods = [], ?string $condition = '')
    {
        parent::__construct($path, $defaults, $requirements, $options, $host, $schemes, $methods, $condition);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return $this
     */
    public function name(string $name): static
    {
        $this->name .= $name;

        return $this;
    }
}

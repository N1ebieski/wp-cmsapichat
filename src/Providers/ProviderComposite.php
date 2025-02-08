<?php

declare(strict_types=1);

namespace WPCmsapichat\Providers;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

final class ProviderComposite
{
    /**
     * @var array<Provider>
     */
    private array $handlers = [];

    public function through(Provider ...$handlers): self
    {
        $this->handlers = $handlers;

        return $this;
    }

    public function process(): void
    {
        foreach ($this->handlers as $handler) {
            $handler->boot();
        }
    }
}

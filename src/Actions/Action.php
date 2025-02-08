<?php

declare(strict_types=1);

namespace WPCmsapichat\Actions;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

abstract class Action
{
}

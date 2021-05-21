<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public $baseUrl = 'http://localhost:8000';

    use CreatesApplication;
}

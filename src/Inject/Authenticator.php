<?php

namespace Chat\Inject;

use Chat\Injector;

trait Authenticator
{
    protected ?\Delight\Auth\Auth $authenticator = null;

    protected function authenticator(): \Delight\Auth\Auth
    {
        if (!isset($this->authenticator)) {
            $this->authenticator = Injector::make('Authenticator');
        }
        return $this->authenticator;
    }

}

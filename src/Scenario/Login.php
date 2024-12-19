<?php

namespace Chat\Scenario;

use \Chat\Http\Request;
use \Chat\Http\Utils;
use \Chat\Inject;
use Chat\Injector;
use \Chat\Scenario;

/**
 * Implements scenarios of login page for users authentication.
 */
class Login implements Scenario
{
    use Inject\HtmlRenderer;
    use Inject\Authenticator;

    /**
     * Runs scenario of login page.
     *
     * @param Request $req      HTTP request to login page.
     *
     * @return array    Result of login page scenario.
     */
    public function run(Request $req): array
    {
        if ($this->authenticator()->isLoggedIn()) {
            Utils::RedirectToPage('/');
        }
        return ['toRender' => [
            'params' => $req->POST->getAll(),
        ]];
    }
}

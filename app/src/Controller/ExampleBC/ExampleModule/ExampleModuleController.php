<?php

declare(strict_types=1);

namespace Code\App\Controller\ExampleBC\ExampleModule;

use Code\App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ExampleModuleController extends BaseController
{
    public function __invoke(Request $request): Response
    {
        return $this->render(
            'test/test.html.twig',
            [
                'uri' => $request->getUri()
            ]
        );
    }
}

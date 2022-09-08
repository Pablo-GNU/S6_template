<?php

declare(strict_types=1);

namespace Code\App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class TestController extends BaseController
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

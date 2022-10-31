<?php

$finder = (new PhpCsFixer\Finder())
    ->exclude('/app/var')
    ->exclude('/vendor')
    ->exclude('/node_modules')
    ->exclude('/*.php')
    ->name('*.php')
    ->in(__DIR__)

;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'concat_space' => ['spacing' => 'one'],
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder)
;

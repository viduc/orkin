<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        '.gitlab',
        'docker',
        'files',
        'vendor',
    ])
    ->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
    ])
    ->setUsingCache(false)
    ->setFinder($finder)
    ->setFormat('txt');

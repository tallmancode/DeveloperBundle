<?php

    $finder = PhpCsFixer\Finder::create()
        ->in('src')
    ;

    $config = new PhpCsFixer\Config();
    return $config->setRules([
            '@Symfony' => true,
            '@PSR12' => true,
            'array_syntax' => ['syntax' => 'short'],
            'phpdoc_no_package' => true,
        ])
        ->setFinder($finder)
        ->setRiskyAllowed(true)
    ;

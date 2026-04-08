<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/routes',
        __DIR__ . '/config',
        __DIR__ . '/database',
    ])
    ->exclude([
        'migrations',
        'seeders',
    ]);

$config = new PhpCsFixer\Config();

return $config
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'cast_spaces' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => false,
        'fully_qualified_strict_types' => false,
        'increment_style' => ['style' => 'post'],
        'linebreak_after_opening_tag' => true,
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
        'no_unused_imports' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'return_type_declaration' => ['space_before' => 'none'],
        'single_line_comment_style' => true,
        'standardize_increment' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => false,
        'no_extra_blank_lines' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
    ])
    ->setFinder($finder)
    ->setIndent('    ')
    ->setLineEnding("\n");

<?php

use Bokad\Helpers\Debug;

set_error_handler(function ($errno, $errstr) {
    $options = [
        'displayDebugBacktrace' => 2,
        'offset' => 1,
        'explicit_var' => false,
    ];
    switch ($errno) {
        case E_USER_ERROR:
            $options['tag'] = 'Fatal error';
            $options['colorHigh'] = '#ff0000c9';
            break;

        case E_USER_WARNING:
            $options['tag'] = 'Warning';
            $options['colorHigh'] = '#ffa500c9';
            break;

        case E_USER_NOTICE:
            $options['tag'] = 'Notice';
            $options['colorHigh'] = '#ffff00c9';
            break;

        default:
            $options['tag'] = 'Unknown error type [' . $errno . ']';
            $options['colorHigh'] = '#ff00ffc9';
            break;
    }

    Debug::pp([$errstr], $options);
}, E_ALL);

set_exception_handler(function (Throwable $e) {
    Debug::pp([$e->getMessage()], [
        'explicit_var' => false,
        'tag' => 'Uncaught exception',
        'colorHigh' => '#ff0000c9',
        'backtrace' => $e->getFile() . ':' . $e->getLine(),
    ]);
});

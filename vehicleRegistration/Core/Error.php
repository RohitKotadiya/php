<?php

namespace Core;
use \Core\View;

class Error {

    public static function errorHandler($level, $message, $file, $line) {
        if(error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler($exception) {
        $errorCode = $exception->getCode();
        if($errorCode != 404)
            $errorCode = 500;
        http_response_code($errorCode);
        if(\App\Config::SHOW_ERRORS) {
            echo "<h1> Fatal Error </h1>";
            echo "<p> Uncaught Exception : '" . get_class($exception) . "' </p>";
            echo "<p> Message : '" . $exception->getMessage() . "' </p>";
            echo "<p> Stack Trace : <pre> " . $exception->getTraceAsString() . "</pre></p>";
            echo "<p> Thrown in : '" . $exception->getFile() . " 'on line " .
                                        $exception->getLine() . "</p>"; 
        }else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);
            $message = "Uncaught Exception : '" . get_class($exception) . "'";
            $message .= "with Message : '" . $exception->getMessage() . "'";
            $message .= "\n Stack Trace :" . $exception->getTraceAsString();
            $message .= "\n Thrown in : '" . $exception->getFile() . " 'on line " . 
                                            $exception->getLine() . "</p>";
            error_log($message);
            View::renderTemplate("$errorCode.html");
        }
    }
}
?>
<?php
// Регистрируем функцию автозагрузки классов
spl_autoload_register(function ($className) {
    // Префикс для папки "app"
    $prefix = 'Transport\\';

    if (strpos($className, $prefix) === 0) {
        $className = substr($className, strlen($prefix));

        // Путь к файлу класса
        $file = __DIR__ . '/app/' . str_replace('\\', '/', $className) . '.php';

        if (file_exists($file)) {
            require_once($file);
        }
    }
});

<?php
// ������������ ������� ������������ �������
spl_autoload_register(function ($className) {
    // ������� ��� ����� "app"
    $prefix = 'Transport\\';

    if (strpos($className, $prefix) === 0) {
        $className = substr($className, strlen($prefix));

        // ���� � ����� ������
        $file = __DIR__ . '/app/' . str_replace('\\', '/', $className) . '.php';

        if (file_exists($file)) {
            require_once($file);
        }
    }
});

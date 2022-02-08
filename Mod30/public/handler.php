<?php
require_once dirname(__DIR__, 1) . '/bootstrap.php';

if (!empty($_POST)) {
    header('Content-Type: application/json');

    $errors = validate($_POST);

    if (empty($errors)) {
        if (register($_POST)) {
            http_response_code(201);
            echo json_encode([
                'success' => true
            ]);
            exit();
        }
        http_response_code(500);
        echo json_encode([
            'success' => false
        ]);
        exit();
    }

    http_response_code(422);

    echo json_encode([
        'success' => false,
        'errors' => $errors
    ]);

    exit();
}

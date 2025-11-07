<?php

include_once __DIR__ . '/../model/calculator.php';
function calcControl(): array {
    $data = [
        'result'=> 0,
        'arg1' => 0,
        'arg2' => 0,
        'operator' => ''
    ];

    if (!empty($_POST)) {
        $data['arg1'] = (float)($_POST['arg1'] ?? 0);
        $data['arg2'] = (float)($_POST['arg2'] ?? 0);
        $data['operator'] = (string)($_POST['operator'] ?? '');
    }

    if ($data['operator'] !== '') {
        $data['result'] = calculate($data['arg1'], $data['arg2'], $data['operator']);
    }
        else {
            $data['result'] = 'Выберите операцию';
        }
    return $data;
}


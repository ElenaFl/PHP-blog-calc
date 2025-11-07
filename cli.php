<?php
$categories = [
    1 => [
        'id' => 1,
        'name' => 'Политика',
        'slug' => 'politic'
    ],
    2 => [
        'id' => 2,
        'name' => 'Спорт',
        'slug' => 'sport'
    ],

];
file_put_contents('categories.json', json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
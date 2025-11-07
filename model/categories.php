<?php

function getCategory(int $id): ?array
{
    return getCategories()[$id] ?? null;
}

function getCategoryName(int $id): ?string
{
    return getCategory($id)['name'] ?? null;
}

function getCategories(): array
{
    return [
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
}

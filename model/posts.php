<?php

function getPost(int $id): ?array
{
    return getPosts()[$id] ?? null;
}

function getPostsByCategoryId(int $id): ?array
{
    $filteredPosts = array_filter(getPosts(), function($post) use ($id) {
        return $post['category_id'] === $id;
    });

    return !empty($filteredPosts) ? array_values($filteredPosts) : null;
}


function getPosts(): array
{
    return json_decode(file_get_contents(ROOT_PATH . '/posts.json'), true);
}



function putPost($category_id, $title, $text)
{
    $fileName = __DIR__ . '/../posts.json';

    if (!file_exists($fileName)) {
        return ['error' => 'Файл posts.json не найден'];
    }

    $json = file_get_contents($fileName);
    if ($json === false) {
        return ['error' => 'Не удалось прочитать файл'];
    }

    $posts = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Ошибка JSON: ' . json_last_error_msg()];
    }

    $lastId = !empty($posts) ? (int)max(array_keys($posts)) : 0;

    $nextId = $lastId + 1;

    if (empty($title) || (int)$category_id <= 0) {
        return ['error' => 'Заголовок и категория обязательны'];
    }

    $newPost = [
        'id' => $nextId,
        'category_id' => (int)$category_id,
        'title' => (string)$title,
        'text' => (string)$text
    ];

    $posts[(string)$nextId] = $newPost;

    $updatedJson = json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if (file_put_contents($fileName, $updatedJson) === false) {
        return ['error' => 'Не удалось записать в файл'];
    }

    return $newPost;
}

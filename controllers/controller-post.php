<?php
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

function postsControl(): array
{
    $data = [
        'id' => 0,
        'category_id' => 0,
        'title' => '',
        'text' => '',
        'result' => '',
        'posts' => []
    ];

    $fileName = __DIR__ . '/../posts.json';

    if (file_exists($fileName)) {

        $json = file_get_contents($fileName);

        $data['posts'] = json_decode($json, true) ?? [];
    }

    if (!empty($_POST)) {
        $data['title'] = trim((string)$_POST['title'] ?? '');
        $data['text'] = trim((string)$_POST['text'] ?? '');
        $data['category_id'] = (int)($_POST['category_id'] ?? 0);

        if (empty($data['title'])) {
            $data['result'] = 'Заголовок обязателен';
            return $data;
        }
        if ($data['category_id'] <= 0) {
            $data['result'] = 'Выберите категорию';
            return $data;
        }

        $result = putPost(
            $data['category_id'],
            $data['title'],
            $data['text']
        );

        $data['result'] = isset($result['error'])
            ? $result['error']
            : 'Пост успешно создан';

        if (!isset($result['error'])) {
            $data['posts'][$result['id']] = $result;
        }
    }

    return $data;
}
<?php
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
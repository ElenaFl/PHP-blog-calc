<?php

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../config/app.php';

$page = $_GET['page'] ?? 'index';

switch ($page) {
    case 'index':
        echo render('index');
        break;

    case 'calc':
        $data = calcControl();

        echo render('calc', [
            'arg1' => $data['arg1'],
            'arg2' => $data['arg2'],
            'result' => $data['result']
        ]);
        break;

    case 'categories':
        $categories = getCategories();

        echo render('categories/index', [
            'categories' => $categories
        ]);
        break;

    case 'posts-by-category':
        $id = (int)($_GET['id'] ?? 0);

        $posts = getPostsByCategoryId($id);
        $categoryName = getCategoryName($id);

        echo render('categories/show', [
            'posts' => $posts,
            'categoryName' => $categoryName,
        ]);
        break;

    case 'posts':
        $data = postsControl();
    
        echo render('posts/index', [
            'data' => $data,
        ]);
        break;

    case 'post':
        $id = (int)($_GET['id'] ?? 0);
        $post = getPost($id);

        echo render('posts/show', [
            'post' => $post,
        ]);
        break;

    case 'about':
        echo render('about');

        break;

    default:
        die("Нет такой страницы");
}





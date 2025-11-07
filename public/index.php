<?php

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../config/app.php';

$page = $_GET['page'] ?? 'index';

switch ($page) {
    case 'index':
        echo render('index');
        break;

    case 'calc':
        include __DIR__ . '/../controllers/controller-calc.php';

        $data = calcControl();

        echo render('calc', [
            'arg1' => $data['arg1'],
            'arg2' => $data['arg2'],
            'result' => $data['result']
        ]);
        break;

    case 'categories':
        $categories = getCategories();

        include VIEWS_PATH . '/categories/index.phtml';
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
        include __DIR__ . '/../controllers/controller-post.php';

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





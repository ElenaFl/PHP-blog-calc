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

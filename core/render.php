<?php

function render(string $page, array $params = []): string
{
    return renderTemplate('layouts/main', [
        'menu' => renderTemplate('parts/menu'),
        'content' => renderTemplate($page, $params)
    ]);
}


function renderTemplate(string $page, array $params = []): string
{
    ob_start();

    extract($params);

    include VIEWS_PATH . '/' . $page . '.phtml';

    return ob_get_clean();
}
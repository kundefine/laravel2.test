<?php

    echo $category::get_categories_tree($category::get()->toTree() , [
        'container_start' => '<ul>',
        'container_end' => '</ul>',
        'before' => '<li>',
        'after' => '</li>',
        'link' => true,
        'append' => csrf_field()
    ]);
?>

<hr>
{!! $category::$output !!}
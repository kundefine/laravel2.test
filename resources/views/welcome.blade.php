<style>


    ul.parent {
        margin: 0;
        padding: 0;
    }

    li {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    ul.parent li.child > ul.parent {
        padding-left: 20px;
    }

    ul.parent li.child > ul.parent li {
        position: relative;
    }

    ul.parent li.child > ul.parent li:before,
    ul.parent li.child > ul.parent li:after {
        content: '';
        width: 15px;
        height: 1px;
        border-bottom: 1px dashed #000;
        position: absolute;
        left: 0;
        top: 0;
    }
    ul.parent li.child > ul.parent li:before{
        left: -12px;
        top: 8px;
    }
    ul.parent li.child > ul.parent li:after{
        transform: rotate(90deg);
        left: -20px;
        top: 1px;
    }


</style>
<?php

//    $category::get_categories_tree($category::orderBy('created_at', 'DESC')->get()->toTree() , [
//        'container_start' => '<ul>',
//        'container_end' => '</ul>',
//        'before' => '<li>',
//        'after' => '</li>',
//        'append' => csrf_field()
//    ], '');

echo '<div id=\'category_create\'>';
    $category::create_categories($category::get()->toTree());

echo '</div>';

?>


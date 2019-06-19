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
        position: relative;
    }

    ul.parent li.child > ul.parent li {
        position: relative;
    }

    ul.parent li.child > ul.parent li:before {
        content: '';
        width: 15px;
        height: 0px;
        border-bottom: 1px dashed #000;
        position: absolute;
        left: 0;
        top: 0;
    }
    ul.parent li.child > ul.parent li:before{
        left: -12px;
        top: 8px;
    }


    ul.parent li.child > ul.parent:before {
        position: absolute;
        width: 0;
        height: 100%;
        content: '';
        border-left: 1px dashed #000;
        left: 6px;
        top: -14px;
    }

    .expand-category {
        opacity: 0;
    }

    label.expand-button {
        position: relative;
    }

    .expand-category ~ ul.parent {
        height: 0;
        opacity: 0;
    }
    ul.parent {
        transition: all 500ms;
    }
    .expand-category:checked ~ ul.parent {
        height: auto;
        opacity: 1;
    }

    label.expand-button:before {
        position: absolute;
        content: '+';
        left: -18px;
        top: -5px;
        font-weight: bold;
        font-size: 19px;
        color: firebrick;
    }
    .expand-category:checked + label.expand-button:before {
        content: '-';
    }
    .expand-category:checked + label.expand-button {
        background: #ddd;
    }
    .expand-category + label.expand-button {
        background: initial;
    }
    label.expand-button.expand-button-plus:before {
        content: '+';
    }

    label.expand-button.expand-button-minus:before {
        content: '-';
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

<script src="{{asset('js/jquery.js')}}"></script>
<script>

$(document).ready(function(){

    $('ul.parent li').each(function(index, li){

        
        if($(li).find('ul.parent').length) {
            $(li).children('label').addClass('expand-button-plus');
        } else {
            $(li).children('label').addClass('expand-button-minus');
        }
    });
})

</script>

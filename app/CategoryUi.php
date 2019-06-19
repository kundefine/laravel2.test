<?php
namespace App;
use App\Category;
use function csrf_field;

trait CategoryUi {
    public static $output = '';


    public static function get_categories_tree($categories, array $options = []) {
        $options['link'] = true;
        // check for if there is category
        if(count($categories)) {
            static::$output .= $options['container_start'] ?? '<ul>';
            foreach ($categories as $category) {
                static::$output .= $options['before'] ?? '<li>';
                if($options['link'] === true) {
                    static::$output .= '<a href="/category/'. $category->slug .'">' . $category->name . '</a>';
                } else {
                    static::$output .= $category->name;
                }
                if(count($category->children)) {
                    static::get_categories_tree($category->children, $options);
                }
                static::$output .= $options['after'] ?? '</li>';
            }
            static::$output .= $options['container_end'] ?? '</ul>';

        }
        static::$output .= $options['append'] ?? '';
        echo static::$output;
        static::flash_output();
    }

    public static function create_child_categories($categories) {
        static $child_label = 0;
        static::$output .= "<ul class='parent'>";
        foreach ($categories as $category) {
            static::$output .= "<li class='child menu-id-{$category->id} child-{$child_label}'>";
            static::$output .= '<input type="checkbox" name="categories[]" value="'. $category->id .'" >' . $category->name . " ({$category->slug})";
            static::$output .= "<input type='text' class='child_category_input_value'><button class='category_create_button' id='$category->id'>Create Child</button>";
            if(count($category->children)) {
                $child_label++;
                static::create_child_categories($category->children);
            } else {
                $child_label = 0;
            }
            static::$output .=  "</li>";
        }
        static::$output .= "</ul>";
        echo static::$output;

        static::flash_output();
    }

    public static function create_categories($categories) {
        // check for if there is category
        echo '<div class="root-create">';
        echo '<h2>Create category</h2>';
        echo '<input type="text"><button>Create</button>';
        echo '</div>';

        static::create_child_categories($categories);

    }




    public static function flash_output() {
        static::$output = '';
    }
}
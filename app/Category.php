<?php

namespace App;

use function count;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use NodeTrait, HasSlug;
    public static $output = '';

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public static function get_categories_tree($categories, array $options = []) {

        // check for if there is category
        if(count($categories)) {
            static::$output .= $options['container_start'] ?? '<ul>';
            foreach ($categories as $category) {
                static::$output .= $options['before'] ?? '<li>';
                if($options['link']) {
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
        return static::$output;
    }
}


<?php
namespace ahura\app;
class mw_post_type{
    static function init()
    {
        self::register_testimonial();
    }
    static function register_testimonial()
    {
        $labels = [
            'name'                     => __('Testimonial', 'ahura'),
            'singular_name'            => __('Testimonial', 'ahura'),
            'add_new'                  => __('Add New', 'ahura'),
            'add_new_item'             => __('Add new item', 'ahura'),
            'edit_item'                => __('Edit item', 'ahura'),
            'new_item'                  =>  __('New Item', 'ahura'),
            'view_item'                => __("View Item", 'ahura'),
            'view_items'               => __("View Items", 'ahura'),
            'search_items'             => __("Search Items", 'ahura'),
            'not_found'                => __('No Item Found', 'ahura'),
            'not_found_in_trash'       => __("No item found in trash", 'ahura'),
            'parent_item_colon'        => __('Parent item', 'ahura'),
            'all_items'                => __("All Items", 'ahura'),
            'archives'                 => __("Items Archives", 'ahura'),
            'attributes'               => __("Testimonial Attributes", "ahura"),
            'insert_into_item'         => __("Insert into testimonial", 'ahura'),
            'uploaded_to_this_item'    => __("Upload to this item", 'ahura'),
            'featured_image'           => __("Featured Image", 'ahura'),
            'set_featured_image'       => __("Set featured image", 'ahura'),
            'remove_featured_image'    => __("Remove featured image", 'ahura'),
            'use_featured_image'       => __("Use as featured image", 'ahura'),
            'filter_items_list'        => __("Filter testimonial list", 'ahura'),
            'items_list_navigation'    => __('Testimonial list navigation', 'ahura'),
            'items_list'               => __('Testimonial list', 'ahura'),
            'item_published'           => __("Testimonial Published", 'ahura'),
            'item_published_privately' => __("Testimonial published privately", 'ahura'),
            'item_reverted_to_draft'   => __("Testimonial reverted to draft", 'ahura'),
            'item_scheduled'           => __("Testimonial scheduled", 'ahura'),
            'item_updated'             => __("Testimonial updated", 'ahura'),
        ];
        $args = [
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => false,
            'rewrite' => ['slug' => 'testimonial'],
            'exclude_from_search' => true,
            'supports' => ['title', 'editor', 'thumbnail']
        ];
        $res = register_post_type('testimonial', $args);
    }
}
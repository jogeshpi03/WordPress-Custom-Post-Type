<?php

    /**
     * Post Type calss generate 
     * Custom Post Type, Taxonomy
     * 
     * @author Jogesh Sharma
     */
    class Post_Type {
    
    
        /**
         * Post Type Key
         * 
         * @var string 
         */
        var $post_type;

        
        /**
         * Display Name
         * 
         * @var string
         */
        var $name;
        
        
        /**
         * Taxonomy ( default - false )
         * 
         * @var boolean
         */
        var $taxonomy;
    
    
    
        function __construct($post_type, $name, $taxonomy=FALSE) {
            add_action('init', array($this, 'invoke_post_type_settings'));

            $this->post_type = $post_type;
            $this->name = $name;
            $this->singular_name = $this->singular($name);
            $this->taxonomy = $taxonomy;
        }

        
        function singular($string) {
            return preg_match("/s$/", $string) ? rtrim($string, "s") : $string;
        }
    
    
        function invoke_post_type_settings() {
            
            $menu_name = apply_filters("{$this->post_type}_menu_name", $this->singular_name);
            $supports = apply_filters("{$this->post_type}_supports", array('title', 'editor', 'thumbnail'));
            $slug = apply_filters("{$this->post_type}_rewrite_slug", array("slug"=>str_replace(' ', '_', strtolower($this->name)), 'with_front' => FALSE ) );
            $menu_icon = apply_filters("{$this->post_type}_menu_icon", "");


            $labels = array(
                    'name'=>$this->name, 
                    'singular_name'=>$this->singular_name, 
                    'add_new'=>apply_filters("{$this->post_type}_add_new", "Add New"), 
                    'add_new_item'=>__("Add New {$this->singular_name}"), 
                    'edit_item'=>__("Edit {$this->singular_name}"), 
                    'new_item'=>__("New {$this->singular_name}"), 
                    'all_items'=>__("All {$this->name}"), 
                    'view_item'=>__("View {$this->singular_name}"), 
                    'search_items'=>__("Search {$this->name}"), 
                    'not_found'=>__("No {$this->name} found"), 
                    'not_found_in_trash'=>__("No {$this->name} found in Trash"), 
                    'parent_item_colon'=>'', 
                    'menu_name'=>$menu_name
            );

           $args = array(
               'labels'=>$labels, 
               'description'=>"Holds our {$this->name} and {$this->singular_name} specific data", 
                'public'=>true, 
                'position'=>5, 
                'supports'=>$supports, 
                'capability_type' => 'post', 
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite'=>$slug, 
                'has_archive'=>true, 
                'hierarchical'=> false,
                'menu_icon'=>$menu_icon
           );


           register_post_type($this->post_type, $args);
           
           if( $this->taxonomy )
               $this->utm_post_type_taxonomy ();
        }
    
    
    
        
        function utm_post_type_taxonomy() {
            
            $taxonomy_slug = apply_filters("{$this->post_type}_taxonomy_slug", "{$this->post_type} category");
            $rewrite = apply_filters("{$this->post_type}_rewrite_taxonomy", array('slug'=>str_replace(" ", "_", strtolower($taxonomy_slug)), 'with_front'=>FALSE));
            
            $labels = array(
                'name'              =>"{$this->singular_name} Categories",
                'singular_name'     =>"{$this->singular_name} Category",
                'search_items'      => __( "Search {$this->singular_name} Categories" ),
                'all_items'         => __( "All {$this->singular_name} Categories" ),
                'parent_item'       => __( "Parent {$this->singular_name} Category" ),
                'parent_item_colon' => __( "Parent {$this->singular_name} Category:" ),
                'edit_item'         => __( "Edit {$this->singular_name} Category" ), 
                'update_item'       => __( "Update {$this->singular_name} Category" ),
                'add_new_item'      => __( "Add New {$this->singular_name} Category" ),
                'new_item_name'     => __( "New {$this->singular_name} Category" ),
                'menu_name'         => __( "{$this->singular_name} Categories" )
            );
                
                
            $args = array(
                'labels'=>$labels, 
                'rewrite'=>$rewrite, 
                'hierarchical'=>TRUE
            );
            
            register_taxonomy($this->post_type . "_categories", $this->post_type, $args);            
        }
    
    }

<?php
    //ativando suporte a imagem destacada
    add_theme_support('post-thumbnails');

    //ativando menus dinamicos
    function register_my_menus() {
        register_nav_menus (
            array (
                'header-menu' => __('Menu do Topo')
            )
        );
    }
    add_action('init', 'register_my_menus');

    //criando post type
    function meus_posts_types() {

        //servicos
        register_post_type('servicos',
            array(
                'labels'            => array(
                    'name'          => __('Serviços'),
                    'singular_name' => __('Serviço')
                ),
                'public'            => true,
                'has_archive'       => true,
                'menu_icon'         => 'dashicons-hammer',
                'supports'          => array('title', 'editor', 'thumbnail', 'page-attributes'),
            )
        );

        //equipe
        register_post_type('equipe',
            array(
                'labels'            => array(
                    'name'          => __('Nossa Equipe'),
                    'singular_name' => __('Equipe')
                ),
                'public'            => true,
                'has_archive'       => true,
                'menu_icon'         => 'dashicons-networking',
                'supports'          => array('title', 'page-attributes'),
            )
        );

        //slide
        register_post_type('slide',
            array(
                'labels'            => array(
                    'name'          => __('Slides'),
                    'singular_name' => __('Slide')
                ),
                'public'            => true,
                'has_archive'       => true,
                'menu_icon'         => 'dashicons-format-gallery',
                'supports'          => array('title', 'page-attributes'),
            )
        );


        //depoimentos
        register_post_type('depoimentos',
            array(
                'labels'            => array(
                    'name'          => __('Depoimentos'),
                    'singular_name' => __('Depoimento')
                ),
                'public'            => true,
                'has_archive'       => true,
                'menu_icon'         => 'dashicons-testimonial',
                'supports'          => array('title', 'page-attributes'),
            )
        );

        //ads
        register_post_type('publicidade',
            array(
                'labels'            => array(
                    'name'          => __('Publicidade'),
                    'singular_name' => __('Publicidade')
                ),
                'public'            => true,
                'has_archive'       => true,
                'menu_icon'         => 'dashicons-universal-access',
                'supports'          => array('title', 'page-attributes'),
            )
        );

    }
    add_action('init', 'meus_posts_types');

    $args = array(
        'width'         => 980,
        'height'        => 60,
        'default-image' => get_template_directory_uri() . '/img/logo.png',
        'uploads'       => true,
    );
    add_theme_support( 'custom-header', $args );
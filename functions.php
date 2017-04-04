<?php
	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'hbd-theme', TEMPLATEPATH . '/languages' );
	
	add_theme_support( 'menus' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable($locale_file) )
	    require_once($locale_file);

	// Get the page number
	function get_page_number() {
	    if ( get_query_var('paged') ) {
	        print ' | ' . __( 'Page ' , 'hbd-theme') . get_query_var('paged');
	    }
	} // end get_page_number

	// Custom callback to list comments in the hbd-theme style
	function custom_comments($comment, $args, $depth) {
	  $GLOBALS['comment'] = $comment;
	    $GLOBALS['comment_depth'] = $depth;
	  ?>
	    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
	        <div class="comment-author vcard"><?php commenter_link() ?></div>
	        <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'hbd-theme'),
	                    get_comment_date(),
	                    get_comment_time(),
	                    '#comment-' . get_comment_ID() );
	                    edit_comment_link(__('Edit', 'hbd-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
	  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'hbd-theme') ?>
	          <div class="comment-content">
	            <?php comment_text() ?>
	        </div>
	        <?php // echo the comment reply link
	            if($args['type'] == 'all' || get_comment_type() == 'comment') :
	                comment_reply_link(array_merge($args, array(
	                    'reply_text' => __('Reply','hbd-theme'),
	                    'login_text' => __('Log in to reply.','hbd-theme'),
	                    'depth' => $depth,
	                    'before' => '<div class="comment-reply-link">',
	                    'after' => '</div>'
	                )));
	            endif;
	        ?>
	<?php } // end custom_comments
	
	// Custom callback to list pings
	function custom_pings($comment, $args, $depth) {
	       $GLOBALS['comment'] = $comment;
	        ?>
	            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
	                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'hbd-theme'),
	                        get_comment_author_link(),
	                        get_comment_date(),
	                        get_comment_time() );
	                        edit_comment_link(__('Edit', 'hbd-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
	    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'hbd-theme') ?>
	            <div class="comment-content">
	                <?php comment_text() ?>
	            </div>
	<?php } // end custom_pings
	
	// Produces an avatar image with the hCard-compliant photo class
	function commenter_link() {
	    $commenter = get_comment_author_link();
	    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
	        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	    } else {
	        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	    }
	    $avatar_email = get_comment_author_email();
	    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
	    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
	} // end commenter_link
	
	// For category lists on category archives: Returns other categories except the current one (redundant)
	function cats_meow($glue) {
	    $current_cat = single_cat_title( '', false );
	    $separator = "\n";
	    $cats = explode( $separator, get_the_category_list($separator) );
	    foreach ( $cats as $i => $str ) {
	        if ( strstr( $str, ">$current_cat<" ) ) {
	            unset($cats[$i]);
	            break;
	        }
	    }
	    if ( empty($cats) )
	        return false;

	    return trim(join( $glue, $cats ));
	} // end cats_meow
	
	// For tag lists on tag archives: Returns other tags except the current one (redundant)
	function tag_ur_it($glue) {
	    $current_tag = single_tag_title( '', '',  false );
	    $separator = "\n";
	    $tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	    foreach ( $tags as $i => $str ) {
	        if ( strstr( $str, ">$current_tag<" ) ) {
	            unset($tags[$i]);
	            break;
	        }
	    }
	    if ( empty($tags) )
	        return false;

	    return trim(join( $glue, $tags ));
	} // end tag_ur_it
	
	// Register widgetized areas
	function theme_widgets_init() {
	    // Area 1
	    register_sidebar( array (
	    'name' => 'Terceira Widget Area Home',
	    'id' => 'terceira_widget_area',
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	  ) );

	    // Area 2
	    register_sidebar( array (
	    'name' => 'Secondary Widget Area',
	    'id' => 'secondary_widget_area',
	    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</li>",
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	  ) );
	  
	  // Area 2
	    register_sidebar( array (
	    'name' => 'Footer Widget Area',
	    'id' => 'footer_widget_area',
	    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</li>",
	    'before_title' => '<h4 class="widget-title">',
	    'after_title' => '</h4>',
	  ) );
	} // end theme_widgets_init

	add_action( 'init', 'theme_widgets_init' );
	
	$preset_widgets = array (
	    'primary_widget_area'  => array( 'search', 'pages', 'categories', 'archives' ),
	    'secondary_widget_area'  => array( 'links', 'meta' )
	);
	if ( isset( $_GET['activated'] ) ) {
	    update_option( 'sidebars_widgets', $preset_widgets );
	}
	// update_option( 'sidebars_widgets', NULL );
	
	// Check for static widgets in widget-ready areas
	function is_sidebar_active( $index ){
	  global $wp_registered_sidebars;

	  $widgetcolums = wp_get_sidebars_widgets();

	  if ($widgetcolums[$index]) return true;

	    return false;
	} // end is_sidebar_active
	
	function register_my_menus() {
	  register_nav_menus(
	    array(
	      'header-menu' => __( 'Topo Menu' ),
	      'footer-menu' => __( 'Footer Menu' )
	    )
	  );
	}
	add_action( 'init', 'register_my_menus' );

	add_action('admin_init', 'my_general_section'); 

	function my_general_section() {  
	    add_settings_section(  
	        'redes_sociais', // Section ID 
	        'Redes Sociais', // Section Title
	        'my_section_options_callback', // Callback
	        'general' // What Page?  This makes the section show up on the General Settings Page
	    );

	    add_settings_field( // Option 1
	        'facebook_icon', // Option ID
	        'Endereço do facebook', // Label
	        'my_textbox_callback', // !important - This is where the args go!
	        'general', // Page it will be displayed (General Settings)
	        'redes_sociais', // Name of our section
	        array( // The $args
	            'facebook_icon' // Should match Option ID
	        )  
	    ); 

	    add_settings_field( // Option 1
	        'instagram_icon', // Option ID
	        'Endereço do instagram', // Label
	        'my_textbox_callback', // !important - This is where the args go!
	        'general', // Page it will be displayed (General Settings)
	        'redes_sociais', // Name of our section
	        array( // The $args
	            'instagram_icon' // Should match Option ID
	        )  
	    );

	    register_setting('general','facebook_icon', 'esc_attr');
	    register_setting('general','instagram_icon', 'esc_attr');

	    add_settings_section(  
	        'user_cliente', // Section ID 
	        'User Cliente', // Section Title
	        'my_user_options_callback', // Callback
	        'general' // What Page?  This makes the section show up on the General Settings Page
	    );

	    add_settings_field( // Option 1
	        'usuario_cliente', // Option ID
	        'Usuário', // Label
	        'my_textbox_callback', // !important - This is where the args go!
	        'general', // Page it will be displayed (General Settings)
	        'user_cliente', // Name of our section
	        array( // The $args
	            'usuario_cliente' // Should match Option ID
	        )  
	    );

	    add_settings_field( // Option 1
	        'senha_cliente', // Option ID
	        'Senha', // Label
	        'my_textbox_callback', // !important - This is where the args go!
	        'general', // Page it will be displayed (General Settings)
	        'user_cliente', // Name of our section
	        array( // The $args
	            'senha_cliente' // Should match Option ID
	        )  
	    );

	    register_setting('general','usuario_cliente', 'esc_attr');
	    register_setting('general','senha_cliente', 'esc_attr');

	    add_settings_section(  
	        'user_cliente', // Section ID 
	        'User Cliente', // Section Title
	        'my_user_options_callback', // Callback
	        'general' // What Page?  This makes the section show up on the General Settings Page
	    );

	    add_settings_field( // Option 1
	        'usuario_cliente', // Option ID
	        'Usuário', // Label
	        'my_textbox_callback', // !important - This is where the args go!
	        'general', // Page it will be displayed (General Settings)
	        'user_cliente', // Name of our section
	        array( // The $args
	            'usuario_cliente' // Should match Option ID
	        )  
	    );

	    register_setting('general','usuario_cliente', 'esc_attr');
	    register_setting('general','senha_cliente', 'esc_attr');

	    add_settings_section(  
	        'lightbox', // Section ID 
	        'Lightbox', // Section Title
	        '', // Callback
	        'general' // What Page?  This makes the section show up on the General Settings Page
	    );
	    
	    add_settings_field(
			'habilitar_lightbox',      // id
			'Deseja habilitar o lightbox?',              // setting title
			'my_checkbox_callback',    // display callback
			'general',                 // settings page
			'lightbox'                  // settings section
		);
	    
	    register_setting('general','habilitar_lightbox', 'esc_attr');

	    add_settings_section(  
	        'cor_padrao', // Section ID 
	        'Cor Padrão', // Section Title
	        '', // Callback
	        'general' // What Page?  This makes the section show up on the General Settings Page
	    );
	    
	    add_settings_field(
			'color_default',      // id
			'Hexadecimal:',              // setting title
			'my_textbox_callback',    // display callback
			'general',                 // settings page
			'cor_padrao', // Name of our section
	        array( // The $args
	            'color_default' // Should match Option ID
	        ) 
		);
	    
	    register_setting('general','color_default', 'esc_attr');
	}

	function my_textbox_callback($args) {  // Textbox Callback
	    $option = get_option($args[0]);
	    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" class="regular-text" />';
	}

	function my_checkbox_callback() {  // Textbox Callback
	    $option = get_option('habilitar_lightbox');
	    echo '<input type="checkbox" id="habilitar_lightbox" name="habilitar_lightbox" value="1" ' . checked(1, get_option('habilitar_lightbox'), false) . ' />';
	}



?>
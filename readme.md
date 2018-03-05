## Description ##
Acid is a WordPress theme options framework that allows developers and designers to create theme options in the WordPress Customizer API
with very little effort. This framework takes all the stress away from managing theme options, and allows you to focus more on developing your theme,
rather than spending endless hours creating and managing your theme options.

Acid includes all the default WordPress Customizer API options, and over time, we will be adding more custom options that fully adhere to the WordPress.org
theme check requirements. 

## Installation ##
To use Acid, simply bundle it in your theme. This framework is GPL-compatible, allowing you to include it in your theme whether you're creating fee themes on 
WordPress.org, Themeforst, Mojo or selling your themes privately. This tool is intended for use by developers, designers and theme creators.

1. Download the latest release of this framework, or click the download button to download as a zip.
2. Place the entire unzipped folder anywhere in your theme. For example:
```wp-contents/themes/YOUR_THEME/inc/Acid```
3. In your theme's functions.php file (or in any file in your theme where you want to add the code for your theme's options), include the framework's main file like so:
```include_once get_stylesheet_directory() . '/inc/Acid/acid.php';```
4. Sample code
``` PHP


$acid = acid_instance( get_stylesheet_directory_uri() . '/inc/' );


$data = array (
    
    'panels'    => array(
        
        'panel-demo'      => array(
            
            'title          => __( 'Demo Panel', 'theme-slug' ),
            'description'   => __( 'Panel with some of the Acid options', 'theme-slug' ),

            'sections'       => array(
                
                'section-demo'     => array(
                    
                    'title'         => __( 'Demo Section', 'theme-slug' ),
                    'description'   => __( 'Section to demo Acid options', 'theme-slug' ),
                    
                    'options'       => array(
                        
                        'toggle-sample'     => array(
                            
                            'label'     => __( 'Toggle on or off', 'theme-slug' ),
                            'type'      => 'toggle',
                            'default'   => false
                            
                        ),

                        'image-sample'      => array(
                            
                            'label'     => __( 'select an image', 'theme-slug' ),
                            'type'      => 'radio-image',
                            'choices'   => array(
                                array(
                                    'label'    => __( 'guy running', 'theme-slug' ),
                                    'url'       => 'http://localhost:8888/wp-content/uploads/2018/02/sports-2943144_1280.jpg'
                                ),
                                array(
                                    'label'    => __( 'couple', 'theme-slug' ),
                                    'url'       => 'http://localhost:8888/wp-content/uploads/2018/02/men-2425121_1280.jpg'
                                ),
                                array(
                                    'label'    => __( 'guy running', 'theme-slug' ),
                                    'url'       => 'http://localhost:8888/wp-content/uploads/2018/02/sports-2943144_1280.jpg'
                                ),
                            ),
                            
                        ),
                        
                        'range-sample'      => array(
                            
                            'label'     => __( 'Opacity %' , 'theme-slug' ),
                            'type'      => 'range',
                            'default'   => 20,
                            'min'       => 0,
                            'max'       => 100,
                            'step'      => 1
                            
                        ),
                        
                        'sortable-sample'   => array(
                            'label'     => __( 'Sortable links', 'theme-slug' ),
                            'type'      => 'sortable',
                        ),        
                        
                    ),
                ),   
            ),  
        ),
        'another-panel'     => array(
            
            'title'         => __( 'Another Panel', 'theme-slug' ),
            'description'   => __( 'This is another panel', 'theme-slug' ),

            'sections'          => array(
            
                'title'         => __( 'Section title', 'theme-slug' ),
                'description'   => __( 'This is another section demo', 'theme-slug' ),

                'options'       => array(

                    'demo-text'         => array(
                        'label'         => __( 'Enter your title', 'theme-slug' ),
                        'description'   => __( 'Create any text, HTML is not allowed', 'theme-slug' ),
                        'type'          => 'text',
                        'default'       => __( 'Created with Acid Framework', 'theme-slug' )

                    ),

                    'demo-url'          => array(),


                ),

            ),

        ),
    ),
);

$acid->config( $data );
```
## Credits ##

1. Customizer Range Control 
    https://github.com/soderlind/class-customizer-range-value-control
    MIT

2. Radio Image Control
    https://gist.github.com/justintadlock/2a9e3312a6fe10e8dc28
    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
    GPL

3. Toggle Control
    https://github.com/soderlind/class-customizer-toggle-control
    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
    GPL



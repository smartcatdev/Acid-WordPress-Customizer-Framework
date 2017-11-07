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
```wp-contents/themes/YOUR_THEME/Acid```
3. In your theme's functions.php file (or in any file in your theme where you want to add the code for your theme's options), include the framework's main file like so:
```include_once get_stylesheet_directory() . '/Acid/acid.php';```
4. 
```
$acid = acid_instance();

$acid->config( array (
    'panels' => array (
        'theme_frontpage' => array (
            'title' => __( 'Frontpage', 'textdomain' ),
            'description' => __( 'Customzize the frontpage', 'textdomain' ),
            'sections' => array (
                'slider' => array (
                    'title' => __( 'Slider', 'textdomain' ),
                    'description' => __( 'Customize the frontpage slider', 'textdomain' ),
                    'options' => array (
                        'slide1_toggle' => array (
                            'type'      => 'checkbox',
                            'default'   => __( 'on', 'textdomain' ),
                            'label'     => __( 'Toggle Slide 1', 'textdomain' ),
                        ),
                        'slide1_radio' => array (
                            'type'      => 'radio',
                            'default'   => __( 'on', 'textdomain' ),
                            'label'     => __( 'Toggle Slide 1', 'textdomain' ),
                            'choices'   => array(
                                'dark'      => __( 'Dark', 'textdomain' ),
                                'light'     => __( 'Light', 'textdomain' ),
                                'blue'      => __( 'Blue', 'textdomain' ),
                            ),
                        ),
                        'slide1_title' => array (
                            'type'      => 'text',
                            'default'   => __( 'Slide title', 'textdomain' ),
                            'label'     => __( 'Enter the slide title', 'textdomain' ),
                        ),
                        'slide1_date' => array (
                            'type'      => 'date',
                            'default'   => __( 'Slide date', 'textdomain' ),
                            'label'     => __( 'Enter the slide date', 'textdomain' ),
                        ),
                        'slide1_url' => array (
                            'type'      => 'url',
                            'default'   => __( 'Slide URL', 'textdomain' ),
                            'label'     => __( 'Enter the slide URL', 'textdomain' ),
                        ),
                        'slide1_number' => array (
                            'type'      => 'number',
                            'default'   => __( 'Slide number', 'textdomain' ),
                            'label'     => __( 'Enter the slide number', 'textdomain' ),
                        ),
                        'slide1_textarea' => array (
                            'type'      => 'textarea',
                            'default'   => __( 'Slide textarea', 'textdomain' ),
                            'label'     => __( 'Enter the slide textarea', 'textdomain' ),
                        ),
                        'slide1_select' => array (
                            'type'      => 'select',
                            'default'   => __( 'Slide select', 'textdomain' ),
                            'label'     => __( 'Enter the slide select', 'textdomain' ),
                        ),
                        'slide1_pages' => array (
                            'type'      => 'dropdown-pages',
                            'default'   => __( 'Slide pages', 'textdomain' ),
                            'label'     => __( 'Enter the slide page', 'textdomain' ),
                        ),
                        'slide1_email' => array (
                            'type'      => 'email',
                            'default'   => __( 'Slide email', 'textdomain' ),
                            'label'     => __( 'Enter the slide email', 'textdomain' ),
                        ),
                        'slide1_title2' => array (
                            'type'      => 'text',
                            'default'   => __( 'Slide title 2', 'textdomain' ),
                            'label'     => __( 'Enter the slide title 2', 'textdomain' ),
                        ),
                        'slide1_subtitle' => array (
                            'type'      => 'text',
                            'default'   => __( 'Slide title', 'textdomain' ),
                            'label'     => __( 'Enter the slide title', 'textdomain' )
                        ),
                        'slide1_button_text' => array (
                            'type'      => 'text',
                            'default'   => __( 'Button text', 'textdomain' ),
                            'label'     => __( 'Enter the button text', 'textdomain' )
                        ),
                        'slide1_button_text' => array (
                            'type'      => 'url',
                            'default'   => __( 'Button url', 'textdomain' ),
                            'label'     => __( 'Enter the button url', 'textdomain' )
                        ),
                    )
                ),
            )
        )
    )
) );
```

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
``` PHP
include_once get_stylesheet_directory() . '/inc/Acid/acid.php';
$acid = acid_instance();


$data = array (
  'panels' => 
  array (
    'panel-1' => 
    array (
      'title' => 'default label',
      'description' => 'default description',
      'sections' => 
      array (
        'section-1' => 
        array (
          'title' => 'default label',
          'description' => 'default description',
          'options' => 
          array (
            'text-2' => 
            array (
              'type' => 'url',
              'label' => 'website',
              'default' => 'https://smartcatdesign.net',
            ),
            'text-3' => 
            array (
              'type' => 'textarea',
              'label' => '',
              'default' => 'Default value',
            ),
            'text-4' => 
            array (
              'type' => 'number',
              'label' => '',
              'default' => 15,
            ),
            'select-1' => 
            array(
                'type' => 'date',
                'label' => '',
                'default' => 'Default value',                
            ),
            'select-2' => 
            array(
                'type' => 'checkbox',
                'label' => 'do you want things?',
                'default' => true,                
            ),
            'select-3' => 
            array(
                'type' => 'radio',
                'label' => 'do you want things?',
                'default' => 'red',
                'choices'   => array(
                    'red'   => __( 'Red', 'themeslug' ),
                    'white' => __( 'white', 'themeslug' ),
                    'orange' => __( 'Orange', 'themeslug' ),
                    
                ),
            ),
            'select-4' => 
            array(
                'type' => 'select',
                'label' => 'Select dropdown',
                'default' => 'white',
                'choices'   => array(
                    'red'   => __( 'Red', 'themeslug' ),
                    'white' => __( 'white', 'themeslug' ),
                    'orange' => __( 'Orange', 'themeslug' ),
                ),
            ),
            'select-5' => 
            array(
                'type' => 'color',
                'label' => 'text color',
                'default' => '#333',
            ),
            'select-6' => 
            array(
                'type' => 'image',
                'label' => 'bg image',
                'default' => 'this',
            ),
            'select-7' => 
            array(
                'type' => 'dropdown-pages',
                'label' => 'bg image',
                'default' => 1,
            ),
          ),
        ),
      ),
    ),
  ),
);

$acid->config( $data );
```

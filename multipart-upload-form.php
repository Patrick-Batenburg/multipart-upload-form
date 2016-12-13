<?php
/*
Plugin Name: Multipart Upload Form
Plugin URI:
Description: Meerdere bestanden uploaden.
Version: 1.0
Author: Silvas Development & Technology
Author URI: http://www.silvas.nl
License: Commercial
*/

function multipart_upload_form_init()
{/*
	register_post_type('multipart_upload_pdf', array(
		'labels' => array(
		'name' => 'Upload PDFs',
		'singular_name' => 'Upload PDF',
		'add_new' => 'Toevoegen',
		'add_new_item' => 'Voeg een PDF toe',
		'edit' => 'Bewerken',
		'edit_item' => 'Bewerk PDF',
		'new_item' => 'Nieuwe PDF',
		'view' => 'Bekijk',
		'view_item' => 'Bekijk PDF',
		'search_items' => 'Zoek PDF',
		'not_found' => 'Geen PDF gevonden',
		'not_found_in_trash' => 'Geen PDF in de prullenbak',
		'parent' => 'Hoofd PDF'),
		'public' => true,
		'menu_position' => 20,
		'supports' => array( 'title'),
		'menu_icon' => 'dashicons-align-center',
		'publicly_queryable' => true,
		'rewrite' => false,
		'query_var' => '',
		'show_in_nav_menus' => true
	));*/
}
add_action('init', 'multipart_upload_form_init');

function multipart_upload_meta_box()
{
	add_meta_box('Upload', 'Informatie van de upload', 'upload_form', 'multipart_upload_pdf', 'advanced', 'default', array());
}
add_action('add_meta_boxes', 'multipart_upload_meta_box');

function upload_form($post)
{
	global $post, $wpdb;
	multipart_upload_form_scripts();
	print '
	<form id="upload-form" action="' . plugin_dir_url( __FILE__ ) . 'upload-process.php" method="post" enctype="multipart/form-data">
		<fieldset>
			<input type="file" name="fileToUpload[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} bestanden geselecteerd" multiple="" onchange="makeFileList();">
					<label for="file-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
							<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
						</svg> 
						<span>Kies bestand(en)…</span>						
					</label>
			<input type="submit" class="submitfile" value="Upload" name="submit">
			<br /><br />
			<p>
				<strong>Geselecteerde bestanden:</strong>
			</p>
			<ul id="fileList" style="list-style-type: none;">
				<li>Geen bestanden geselecteerd</li>
			</ul>
		</fieldset>
	</form>';
}

function multipart_upload_form_scripts() 
{
	wp_enqueue_script('jquery');
    wp_register_script('file-listing',  plugin_dir_url( __FILE__ ) . 'js/file-listing.js');
    wp_enqueue_script('file-listing');
	wp_register_script('custom-file-input',  plugin_dir_url( __FILE__ ) . 'js/custom-file-input.js');
    wp_enqueue_script('custom-file-input');
	wp_register_script('jquery.custom-file-input',  plugin_dir_url( __FILE__ ) . 'js/jquery.custom-file-input.js');
    wp_enqueue_script('jquery.custom-file-input');
    wp_register_style('component',  plugin_dir_url( __FILE__ ) . 'css/component.css');
    wp_enqueue_style('component');	
}
add_action('wp_enqueue_scripts', 'multipart_upload_form_scripts');

//[uploadform]
function multipart_upload_form_func($atts)
{
	return upload_form($post);
}
add_shortcode('uploadform', 'multipart_upload_form_func');
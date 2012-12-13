<?php
/*
Name: Extended WP Featured Image
Author: Tim Milligan &amp; Rick Anderson
Version: 1.3
Description: Extended WP Featured Image box with size, alignment and link options.
Class: ewpfi
*/

class ewpfi extends thesis_wp_featured_image {
	protected function translate() {
		global $thesis;
		$this->name = sprintf(__('Extended %s Featured Image', 'ewpfi'), $thesis->api->base['wp']);
		$this->title = sprintf(__('Extended %s Featured Image', 'ewpfi'), $thesis->api->base['wp']);
	}
    
	protected function options() {

		$image_sizes = get_intermediate_image_sizes();
		foreach($image_sizes as $image_size){
			$select_images[$image_size] = $image_size;
		}
		$select_images['full'] = 'full';
                
		return array(
			'size' => array(
				'type' => 'select',
				'label' => __('Select Image Size', 'ewpfi'),
				'tooltip' => __('Select the desired image size.', 'ewpfi'),
				'options' => $select_images,
				'default' => 'thumbnail'
			),
			'alignment' =>  array(
				'type' => 'select',
				'label' => __('Select Image Alignment', 'ewpfi'),
				'tooltip' => __('Select the desired image alignment.', 'ewpfi'),
				'options' => array(
					'none' => 'none',
					'left' => 'left',
					'center' => 'center',
					'right' => 'right'
				),
				'default' => 'none'
			),
			'link' =>  array(
				'type' => 'select',
				'label' => __('Link Image to Post', 'ewpfi'),
				'tooltip' => __('Select whether or not to link the image to the post.', 'ewpfi'),
				'options' => array(
					'yes' => 'yes',
					'no' => 'no'
				),
				'default' => 'yes'
			)
		);
	}

	public function html($args = false) {
		global $post;
		extract($args = is_array($args) ? $args : array());
		$tab = str_repeat("\t", !empty($depth) ? $depth : 0);
            
		$size = $this->options['size'] ? $this->options['size'] : 'thumbnail';
		$alignment = $this->options['alignment'] ? $this->options['alignment'] : 'none';
		$link = $this->options['link'] ? $this->options['link'] : 'yes';

		echo $tab . ($link == 'yes' ? '<a href="' . get_permalink($post->ID) . '">' : '') . get_the_post_thumbnail( $post->ID, $size, array('class' => "ewpfi attachment-$size align$alignment")) . ($link == 'yes' ? '</a>' : '');
	}
}
<?php 
/**
 * Science Magazine review posts
**/ 
?>
<?php

function sci1_review() {

	global $post;
	$heading = get_post_meta( $post->ID, 'sci1_review_heading', true );
	$image_meta = get_post_meta( $post->ID, 'sci1_review_image', true );
	$total_score = get_post_meta( $post->ID, 'sci1_review_total', true );
	$good = get_post_meta( $post->ID, 'sci1_review_good', true );
	$bad = get_post_meta( $post->ID, 'sci1_review_bad', true );
	$image = wp_get_attachment_image_src(get_attachment_id_from_src ($image_meta), 'smallimagefeatured');
	$items       = get_post_meta( $post->ID, 'sci1_review_item', true );
	echo '<div id="review-wrapper">';
	echo '<div class="review-image"><img src="'.esc_url($image[0]).'" alt="'.esc_attr($heading).'"><div class="total-score">'.esc_html($total_score).'</div></div>';
	echo '<div class="review-wrapper-title-good-bad"><div class="review-title">'.esc_html($heading).'</div>'	;

				if ( $good ) {
					echo '<div class="review-good"><div class="good-title">'.esc_html(get_option('sci1_review_good_title')).'</div><ul>';						
						foreach( $good as $item ) {	
						echo '<li>';
						echo '<div class="good-text">'.esc_html($item['sci1_review_good']).'</div>';
 						echo '</li>';	
						}
					echo '</ul></div>';
				}

				if ( $bad ) {
					echo '<div class="review-bad"><div class="bad-title">'.esc_html(get_option('sci1_review_bad_title')).'</div><ul>';		
						foreach( $bad as $item ) {	
						echo '<li>';
						echo '<div class="bad-text">'.esc_html($item['sci1_review_bad']).'</div>';
 						echo '</li>';	
						}						
					echo '</ul></div>';
				}
				echo '</div>';
				
				if ( $items ) {
					echo '<div class="review-title-scores"><ul>'	;
						foreach( $items as $item ) {
							$result = 'width:'.esc_html($item['sci1_review_item_score']) *10..'%';
						  echo '<li>';
 						  echo '<div class="review-item-title">'.esc_html($item['sci1_review_item_title']).'</div><div class="review-item-score">'. esc_html($item['sci1_review_item_score']).'</div>';
						  echo '<div class="score-line"><div class="score-width" style="'.esc_attr($result).';"></div></div>';
						  echo '</li>';
					}
					echo '</ul></div>';
				}
		
		echo '</div>';
}
?>
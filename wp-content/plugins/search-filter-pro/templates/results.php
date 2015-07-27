<?php
/**
 * Search & Filter Pro
 *
 * Sample Results Template
 *
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      http://www.designsandcode.com/
 * @copyright 2014 Designs & Code
 *
 * Note: these templates are not full page templates, rather
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think
 * of it as a template part
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 *
 */
if ( $query->have_posts() )
{
	?>
	<p><small>検索結果: <?php echo $query->found_posts; ?> 件</small><br/><small>Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?></small></p>

	<div class="pagination">
		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?>
		</div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php alterna_content_pagination('nav-bottom' , 'pagination-centered'); ?>
	</div>
	<?php
	while ($query->have_posts())
	{
		$query->the_post();
		?>
		<article id="post-<?php the_ID(); ?>" class="post-ajax-element portfolio-element col-md-4 col-sm-6 col-xs-6 cat-bc0 portfolio-style-1 portfolio type-portfolio" itemscope itemtype="http://schema.org/CreativeWork">
			<div class="portfolio-wrap">
				<div class="portfolio-img">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail("alterna-s-thumbs");
					}
					?>
				</div>

				<div class="post-tip">
					<div class="bg"></div>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<a href="<?php echo esc_url(get_permalink()); ?>"><div class="link left-link"><i class="big-icon-link"></i></div></a>
					<a href="<?php echo esc_url($full_image[0]); ?>" class="fancyBox"><div class="link right-link"><i class="big-icon-preview"></i></div></a>
				</div>
			</div>
			<div class="portfolio-content">
				<header>
					<h4 class="entry-title" itemprop="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<span class="portfolio-categories" itemprop="genre"><?php echo alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false) , ' / '); ?></span>
				</header>
				</div>
		</article>
      <?php
    }
    alterna_content_pagination('nav-bottom' , 'pagination-centered');
  }else{
	?>
   <article id="post-0" class="entry-post no-results not-found">
     <header class="entry-header">
      <h1 class="entry-title"><?php _e( 'Nothing Found', 'alterna' ); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
      <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'alterna' ); ?></p>
      <?php get_search_form(); ?>
    </div><!-- .entry-content -->
  </article><!-- #post-0 -->
  <?php } ?>

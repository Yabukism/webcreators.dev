<?php
/**
 * Author template file.
 *
 * @since alterna 8.0
 */
 
get_header();

// index default will use global layout 
$layout = alterna_get_page_layout('global'); 
$layout_class = alterna_get_page_layout_class('global');

?>
<div id="main" class="container">
    <div class="row">
        <section class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
            <?php
			$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
			?>
			
            <div class="alterna-title">
                <h3><?php echo __('About','alterna').' '.$curauth->nickname; ?></h3>
                <div class="line"></div>
            </div>
			<div class="author-information">
				<div class="gravatar"><?php echo get_avatar($curauth->ID, 80 ); ?></div>
				<dl>
					<dt><?php _e('Website','alterna'); ?></dt>
					<dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>
					<dt><?php _e('Profile','alterna'); ?></dt>
					<dd><?php echo $curauth->user_description; ?></dd>
				</dl>
			</div>
			
            <div class="alterna-title">
                <h3><?php echo __('Posts by','alterna').' '.$curauth->nickname; ?></h3>
                <div class="line"></div>
            </div>
			<ul class="mline">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<li>
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php echo get_the_title(); ?>">
					<?php echo get_the_title(); ?></a>,
					<?php echo get_the_time('d M Y'); ?> in <?php the_category('&');?>
				</li>
			<?php endwhile; else: ?>
				<p><?php _e('No posts by this author.', 'alterna'); ?></p>
			<?php endif; ?>
			</ul>
			
			<?php alterna_content_pagination('nav-bottom' , 'pagination-centered'); ?>
        </section>
        <?php if($layout != 1) { ?> 
        <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar(); ?></aside>
        <?php } ?>
    </div>
</div>
<?php get_footer(); ?>
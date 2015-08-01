<?php
/**
 * Text Post Content
 *
 * @since alterna 7.0
 */
global $blog_show_type;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-post '.(intval($blog_show_type) != 0 ? "blog-show-style-2" : ""));?> itemscope itemtype="http://schema.org/Article">
<div class="row">
<?php if(intval($blog_show_type) == 0) { ?>
    <aside class="entry-left-side col-md-3 col-sm-12">
        <div class="post-date-type">
            <div class="post-type"><i class="big-icon-file"></i></div>
            <div class="date entry-date updated" itemprop="datePublished">
                <div class="day"><?php echo esc_html(get_the_date('d')); ?></div>
                <div class="month"><?php echo esc_html(get_the_date('M')); ?></div>
                <div class="year"><?php echo esc_html(get_the_date('Y')); ?></div>
            </div>
        </div>
        <div class="post-meta post-author"><i class="fa fa-user"></i><?php _e('by','alterna'); ?> <span itemprop="author"><?php if(intval(penguin_get_options_key('blog-author-link')) == 0) { the_author_link(); }else{ the_author_posts_link(); }?></span></div>
        <div class="post-meta post-comments"><i class="fa fa-comments"></i> <a href="<?php echo get_permalink(get_the_ID()).'#comments'; ?>" itemprop="interactionCount"><?php comments_number(__('No Comment' , 'alterna') , __('1 Comment' , 'alterna') , __('% Comments' , 'alterna')); ?></a></div>
    </aside>
    
    <!-- post content -->
    <section class="entry-right-side col-md-9 col-sm-12">
        <header class="entry-header">
        	<?php the_title( '<h3 class="entry-title" itemprop="name"><a href="' . esc_url( get_permalink() ) . '" itemprop="url">', '</a></h3>' ); ?>
        	<?php edit_post_link(__('Edit', 'alterna'), '<div class="post-edit"><i class="fa fa-edit"></i>', '</div>'); ?>
        	<div class="post-meta">
                <?php alterna_posted_on(); ?>
                <div class="entry-link"><a href="<?php echo the_permalink();?>"><i class="fa fa-link"></i></a></div>
            </div>
        </header><!-- .entry-header -->
        <div class="entry-summary" itemprop="articleSection">
        <?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
        <?php echo '<a class="more-link" href="'.esc_url( get_permalink() ).'">'.__('Read More','alterna').'</a>'; ?>
    </section>
<?php }else{ ?>
	<!-- post content -->
    <section class="entry-right-side col-md-12 col-sm-12">
    	<header class="entry-header">
			<div class="date entry-date updated" itemprop="datePublished"><?php echo esc_html(get_the_date()); ?></div>
        	<?php edit_post_link(__('Edit', 'alterna'), '<div class="post-edit"><i class="fa fa-edit"></i>', '</div>'); ?>
        	<?php the_title( '<h3 class="entry-title" itemprop="name"><a href="' . esc_url( get_permalink() ) . '" itemprop="url">', '</a></h3>' ); ?>
            <div class="post-meta">
                <?php alterna_posted_on(); ?>
                <div class="entry-comments"><a href="<?php echo get_permalink(get_the_ID()).'#comments'; ?>"><i class="fa fa-comments"></i><span itemprop="interactionCount"><?php comments_number(0 , 1 , '%'); ?></span></a></div>
            </div>
		</header><!-- .entry-header -->
        <div class="entry-summary" itemprop="articleSection">
        <?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
        <?php echo '<a class="more-link" href="'.esc_url( get_permalink() ).'">'.__('Read More','alterna').'</a>'; ?>
    </section>
<?php } ?>
</div>
</article>
        
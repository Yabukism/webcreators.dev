<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since alterna 8.0
 */
get_header();

// get page layout
$layout = alterna_get_page_layout('global'); 
$layout_class = alterna_get_page_layout_class('global');

?>
<div id="main" class="container">
	<div class="row">
        <section class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
			<?php
				if ( have_posts() ) {
					while ( have_posts() ) { 
						the_post(); 
			?>
            	<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry search-item'); ?> itemscope itemtype="http://schema.org/Article">
                	<?php if(has_post_thumbnail(get_the_ID())) { ?>
                    <aside class="post-thumbnail">
                            <div class="post-img">
                                <?php
                                echo get_the_post_thumbnail(get_the_ID(), "thumbnail" , array('alt' => get_the_title(),'title' => ''));
                                ?>
                            </div>
                    </aside>
                    <?php } ?>
                    <section class="post-content">
                        <header class="entry-header">
                        <?php the_title( '<h3 class="entry-title" itemprop="name"><a href="' . esc_url( get_permalink() ) . '" itemprop="url">', '</a></h3>' ); ?>
                            <div class="entry-meta">
                                <span class="post-type"><?php echo get_post_type(get_the_ID());?></span>
                                <span class="entry-date"><i class="fa fa-clock-o"></i><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><time class="entry-date updated" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></a></span>
                                <span class="author vcard"> <i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php echo get_the_author(); ?></span></span></a></span>
                            </div>
                        </header>
                        <div class="entry-summary" itemprop="articleSection">
                        <?php the_excerpt(); ?>
                        </div>
                    </section>
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
        </section>
        <?php if($layout != 1) { ?> 
        <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar(); ?></aside>
        <?php } ?>
    </div>
</div>
<?php get_footer(); ?>
<?php
/*
Template Name: Pagina Eventi e News
*/

get_header();
$paged = max(1, get_query_var('paged'));
$posts = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => get_option('posts_per_page'),
  'paged' => $paged,
  'orderby' => 'date',
  'order' => 'DESC',
));
?>

<div id="primary" class="site-main">
  <header class="header page-header sect">
    <div class="container">
      <div class="page-title big-title line"><h1><?php the_title(); ?></h1></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="mini-text"><?php echo the_content(); ?></div>
        </div>
      </div>
    </div>
  </header>
  <section class="sect eventi-news">
    <div class="container">
      <div class="row">
        <?php
        $news = new WP_Query(
          array(
            'post_type'      => 'post',
          )
        );

        if ( $news->have_posts() ) :
          while ( $news->have_posts() ) :
            $news->the_post();
            $thumb = get_field('cover');
        ?>
        <div class="col-md-3">
          <a class="news-card" href="<?php the_permalink(); ?>">
            <?php if ( $thumb ) : ?><img src="<?php echo esc_url( $thumb['sizes']['libro-preview'] ); ?>" alt="<?php echo esc_attr( $thumb['title'] ?: get_the_title() ); ?>"><?php endif; ?>
            <div class="news-body">
              <div class="news-date">
                <?php
                $start = get_field('data_inizio');
                $end = get_field('data_fine');
                if($start || $end){
                    if($start) echo $start;
                    if($end) echo ' | '.$end;
                }
                else{
                  echo esc_html( get_the_date( 'd-m-Y' ) );
                };
                ?>
              </div>
              <div class="news-title"><?php the_title(); ?></div>
              <?php $subtitle = get_field('sottotitolo');?>
              <?php if($subtitle): ?>
                <div class="news-text"><?php print $subtitle; ?></div>
              <?php endif; ?>
            </div>
          </a>
        </div>
        <?php
          endwhile;
          wp_reset_postdata();
        else :
        ?>
        <div class="col-12 mini-text mini light"><?php esc_html_e( 'Non ci sono articoli disponibili.', 'biblioteca' ); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>

<?php get_footer(); ?>

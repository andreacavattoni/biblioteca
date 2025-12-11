<?php
/*
Template Name: Pagina Eventi e News
*/

get_header();
?>

<main id="primary" class="site-main">
  <section class="page-header sect">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h1 class="big-title big"><?php the_title(); ?></h1>
          <?php if ( has_excerpt() ) : ?><div class="mini-text mini light"><?php echo wp_kses_post( get_the_excerpt() ); ?></div><?php endif; ?>
        </div>
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="col-md-4 text-md-end"><?php the_post_thumbnail( 'large' ); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="sect page-intro">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-10">
          <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="sect eventi-news">
    <div class="container-fluid">
      <div class="row align-items-center mb-4">
        <div class="col-md-8">
          <div class="mini-text mini light"><?php esc_html_e( 'Eventi e News', 'biblioteca' ); ?></div>
        </div>
        <div class="col-md-4 text-md-end">
          <a class="btn" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">Archivio<span></span></a>
        </div>
      </div>
      <div class="row">
        <?php
        $news = new WP_Query(
          array(
            'post_type'      => 'post',
            'posts_per_page' => 6,
          )
        );

        if ( $news->have_posts() ) :
          while ( $news->have_posts() ) :
            $news->the_post();
            $thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        ?>
        <div class="col-md-6 col-lg-4">
          <a class="news-card" href="<?php the_permalink(); ?>">
            <?php if ( $thumb ) : ?><img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?>
            <div class="news-body">
              <div class="news-date"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></div>
              <div class="news-title"><?php the_title(); ?></div>
              <div class="news-text"><?php the_excerpt(); ?></div>
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
</main>

<?php get_footer(); ?>

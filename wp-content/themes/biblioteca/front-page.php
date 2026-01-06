<?php
/*
Template name: Homepage
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php
$hero_title   = get_field( 'hero_title' ) ?: get_the_title();
$hero_cover   = get_field( 'hero_cover' );
$biblioteca   = get_field( 'biblioteca_section' );
$libri        = get_field( 'libri_section' );
$progetti     = get_field( 'progetti_section' );
$libri_title  = isset( $libri['title'] ) ? $libri['title'] : '';
$libri_text   = isset( $libri['text'] ) ? $libri['text'] : '';
$progetti_tit = isset( $progetti['title'] ) ? $progetti['title'] : '';
$progetti_rep = isset( $progetti['progetti'] ) ? $progetti['progetti'] : array();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="loader">
    <div class="logo"><?php bloginfo( 'name' ); ?></div>
  </div>
  <header class="header home-header">
    <div class="home-title-container">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="home-title title"><h1><?php echo esc_html( $hero_title ); ?></h1></div>
          </div>
        </div>
      </div>
    </div>
    <?php if ( $hero_cover ) : ?>
    <div class="home-image container-fluid">
      <img src="<?php echo esc_url( $hero_cover['sizes']['cover'] ); ?>" alt="<?php echo esc_attr( $hero_title ); ?>">
    </div>
    <?php endif; ?>
  </header>
  <div class="sect home-biblioteca">
    <div class="container">
          <?php if ( ! empty( $biblioteca['title'] ) ) : ?>
          <h2 class="big-title line"><?php echo esc_html( $biblioteca['title'] ); ?></h2>
          <?php endif; ?>
          <?php if ( ! empty( $biblioteca['text'] ) ) : ?>
          <div class="mini-text column-text"><?php echo wp_kses_post( wpautop( $biblioteca['text'] ) ); ?></div>
          <?php endif; ?>
        <div class="sect-cta">
          <?php if ( ! empty( $biblioteca['page'] ) ) : ?>
          <a class="btn" href="<?php echo esc_url( get_permalink( $biblioteca['page'] ) ); ?>"><?php echo ! empty( $biblioteca['cta_title'] ) ? esc_html( $biblioteca['cta_title'] ) : esc_html__( 'Scopri di più', 'biblioteca' ); ?><span></span></a>
          <?php endif; ?>
        </div>
    </div>
  </div>
  <div class="sect home-libri gray-sect">
    <div class="container">
      <?php if ( $libri_title ) : ?>
      <div class="big-title line"><?php echo esc_html( $libri_title ); ?></div>
      <?php endif; ?>
      <?php if ( $libri_text ) : ?>
      <div class="mini-text column-text"><?php echo esc_html( $libri_text ); ?></div>
      <?php endif; ?>
    </div>
    <div class="container-fluid">
      <div class="home-books row">
        <?php foreach ($libri['libri'] as $libro):?>
          <a class="book-card col-md-3" href="<?php print get_permalink($libro->ID); ?>">
            <?php $cover = get_field('libro_cover', $libro->ID); ?>
            <?php if ( $cover ) : ?><img src="<?php echo esc_url( $cover['sizes']['libro-preview'] ); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?>
            <div class="book-bottom">
              <div class="book-title"><?php print $libro->post_title; ?></div>
              <div class="book-arrow"><span></span></div>
            </div>
          </a>
        <?php endforeach;?>
      </div>
      <?php /*<div class="row books-grid">
        <?php
        $book_query = null;
        if ( post_type_exists( 'libro' ) ) {
          $book_query = new WP_Query(
            array(
              'post_type'      => 'libro',
              'posts_per_page' => 6,
            )
          );
        }
        if ( $book_query && $book_query->have_posts() ) :
          while ( $book_query->have_posts() ) :
            $book_query->the_post();
            $cover = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
        ?>
        <div class="col-12 col-md-6 col-xl-4">
          <a class="book-card" href="<?php the_permalink(); ?>">
            <?php if ( $cover ) : ?><img src="<?php echo esc_url( $cover ); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?>
            <div class="book-body">
              <div class="book-title"><?php the_title(); ?></div>
              <div class="book-text"><?php echo wp_trim_words( get_the_excerpt(), 18, '…' ); ?></div>
            </div>
          </a>
        </div>
        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
      </div>*/ ?>
    </div>
  </div>
  <div class="sect home-progetti">
    <div class="container">
      <?php if ( $progetti_tit ) : ?>
      <div class="big-title line"><?php echo esc_html( $progetti_tit ); ?></div>
      <?php endif; ?>
      <div class="progetti-grid">
        <?php foreach ( $progetti_rep as $progetto ) :
          $p_image = isset( $progetto['image'] ) ? $progetto['image'] : null;
          $p_title = isset( $progetto['title'] ) ? $progetto['title'] : '';
          $p_text  = isset( $progetto['text'] ) ? $progetto['text'] : '';
          $p_link  = isset( $progetto['link'] ) ? $progetto['link'] : '';
        ?>
        <div class="proj-single">
          <div class="proj-card row">
            <div class="col-md-6">
              <div class="proj-pic">
                <?php if ( $p_image ) : ?><img src="<?php echo esc_url( $p_image['sizes']['progetto'] ); ?>" alt="<?php echo esc_attr( $p_title ); ?>"><?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="proj-body">
                <div class="proj-title big-title"><?php echo esc_html( $p_title ); ?></div>
                <div class="proj-text mini-text"><?php echo wp_kses_post( $p_text ); ?></div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>

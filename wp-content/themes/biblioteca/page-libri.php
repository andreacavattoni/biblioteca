<?php
/*
Template Name: Pagina Libri
*/

get_header();

function biblioteca_render_libri_section( $label, $meta_value ) {
  $libri = new WP_Query(
    array(
      'post_type'      => 'libro',
      'posts_per_page' => 6,
      'meta_query'     => array(
        array(
          'key'   => 'libro_tipo',
          'value' => $meta_value,
        ),
      ),
    )
  );
  ?>
  <section class="sect libri-block">
    <div class="container-fluid">
      <div class="row align-items-center mb-4">
        <div class="col-md-8">
          <h2 class="big-title big"><?php echo esc_html( $label ); ?></h2>
        </div>
        <div class="col-md-4 text-md-end">
          <a class="btn" href="<?php echo esc_url( get_post_type_archive_link( 'libro' ) ); ?>">Vedi tutti<span></span></a>
        </div>
      </div>
      <div class="row books-grid">
        <?php if ( $libri->have_posts() ) : while ( $libri->have_posts() ) : $libri->the_post();
          $cover = function_exists( 'get_field' ) ? get_field( 'libro_cover' ) : null;
          $cover_url = $cover ? $cover['url'] : get_the_post_thumbnail_url( get_the_ID(), 'large' );
        ?>
        <div class="col-md-6 col-lg-4">
          <a class="book-card" href="<?php the_permalink(); ?>">
            <?php if ( $cover_url ) : ?><img src="<?php echo esc_url( $cover_url ); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?>
            <div class="book-body">
              <div class="book-title"><?php the_title(); ?></div>
              <?php if ( function_exists( 'get_field' ) && get_field( 'libro_subtitle' ) ) : ?>
              <div class="book-subtitle"><?php echo esc_html( get_field( 'libro_subtitle' ) ); ?></div>
              <?php endif; ?>
              <div class="book-text"><?php the_excerpt(); ?></div>
            </div>
          </a>
        </div>
        <?php endwhile; wp_reset_postdata(); else : ?>
        <div class="col-12 mini-text mini light"><?php esc_html_e( 'Non ci sono libri disponibili in questa sezione al momento.', 'biblioteca' ); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php
}

function biblioteca_render_categoria_section( $label, $slug ) {
  $libri = new WP_Query(
    array(
      'post_type'      => 'libro',
      'posts_per_page' => 6,
      'tax_query'      => array(
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => $slug,
        ),
      ),
    )
  );
  ?>
  <section class="sect libri-block">
    <div class="container-fluid">
      <div class="row align-items-center mb-4">
        <div class="col-md-8">
          <h2 class="big-title big"><?php echo esc_html( $label ); ?></h2>
        </div>
        <div class="col-md-4 text-md-end">
          <a class="btn" href="<?php echo esc_url( get_category_link( get_category_by_slug( $slug ) ) ); ?>">Vedi categoria<span></span></a>
        </div>
      </div>
      <div class="row books-grid">
        <?php if ( $libri->have_posts() ) : while ( $libri->have_posts() ) : $libri->the_post();
          $cover_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        ?>
        <div class="col-md-6 col-lg-4">
          <a class="book-card" href="<?php the_permalink(); ?>">
            <?php if ( $cover_url ) : ?><img src="<?php echo esc_url( $cover_url ); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?>
            <div class="book-body">
              <div class="book-title"><?php the_title(); ?></div>
              <div class="book-text"><?php the_excerpt(); ?></div>
            </div>
          </a>
        </div>
        <?php endwhile; wp_reset_postdata(); else : ?>
        <div class="col-12 mini-text mini light"><?php esc_html_e( 'Non ci sono titoli per questa categoria al momento.', 'biblioteca' ); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php
}
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
        <div class="col-md-4 text-md-end">
          <?php the_post_thumbnail( 'large' ); ?>
        </div>
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

  <?php
  biblioteca_render_libri_section( 'Narrativa', 'lettima' );
  biblioteca_render_libri_section( 'Divulgazione', 'divulgazione' );
  biblioteca_render_libri_section( 'Bibliografie', 'bibliografie' );

  biblioteca_render_categoria_section( 'Primi lettori', 'primi-lettori' );
  biblioteca_render_categoria_section( 'Ragazzi', 'ragazzi' );
  biblioteca_render_categoria_section( 'Adulti', 'adulti' );
  biblioteca_render_categoria_section( 'Figli attivi', 'figli-attivi' );
  ?>
</main>

<?php get_footer(); ?>

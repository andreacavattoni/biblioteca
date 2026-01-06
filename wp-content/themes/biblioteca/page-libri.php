<?php
/*
 * Template Name: Pagina Libri
 *
 * Visualizza una panoramica dei libri suddivisi per tipologie (campo ACF "libro_tipo")
 * e per categorie WordPress assegnate al tipo di post personalizzato "libro". Le
 * tipologie e le categorie vengono recuperate dinamicamente dal database così da
 * non dover aggiornare manualmente la lista ogni volta che se ne aggiungono di nuove.
 */

get_header();

/**
 * Visualizza una sezione di libri in base al valore del campo personalizzato "libro_tipo".
 *
 * @param string $label      Titolo visualizzato nella sezione.
 * @param string $meta_value Valore del meta campo "libro_tipo" da filtrare.
 */
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

/**
 * Visualizza una sezione di libri filtrata per categoria.
 *
 * @param string $label Nome leggibile della categoria.
 * @param string $slug  Slug della categoria.
 */
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
      <div class="container">
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
            $cover_url = get_field('libro_cover',get_the_ID())['sizes']['libro-preview'];
          ?>
          <div class="col-md-3">
            <a class="book-card" href="<?php the_permalink(); ?>">
              <?php if ( $cover_url ) : ?><img src="<?php echo esc_url( $cover_url ); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?>
              <div class="book-body">
                <div class="b-title">
                  <?php the_title(); ?>
                  <div class="b-text"><?php the_excerpt(); ?></div>
                </div>
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

<div id="primary" class="site-main">
  <header class="header page-header sect">
    <div class="container">
      <div class="page-title big-title line"><h1><?php the_title(); ?></h1></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="mini-text"><?php the_content(); ?></div>
        </div>
      </div>
    </div>
  </header>
  <?php
  // Recupera tutte le tipologie (valori univoci del meta "libro_tipo")
  $libro_meta_values = array();
  $posts_ids = get_posts( array(
      'post_type'      => 'libro',
      'posts_per_page' => -1,
      'fields'         => 'ids',
  ) );
  if ( ! empty( $posts_ids ) ) {
      foreach ( $posts_ids as $libro_id ) {
          $tipo = get_post_meta( $libro_id, 'libro_tipo', true );
          if ( $tipo ) {
              $libro_meta_values[] = $tipo;
          }
      }
  }

  $libro_categories = get_terms( array(
      'taxonomy'   => 'category',
      'object_type' => array( 'libro' ),
      'hide_empty' => true,
  ) );
  if ( ! is_wp_error( $libro_categories ) && ! empty( $libro_categories ) ) {
      foreach ( $libro_categories as $category ) {
          biblioteca_render_categoria_section( $category->name, $category->slug );
      }
  }
  ?>
</div>

<?php get_footer(); ?>

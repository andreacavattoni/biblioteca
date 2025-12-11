<?php
/*
Template Name: Pagina Biblioteca
*/
get_header();

$hero             = function_exists( 'get_field' ) ? get_field( 'biblioteca_hero' ) : array();
$hero_title       = isset( $hero['title'] ) && $hero['title'] ? $hero['title'] : get_the_title();
$hero_text        = isset( $hero['text'] ) ? $hero['text'] : ( has_excerpt() ? get_the_excerpt() : '' );
$hero_image_field = isset( $hero['image'] ) ? $hero['image'] : null;
$hero_image_src   = '';
$hero_image_alt   = '';

if ( $hero_image_field ) {
  $hero_image_src = isset( $hero_image_field['url'] ) ? $hero_image_field['url'] : '';
  $hero_image_alt = isset( $hero_image_field['alt'] ) ? $hero_image_field['alt'] : '';
} elseif ( has_post_thumbnail() ) {
  $hero_image_src = get_the_post_thumbnail_url( get_the_ID(), 'large' );
  $hero_image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
}

$services_section = function_exists( 'get_field' ) ? get_field( 'servizi_section' ) : array();
$services_title   = isset( $services_section['title'] ) ? $services_section['title'] : '';
$services_list    = isset( $services_section['servizi'] ) ? $services_section['servizi'] : array();

$spaces_section = function_exists( 'get_field' ) ? get_field( 'spazi_section' ) : array();
$spaces_title   = isset( $spaces_section['title'] ) ? $spaces_section['title'] : '';
$spaces_list    = isset( $spaces_section['spazi'] ) ? $spaces_section['spazi'] : array();

$home_id          = get_option( 'page_on_front' );
$books_section    = ( $home_id && function_exists( 'get_field' ) ) ? get_field( 'libri_section', $home_id ) : array();
$books_title      = isset( $books_section['title'] ) ? $books_section['title'] : '';
$books_text       = isset( $books_section['text'] ) ? $books_section['text'] : '';
$projects_section = ( $home_id && function_exists( 'get_field' ) ) ? get_field( 'progetti_section', $home_id ) : array();
$projects_title   = isset( $projects_section['title'] ) ? $projects_section['title'] : '';
$projects_list    = isset( $projects_section['progetti'] ) ? $projects_section['progetti'] : array();
?>
<main id="primary" class="site-main">
  <section class="page-hero sect">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-7">
          <div class="mini-text mini light">Biblioteca</div>
          <h1 class="big-title big"><?php echo esc_html( $hero_title ); ?></h1>
          <?php if ( $hero_text ) : ?>
          <div class="mini-text mini light"><?php echo wp_kses_post( wpautop( $hero_text ) ); ?></div>
          <?php endif; ?>
        </div>
        <?php if ( $hero_image_src ) : ?>
        <div class="col-md-5 text-md-end">
          <img class="hero-img" src="<?php echo esc_url( $hero_image_src ); ?>" alt="<?php echo esc_attr( $hero_image_alt ); ?>">
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="sect page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-10">
          <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
        </div>
      </div>
    </div>
  </section>

  <?php if ( $services_title || ! empty( $services_list ) ) : ?>
  <section class="sect servizi">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-md-8">
          <div class="mini-text mini light"><?php esc_html_e( 'I nostri servizi', 'biblioteca' ); ?></div>
          <div class="big-title big"><?php echo esc_html( $services_title ); ?></div>
        </div>
      </div>
      <div class="row">
        <?php foreach ( $services_list as $service ) :
          $title = isset( $service['title'] ) ? $service['title'] : '';
          $text  = isset( $service['text'] ) ? $service['text'] : '';
        ?>
        <div class="col-md-6 col-lg-4">
          <div class="service-card">
            <div class="service-title"><?php echo esc_html( $title ); ?></div>
            <div class="service-text"><?php echo wp_kses_post( $text ); ?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php if ( $spaces_title || ! empty( $spaces_list ) ) : ?>
  <section class="sect spazi">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-md-8">
          <div class="mini-text mini light"><?php esc_html_e( 'Spazi', 'biblioteca' ); ?></div>
          <div class="big-title big"><?php echo esc_html( $spaces_title ); ?></div>
        </div>
      </div>
      <div class="row">
        <?php foreach ( $spaces_list as $space ) :
          $icon  = isset( $space['icon'] ) ? $space['icon'] : null;
          $title = isset( $space['title'] ) ? $space['title'] : '';
          $text  = isset( $space['text'] ) ? $space['text'] : '';
        ?>
        <div class="col-md-6 col-lg-4">
          <div class="space-card">
            <?php if ( $icon ) : ?><img class="space-icon" src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $title ); ?>"><?php endif; ?>
            <div class="space-title"><?php echo esc_html( $title ); ?></div>
            <div class="space-text"><?php echo wp_kses_post( $text ); ?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="sect libri">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-md-8">
          <div class="mini-text mini light"><?php echo esc_html( $books_title ); ?></div>
          <div class="big-title big"><?php echo esc_html( $books_text ); ?></div>
        </div>
      </div>
      <div class="row books-grid">
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
      </div>
    </div>
  </section>

  <section class="sect progetti">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-md-8">
          <div class="mini-text mini light"><?php esc_html_e( 'Progetti permanenti', 'biblioteca' ); ?></div>
          <div class="big-title big"><?php echo esc_html( $projects_title ); ?></div>
        </div>
      </div>
      <div class="row progetti-grid">
        <?php foreach ( $projects_list as $project ) :
          $image = isset( $project['image'] ) ? $project['image'] : null;
          $title = isset( $project['title'] ) ? $project['title'] : '';
          $text  = isset( $project['text'] ) ? $project['text'] : '';
          $link  = isset( $project['link'] ) ? $project['link'] : '';
        ?>
        <div class="col-md-6 col-lg-4">
          <div class="proj-card">
            <?php if ( $image ) : ?><img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $title ); ?>"><?php endif; ?>
            <div class="proj-body">
              <div class="proj-title"><?php echo esc_html( $title ); ?></div>
              <div class="proj-text"><?php echo wp_kses_post( $text ); ?></div>
              <?php if ( $link ) : ?><a class="btn no-bk" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener">Scopri progetto<span></span></a><?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>

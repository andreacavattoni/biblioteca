<?php
/*
Template Name: Pagina Contatti
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

  <section class="sect contatti">
    <div class="container-fluid">
      <div class="row">
        <?php
        $contact_email   = function_exists( 'get_field' ) ? get_field( 'contact_email' ) : '';
        $contact_phone   = function_exists( 'get_field' ) ? get_field( 'contact_phone' ) : '';
        $contact_address = function_exists( 'get_field' ) ? get_field( 'contact_address' ) : '';
        ?>
        <div class="col-md-6">
          <div class="contact-card">
            <div class="mini-text mini light"><?php esc_html_e( 'Contatti', 'biblioteca' ); ?></div>
            <div class="contact-lines">
              <?php if ( $contact_address ) : ?><div class="contact-line"><?php echo esc_html( $contact_address ); ?></div><?php endif; ?>
              <?php if ( $contact_phone ) : ?><div class="contact-line"><a href="tel:<?php echo esc_attr( $contact_phone ); ?>"><?php echo esc_html( $contact_phone ); ?></a></div><?php endif; ?>
              <?php if ( $contact_email ) : ?><div class="contact-line"><a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a></div><?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="contact-card">
            <div class="mini-text mini light"><?php esc_html_e( 'Orari di apertura', 'biblioteca' ); ?></div>
            <?php if ( function_exists( 'get_field' ) && get_field( 'contact_hours' ) ) : ?>
              <div class="contact-line"><?php the_field( 'contact_hours' ); ?></div>
            <?php else : ?>
              <div class="contact-line mini-text mini light"><?php esc_html_e( 'Aggiorna questo contenuto dalla pagina utilizzando i campi personalizzati.', 'biblioteca' ); ?></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>

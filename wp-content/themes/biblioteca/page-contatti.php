<?php
/*
Template Name: Pagina Contatti
*/
get_header();
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php

$libri        = get_field( 'libri_section',2);
$progetti     = get_field( 'progetti_section',2);
$libri_title  = isset( $libri['title'] ) ? $libri['title'] : '';
$libri_text   = isset( $libri['text'] ) ? $libri['text'] : '';
$progetti_tit = isset( $progetti['title'] ) ? $progetti['title'] : '';
$progetti_rep = isset( $progetti['progetti'] ) ? $progetti['progetti'] : array();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="header page-header sect">
    <div class="container">
      <div class="page-title big-title line"><h1><?php print get_field('titolo_visualizzato'); ?></h1></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="contatti-sect">
            <div class="footer-item">
              <?php print get_field('orari'); ?>
            </div>
            <div class="footer-item telefono-item footer-flex">
              <span></span><?php print get_field('telefono'); ?>
            </div>
            <div class="footer-item email-item footer-flex">
              <span></span><?php print get_field('email'); ?>
            </div>
            <div class="footer-item loc-item footer-flex">
              <span></span><?php print get_field('location'); ?>
            </div>
          </div>
          <div class="contatti-sect">
            <div class="contatti-label">
              PUNTO DI LETTURA DI SAN LORENZO DORSINO
            </div>
            <?php $punto = get_field('punto_lettura'); ?>
            <div class="footer-item">
              <?php print $punto['orari']; ?>
            </div>
            <div class="footer-item telefono-item footer-flex">
              <span></span><?php print $punto['telefono']; ?>
            </div>
            <div class="footer-item email-item footer-flex">
              <span></span><?php print $punto['email']; ?>
            </div>
            <div class="footer-item loc-item footer-flex">
              <span></span><?php print $punto['location']; ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="page-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2769.755576329527!2d10.871938455541994!3d46.036025403958604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47826b03de51509f%3A0x1f52aa3e99c598fd!2sServizio%20Biblioteca%20e%20promozione%20della%20cultura!5e0!3m2!1sit!2sit!4v1687272865076!5m2!1sit!2sit" title="<?php esc_attr_e( 'Mappa Biblioteca Giudicarie Esteriori', 'biblioteca' ); ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </header>
</article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>

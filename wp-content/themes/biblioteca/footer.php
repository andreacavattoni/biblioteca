<?php
$footer_title   = function_exists( 'get_field' ) ? get_field( 'footer_title', 'option' ) : '';
$footer_text    = function_exists( 'get_field' ) ? get_field( 'footer_text', 'option' ) : '';
$footer_address = function_exists( 'get_field' ) ? get_field( 'footer_address', 'option' ) : '';
$footer_phone   = function_exists( 'get_field' ) ? get_field( 'footer_phone', 'option' ) : '';
$footer_email   = function_exists( 'get_field' ) ? get_field( 'footer_email', 'option' ) : '';
$footer_hours   = function_exists( 'get_field' ) ? get_field( 'footer_hours', 'option' ) : '';
$footer_social  = function_exists( 'get_field' ) ? get_field( 'footer_social', 'option' ) : array();
$footer_form    = function_exists( 'get_field' ) ? get_field( 'footer_form_shortcode', 'option' ) : '';
?>
</main>
</div>
<footer class="site-footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="footer-brand">
          <div class="mini-text mini light"><?php bloginfo( 'name' ); ?></div>
          <?php if ( $footer_title ) : ?><h2 class="big-title big"><?php echo esc_html( $footer_title ); ?></h2><?php endif; ?>
          <?php if ( $footer_text ) : ?><div class="mini-text mini light"><?php echo wp_kses_post( wpautop( $footer_text ) ); ?></div><?php endif; ?>
        </div>
      </div>
      <div class="col-md-4">
        <div class="footer-contacts">
          <?php if ( $footer_address ) : ?><div class="footer-line"><?php echo esc_html( $footer_address ); ?></div><?php endif; ?>
          <?php if ( $footer_phone ) : ?><div class="footer-line"><a href="tel:<?php echo esc_attr( $footer_phone ); ?>"><?php echo esc_html( $footer_phone ); ?></a></div><?php endif; ?>
          <?php if ( $footer_email ) : ?><div class="footer-line"><a href="mailto:<?php echo esc_attr( $footer_email ); ?>"><?php echo esc_html( $footer_email ); ?></a></div><?php endif; ?>
          <?php if ( $footer_hours ) : ?><div class="footer-line footer-hours"><?php echo wp_kses_post( wpautop( $footer_hours ) ); ?></div><?php endif; ?>
          <?php if ( ! empty( $footer_social ) ) : ?>
          <div class="footer-social">
            <?php foreach ( $footer_social as $social ) :
              $label = isset( $social['label'] ) ? $social['label'] : '';
              $url   = isset( $social['url'] ) ? $social['url'] : '';
              if ( ! $url ) { continue; }
            ?>
            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $label ?: $url ); ?></a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-4">
        <div class="footer-form">
          <?php
          if ( $footer_form ) {
            echo do_shortcode( $footer_form );
          } else {
            echo '<p class="mini-text mini light">' . esc_html__( 'Configura il form di contatto in Contact Form 7 e incolla lo shortcode nelle impostazioni footer.', 'biblioteca' ) . '</p>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container-fluid">
      <div class="row justify-content-between align-items-center">
        <div class="col-md-6 mini-text mini light">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></div>
        <div class="col-md-6 text-md-end mini-text mini light"><?php bloginfo( 'description' ); ?></div>
      </div>
    </div>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>

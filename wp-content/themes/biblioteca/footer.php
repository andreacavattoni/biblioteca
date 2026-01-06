<?php
$footer_social  = function_exists( 'get_field' ) ? get_field( 'footer_social', 'option' ) : array();
?>
</main>
</div>
<div class="newsletter-sect sect gray-sect">
  <div class="newsletter-title">
    <span></span>
    <?php print get_field('titolo_newsletter',2); ?>
  </div>
  <div id="Mailchimp_modulo_container">
		<div id="mc_embed_shell">
			<div id="mc_embed_signup">
        <form action="https://bibliogiudicarieesteriori.us21.list-manage.com/subscribe/post?u=8f066017f751cc891b924901c&amp;id=17f680685f&amp;v_id=136&amp;f_id=00f028e7f0" method="post" target="_blank">
  <div>
    <input type="email" name="EMAIL" class="n-input required email" id="mce-EMAIL" placeholder="Email *" required />
  </div>
  <div>
    <input type="text" name="FNAME" class="n-input text" id="mce-FNAME" placeholder="Nome" />
  </div>
  <!-- Preferenze di contatto -->
  <div class="n-f-desc">
    <label>Preferenze di comunicazione</label>
    <p>Come vuoi ricevere le notizie dalla Biblioteca Giudicarie Esteriori?</p>
    <label class="checkbox">
      <input type="checkbox" id="gdpr_email" name="gdpr[email]" value="Y" checked/>
      <span>Email</span>
    </label>
    <p>Potrai cancellare la tua iscrizione in qualsiasi momento usando il link in fondo alle nostre email. Per maggiori informazioni sul trattamento dei dati visita il nostro sito.</p>
  </div>
  <!-- Privacy e servizi -->
  <div class="n-f-desc">
    <p>Questo modulo usa Mailchimp come piattaforma di invio. Cliccando su “Iscriviti” acconsenti al trasferimento dei tuoi dati a Mailchimp per la gestione della newsletter.</p>
    <p>Per saperne di più, puoi consultare la <a href="https://mailchimp.com/legal/terms" target="_blank" rel="nofollow">privacy policy di Mailchimp</a>.</p>
  </div>
  <div class="n-submit">
    <input type="submit" name="subscribe" class="button btn" value="Iscriviti" />
  </div>
</form>
			</div>
			<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script><script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]=EMAIL;ftypes[0]=merge;,fnames[1]=FNAME;ftypes[1]=merge;,fnames[2]=LNAME;ftypes[2]=merge;,fnames[3]=ADDRESS;ftypes[3]=merge;,fnames[4]=PHONE;ftypes[4]=merge;,fnames[5]=BIRTHDAY;ftypes[5]=merge;false}(jQuery));var $mcj = jQuery.noConflict(true);</script></div>
		</div>
</div>
<div class="fixed-buttons">
  <?php foreach(get_field('link_fixed','option') as $link): ?>
    <a href="<?php print $link['url'];?>" rel="nofollow"><?php print $link['titolo']; ?></a>
  <?php endforeach; ?>
</div>
<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 red-col">
        <div class="footer-left-col">
          <a href="/" class="logo-footer"><img src="<?php print get_template_directory_uri(); ?>/images/logo-footer.svg"></a>
          <div class="footer-label">Contatti</div>
          <div class="footer-item">
            <?php print get_field('orari',32); ?>
          </div>
          <div class="footer-item telefono-item footer-flex">
            <span></span><?php print get_field('telefono',32); ?>
          </div>
          <div class="footer-item email-item footer-flex">
            <span></span><?php print get_field('email',32); ?>
          </div>
          <div class="footer-item loc-item footer-flex">
            <span></span><?php print get_field('location',32); ?>
          </div>
        </div>
        <div class="footer-brand">
        </div>
        <div class="footer-contacts">
          <div class="footer-social">
            <?php foreach ( $footer_social as $social ) :
              $label = isset( $social['label'] ) ? $social['label'] : '';
              $url   = isset( $social['url'] ) ? $social['url'] : '';
              if ( ! $url ) { continue; }
            ?>
            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $label ?: $url ); ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="footer-form">
          <?php
            echo do_shortcode('[contact-form-7 id="655b523" title="Contatti Biblioteca"]');
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container-fluid">
      <div class="row justify-content-between align-items-center">
        <div class="col-md-6 mini-text mini light"><a href="/privacy-policy">Privacy Policy</a></div>
        <div class="col-md-6 text-md-end mini-text mini light"><a href="https://www.ledolab.it">Creato da LeDo</a></div>
      </div>
    </div>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>

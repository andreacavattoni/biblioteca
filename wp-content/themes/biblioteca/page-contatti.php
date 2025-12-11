<?php
/*
Template Name: Pagina Contatti
*/

get_header();
?>

<main id="primary" class="site-main">
    <section class="page-header py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 mb-3"><?php the_title(); ?></h1>
                    <?php if (has_excerpt()) : ?>
                        <p class="lead mb-0"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>
                </div>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="col-md-4 text-md-end">
                        <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded shadow')); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="page-intro py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <?php
                    while (have_posts()) :
                        the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <?php
                $contact_email   = function_exists('get_field') ? get_field('contact_email') : '';
                $contact_phone   = function_exists('get_field') ? get_field('contact_phone') : '';
                $contact_address = function_exists('get_field') ? get_field('contact_address') : '';
                ?>
                <div class="col-md-6">
                    <div class="p-4 h-100 bg-white shadow-sm rounded">
                        <h2 class="h4 mb-3">Contatti</h2>
                        <ul class="list-unstyled mb-0">
                            <?php if ($contact_address) : ?>
                                <li class="mb-3">
                                    <strong>Indirizzo:</strong><br />
                                    <?php echo esc_html($contact_address); ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($contact_phone) : ?>
                                <li class="mb-3">
                                    <strong>Telefono:</strong><br />
                                    <a href="tel:<?php echo esc_attr($contact_phone); ?>"><?php echo esc_html($contact_phone); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($contact_email) : ?>
                                <li class="mb-3">
                                    <strong>Email:</strong><br />
                                    <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 h-100 bg-white shadow-sm rounded">
                        <h2 class="h4 mb-3">Orari di apertura</h2>
                        <?php if (function_exists('get_field') && get_field('contact_hours')) : ?>
                            <div class="mb-0"><?php the_field('contact_hours'); ?></div>
                        <?php else : ?>
                            <p class="mb-0">Aggiorna questo contenuto dalla pagina utilizzando i campi personalizzati.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

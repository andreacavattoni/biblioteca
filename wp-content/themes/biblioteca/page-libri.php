<?php
/*
Template Name: Pagina Libri
*/

get_header();

function biblioteca_render_libri_section($label, $meta_value) {
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
    <section class="py-5 border-bottom">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="h3 mb-0"><?php echo esc_html($label); ?></h2>
                <a class="btn btn-outline-primary" href="<?php echo esc_url(get_post_type_archive_link('libro')); ?>">Vedi tutti</a>
            </div>
            <div class="row g-4">
                <?php if ($libri->have_posts()) : ?>
                    <?php while ($libri->have_posts()) : $libri->the_post(); ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="card h-100 shadow-sm">
                                <?php
                                $cover = function_exists('get_field') ? get_field('libro_cover') : null;
                                if ($cover) :
                                    echo wp_get_attachment_image($cover['ID'], 'large', false, array('class' => 'card-img-top')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                elseif (has_post_thumbnail()) :
                                    the_post_thumbnail('large', array('class' => 'card-img-top'));
                                endif;
                                ?>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="h5 card-title mb-2"><?php the_title(); ?></h3>
                                    <?php if (function_exists('get_field')) :
                                        $subtitle = get_field('libro_subtitle');
                                        if ($subtitle) : ?>
                                            <p class="text-muted mb-2"><?php echo esc_html($subtitle); ?></p>
                                        <?php endif;
                                    endif; ?>
                                    <div class="card-text mb-3">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <a class="mt-auto btn btn-primary" href="<?php the_permalink(); ?>">Scopri di più</a>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="col-12">
                        <p class="mb-0">Non ci sono libri disponibili in questa sezione al momento.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
}

function biblioteca_render_categoria_section($label, $slug) {
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
    <section class="py-5 border-bottom">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="h3 mb-0"><?php echo esc_html($label); ?></h2>
                <a class="btn btn-outline-primary" href="<?php echo esc_url(get_category_link(get_category_by_slug($slug))); ?>">Vedi categoria</a>
            </div>
            <div class="row g-4">
                <?php if ($libri->have_posts()) : ?>
                    <?php while ($libri->have_posts()) : $libri->the_post(); ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="card h-100 shadow-sm">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', array('class' => 'card-img-top')); ?>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="h5 card-title mb-2"><?php the_title(); ?></h3>
                                    <div class="card-text mb-3"><?php the_excerpt(); ?></div>
                                    <a class="mt-auto btn btn-primary" href="<?php the_permalink(); ?>">Scopri di più</a>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="col-12">
                        <p class="mb-0">Non ci sono titoli per questa categoria al momento.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
}
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

    <?php
    biblioteca_render_libri_section('Narrativa', 'lettima');
    biblioteca_render_libri_section('Divulgazione', 'divulgazione');
    biblioteca_render_libri_section('Bibliografie', 'bibliografie');

    biblioteca_render_categoria_section('Primi lettori', 'primi-lettori');
    biblioteca_render_categoria_section('Ragazzi', 'ragazzi');
    biblioteca_render_categoria_section('Adulti', 'adulti');
    biblioteca_render_categoria_section('Figli attivi', 'figli-attivi');
    ?>
</main>

<?php get_footer(); ?>

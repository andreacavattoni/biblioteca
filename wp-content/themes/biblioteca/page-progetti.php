<?php
/*
Template Name: Pagina Progetti
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

    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="h3 mb-0">Progetti</h2>
                <a class="btn btn-outline-primary" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Archivio notizie</a>
            </div>
            <div class="row g-4">
                <?php
                $progetti = new WP_Query(
                    array(
                        'post_type'      => 'post',
                        'posts_per_page' => 9,
                        'category_name'  => 'progetti',
                    )
                );

                if ($progetti->have_posts()) :
                    while ($progetti->have_posts()) :
                        $progetti->the_post();
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="card h-100 shadow-sm">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', array('class' => 'card-img-top')); ?>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="h5 card-title mb-2"><?php the_title(); ?></h3>
                                    <div class="card-text mb-3"><?php the_excerpt(); ?></div>
                                    <a class="mt-auto btn btn-primary" href="<?php the_permalink(); ?>">Leggi di più</a>
                                </div>
                            </article>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="col-12">
                        <p class="mb-0">Non ci sono progetti pubblicati al momento.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

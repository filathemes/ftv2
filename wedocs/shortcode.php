<?php if ( $docs ) : ?>

<div class="wedocs-shortcode-wrap">
    <div class="wedocs-docs-list row">

        <?php foreach ($docs as $main_doc) : ?>

                <?php if ( $main_doc['sections'] ) : ?>

                   
                        <?php foreach ($main_doc['sections'] as $section) : ?>
                            <div class="col-md-4">
                                <a class="docs_section" href="<?php echo get_permalink( $section->ID ); ?>">
                                    <?php echo $section->post_title; ?>                            
                                </a>
                            </div>
                        <?php endforeach; ?>
                   
                <?php endif; ?>

        <?php endforeach; ?>
    </div>
</div>

<?php endif;
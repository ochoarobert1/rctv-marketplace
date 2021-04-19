<footer class="container-fluid p-0" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
    <div class="row no-gutters">
        <div class="the-footer col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="container">
                <div class="row align-items-center">
                    <?php if ( is_active_sidebar( 'sidebar_footer' ) ) : ?>
                    <div class="footer-item col-xl-4 col-lg-3 col-md-6 col-sm-12 col-12 order-xl-1 order-lg-1 order-md-1 order-sm-1 order-1">
                        <ul id="sidebar-footer1" class="footer-sidebar">
                            <?php dynamic_sidebar( 'sidebar_footer' ); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'sidebar_footer-2' ) ) : ?>
                    <div class="footer-item col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 order-xl-6 order-lg-6 order-md-12 order-sm-6 order-6">
                        <ul id="sidebar-footer2" class="footer-sidebar">
                            <?php dynamic_sidebar( 'sidebar_footer-2' ); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'sidebar_footer-3' ) ) : ?>
                    <div class="footer-item col-xl-4 col-lg-3 col-md-6 col-sm-12 col-12 order-xl-12 order-lg-12 order-md-6 order-sm-12 order-12">
                        <ul id="sidebar-footer3" class="footer-sidebar">
                            <?php dynamic_sidebar( 'sidebar_footer-3' ); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <div class="w-100"></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer() ?>
</body>

</html>

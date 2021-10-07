<footer class="footer">

    <div class="footer__title">
        <a href="<?php echo get_home_url(); ?>">
            <img src="<?php echo get_template_directory_uri() . '/images/footer_logo.png' ?>" alt="footer-logo">
        </a>
    </div>

    <nav class="footer__global-nav">
        <?php if (is_active_sidebar('footer-g-nav')) : ?>
            <?php dynamic_sidebar('footer-g-nav'); ?>
        <?php else : ?>
            <span>global-menu-widget is not found.</span>
        <?php endif; ?>
    </nav>

    <p class="footer__copyright">
        ©2021 <?php if (date("Y") !== '2021') echo date("-Y"); ?> Swing
    </p>

</footer>

<a id="scroll-to-top" class=" material-icons-outlined scroll-to-top__animation">
    expand_less
</a>

<?php wp_footer() ?>
</body>

</html>
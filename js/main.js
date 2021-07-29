jQuery(function () {

    $('.loading-box').addClass('loaded');

    const posts = jQuery('.rpwe-li');

    for (i = 0; i < posts.length; i++) {
        const post = jQuery(posts[i]);
        const link = post.find('.rpwe-img').attr('href');
        post.wrapInner('<a class="rpwe-li__inner" href="' + link + '  "></a>');

        console.log(jQuery(posts[i]).find('.rpwe-img').attr('href'));
        jQuery(posts[i]).children();
    }

    // privacy policy
    const privacyCheck = jQuery('.contact__privacy').find('input[type="checkbox"]');
    const submitBtn = jQuery('.contact__submit');
    privacyCheck.on('click', function () {
        if (privacyCheck.prop("checked")) {
            submitBtn.removeClass('disabled');
        } else {
            submitBtn.addClass('disabled');
        }
    })

    // 
    window.addEventListener('unload', function () {
        privacyCheck.prop('checked', false);
    });


    // プロフィールのテーブルのヘッダにクラスを付与
    const profileHeader = jQuery('.profile__business table tbody tr :first-child');
    for (i = 0; i < profileHeader.length; i++) {
        if (profileHeader[i].tagName == 'TD') {
            jQuery(profileHeader[i]).addClass('blue');
        }

    }

    scrollToTop();

});


const scrollToTop = function () {
    let is_show = false;
    let scrollBtn = jQuery('#scroll-to-top.scroll-to-top__animation');

    jQuery(window).on('scroll resize', function () {
        if (200 < jQuery(this).scrollTop()) {
            if (is_show === false) {
                // jQuery('#scroll-to-top').hide().fadeIn();
                scrollBtn.addClass("fadeIn");
                is_show = true;
            }
        } else {
            if (is_show === true) {
                // jQuery('#scroll-to-top').fadeOut();
                scrollBtn.removeClass('fadeIn');
                is_show = false;
            }
        }
    })

    scrollBtn.click(function () {
        jQuery("body, html").animate({ scrollTop: 0 }, 500);
    });
}


jQuery(function () {
    let documentHeight = jQuery(document).height();
    let windowsHeight = jQuery(window).height();
    let location = window.location.host;
    let url;
    if (location == 'web-app-create.com') {
        url = "https://" + window.location.host + "/sandbox/portfolio/wp-content/themes/newPortfolio/ajax-item.php";
    }
    else {
        url = "http://" + window.location.host + "/wp-content/themes/newPortfolio/ajax-item.php";
    }
    let postNumNow = 1; /* 最初に表示されている記事数 */
    let postNumAdd = 2; /* 追加する記事数 */
    let flag = false;


    jQuery(window).on("scroll", function () {
        let scrollPosition = windowsHeight + jQuery(window).scrollTop();
        if (scrollPosition >= documentHeight) {
            if (!flag) {
                jQuery(".entry-loading").addClass("is-show");
                flag = true;
                jQuery.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        post_num_now: postNumNow,
                        post_num_add: postNumAdd
                    },
                    success: function (response) {
                        jQuery(".entry-items").append(response);
                        if (!response) {
                            jQuery('.entry-loading').remove();
                        }
                        jQuery(".entry-loading").removeClass("is-show");

                        documentHeight = jQuery(document).height();
                        postNumNow += postNumAdd;
                        flag = false;
                    }
                });
            }
        }
    });
});
jQuery(document).ready(function() {


    jQuery('.text-widget .btn-header').on("click", function() {
        jQuery('.text-widget').css('display', 'none');
    });

    jQuery('.elementor-button-link.elementor-button.elementor-size-sm').click(function() {
        jQuery(".woocommerce.widget_product_search button").click();
    })
});
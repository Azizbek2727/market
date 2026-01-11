(function ($) {

    function getControls(el) {
        return el.closest('.product-card')
            ?.querySelector('.product-cart-controls');
    }

    function showCounter(controls) {
        controls.querySelector('.buy-button-wrapper')?.classList.add('d-none');
        controls.querySelector('.change-count-wrapper')?.classList.remove('d-none');
    }

    function showButton(controls) {
        controls.querySelector('.change-count-wrapper')?.classList.add('d-none');
        controls.querySelector('.buy-button-wrapper')?.classList.remove('d-none');
    }

    /**
     * 1. Buy button click → show counter
     */
    $(document).on('click', '.product-card-button', function () {
        const input = this
            .closest('.product-card')
            ?.querySelector('.dvizh-cart-element-before-count');

        //get ajax response
        $(document).ajaxSuccess(function (event, xhr, settings, response) {
            if (settings.url.includes('/cart/element/create')) {
                var elementId = response.elementId;
                input.value = response.count ?? 1;      // response.count = total cart count, so fallback
                input.dataset.id = response.elementId;  // correct cart_element.id
            }
        });

        const controls = getControls(this);
        if (controls) showCounter(controls);
    });

    /**
     * 2. Counter change → if value = 0 → show button
     */
    $(document).on(
        'input change',
        '.dvizh-cart-element-before-count',
        function () {
            const controls = getControls(this);
            if (!controls) return;

            const value = parseInt(this.value, 10) || 0;

            if (value === 0) {
                showButton(controls);
            } else {
                showCounter(controls);
            }
        }
    );

    /**
     * 3. Initial state on page load
     */
    $(function () {
        $('.product-card').each(function () {
            const input = this.querySelector('.dvizh-cart-element-before-count');
            if (input && parseInt(input.value, 10) > 0) {
                // showCounter(
                //     this.querySelector('.product-cart-controls')
                // );
            }
        });
    });

})(jQuery);

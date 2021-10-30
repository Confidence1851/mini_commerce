
@push('scripts')
<script>
    $(".cart_add_or_remove_btn").on("click", function(e) {
        e.preventDefault();
        const btn = $(this);
        const url = $(this).attr("data-url");
        const product_id = $(this).attr("data-product_id");
        const quantity = $("#cart_product_qty_" + product_id).val();
        const color = $("#cart_product_color_" + product_id).val();
        const size = $("#cart_product_size_" + product_id).val();
        const hide = $(this).attr("data-hide");
        handleLoading(true , btn);

        const formData = new FormData();
        if (quantity) {
            formData.append("quantity", quantity)
        }
        if (quantity) {
            formData.append("color", color)
        }
        if (quantity) {
            formData.append("size", size)
        }

        $.ajax({
            type: "post"
            , url: url
            , data: formData
            , dataType: 'json'
            , processData: false
            , contentType: false
            , cache: false
            , enctype: 'multipart/form-data'
            , success: function(data) {
                btn.find(".label").html(data.data.btn_text)
                toastr.success(data.msg);
                handleLoading(false , btn);
                $(".cart_items_count").html(data.data.items);

                if(hide){
                    $(hide).addClass("d-none");
                }
            }
            , error: function(response) {
                handleLoading(false , btn);

                const error = response.responseJSON;
                console.log(error);

                // let errors = "";
                // if (error.code == 422) {
                //     for (const [key, value] of Object.entries(error.errors)) {
                //         value.forEach((e, index) => {
                //             errors = errors + "\n" + e;
                //         });
                //     }
                //     swal(error.msg, errors, "warning");
                // } else {
                //     swal("Error", error.msg, "warning");
                // }

            }

        });

    });

    $(".cart_update_data").on("change", function(e) {
        e.preventDefault();
        const btn = $(this).attr("data-btn");
        const url = $(this).attr("data-url");
        const product_id = $(this).attr("data-product_id");
        const quantity = $("#cart_product_qty_" + product_id).val();
        const color = $("#cart_product_color_" + product_id).val();
        const size = $("#cart_product_size_" + product_id).val();

        const unit_price = $("#cart_item_unit_price_" + product_id);
        const subtotal = $("#cart_item_subtotal_" + product_id);

        handleLoading(true , btn);

        const formData = new FormData();
        if (quantity) {
            formData.append("quantity", quantity)
        }
        if (quantity) {
            formData.append("color", color)
        }
        if (quantity) {
            formData.append("size", size)
        }

        $.ajax({
            type: "post"
            , url: url
            , data: formData
            , dataType: 'json'
            , processData: false
            , contentType: false
            , cache: false
            , enctype: 'multipart/form-data'
            , success: function(data) {
                handleLoading(false , btn);
                unit_price.html(data.data.cartItem.unit_price)
                subtotal.html(data.data.cartItem.sub_total)
            }
            , error: function(response) {
                handleLoading(false , btn);

                const error = response.responseJSON;
                console.log(error);

                // let errors = "";
                // if (error.code == 422) {
                //     for (const [key, value] of Object.entries(error.errors)) {
                //         value.forEach((e, index) => {
                //             errors = errors + "\n" + e;
                //         });
                //     }
                //     swal(error.msg, errors, "warning");
                // } else {
                //     swal("Error", error.msg, "warning");
                // }

            }

        });

    });

    function handleLoading(isLoading , target = null) {
        const button = $(".disableOnSubmitBtn");
        const spinner = $(target).find(".spinner");
        const label = $(target).find(".label");
        if (isLoading) {
            button.attr("disabled", true);
            spinner.removeClass("d-none");
            label.addClass("d-none");
        } else {
            button.removeAttr("disabled");
            spinner.addClass("d-none");
            label.removeClass("d-none");
        }
    }

</script>
@endpush

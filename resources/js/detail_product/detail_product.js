import '../bootstrap'
import '../detail_product/lightslider'

class DetailProduct {
    constructor() {
        this.chooseColor()
        this.addCart()
        this.lightSlider()
    }

    lightSlider() {
        $("#lightSlider").lightSlider({
            gallery    : true,
            item       : 1,
            loop       : true,
            slideMargin: 0,
            thumbItem  : 9
        })
    }

    chooseColor() {
        $('.color').click(function () {
            let color   = $(this).data('labelColor')
            let labelId = '#'.concat(color)

            $('.color').css("border-style", "none")

            if ($("input[name='color']:checked")) {
                $(labelId).css("border-style", "inset")
            }
        })
    }

    addCart() {
        $(".btn-cart").click((function () {
            let cart  = localStorage.getItem('cart')
            let color = $("input[name='color']:checked").val()

            if (cart == null) {
                cart = {
                    "products": []
                }
            } else {
                cart = JSON.parse(cart)
            }

            if (color != null) {
                let productId  = $(this).data('product-id')
                let checkExist = false

                //check Quantity
                _.forEach(cart.products, function (product) {
                    if (product.product_id === productId && product.color === color) {
                        product.quantity = product.quantity + 1
                        product.color    = color
                        checkExist       = true
                    }
                })

                if (!checkExist) {
                    let product = {
                        product_id: productId,
                        quantity  : 1,
                        color     : color
                    }

                    cart.products.push(product)
                }

                localStorage.setItem('cart', JSON.stringify(cart))

                alert("Add cart success")

            } else {
                alert("Please choose color")
            }
        }))
    }
}

export default new DetailProduct()

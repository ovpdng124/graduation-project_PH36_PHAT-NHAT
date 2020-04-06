import '../bootstrap'

class ProductCart {
    constructor() {
        this.del()
    }

    del() {
        $('.delete').click(function () {
            let cart      = JSON.parse(localStorage.getItem('cart'))
            let productId = $(this).data('product-id')
            let color     = $(this).data('color')
            let newCart   = {
                products: []
            }

            _.forEach(cart.products, function (product, key) {
                if (product.product_id === productId && product.color === color) {
                    newCart.products = _.filter(cart.products, (n, k) => {
                        return k !== key
                    })
                }
            })

            localStorage.setItem('cart', JSON.stringify(newCart))

            $('.table-body').html("")
            function getProducts() {
                let cart     = localStorage.getItem('cart')
                let your_url = "/product-cart"

                $.ajax({
                    type: "GET",
                    url : your_url,
                    data: JSON.parse(cart)
                }).then(function (res) {
                    $('.table-body').append(res)
                })
            }
            $(document).ready(getProducts())
        })
    }
}

export default new ProductCart()

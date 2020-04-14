import '../bootstrap'

class GetProduct {
    constructor() {
    }

    getProducts() {
        let getProducts = this
        let cart     = localStorage.getItem('cart')
        let your_url = "/product-cart"

        $.ajax({
            type: "GET",
            url : your_url,
            data: JSON.parse(cart)
        }).then(function (res) {
            if($.isEmptyObject(res)){
                localStorage.removeItem('cart')
                getProducts.getProducts()
            }

            $('.table-body').append(res)
        })
    }
}

export default new GetProduct()

import '../bootstrap'

class GetProduct {
    constructor() {
    }

    getProducts() {
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
}

export default new GetProduct()

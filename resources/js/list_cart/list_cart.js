import '../bootstrap'

class ListCart {
    constructor() {
        this.getProducts()
    }

    getProducts() {
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
    }
}

export default new ListCart()

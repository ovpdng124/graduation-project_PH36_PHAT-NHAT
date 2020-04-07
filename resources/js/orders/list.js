class List {
    constructor() {
        this.listen()
    }

    listen() {
        this.showOrderList()
    }

    showOrderList() {
        $(document).ready(function () {
            let cart = localStorage.getItem('cart')
            let url  = '/order-form'
            $.ajax({
                type: "GET",
                url : url,
                data: JSON.parse(cart)
            }).then(function (res) {
                $('.card-body').append(res)
            })
        })
    }
}

export default new List()

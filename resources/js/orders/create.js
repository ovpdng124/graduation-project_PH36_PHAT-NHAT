import './check_voucher'

class Create {
    constructor() {
        this.config()
        this.listen()
    }

    config() {
        this.element = {
            orderForm         : $('#formData'),
            submitOrder       : $('.submit-order'),
        }
    }

    listen() {
        this.submitOrder()
    }

    submitOrder() {
        let orderForm = this.element.orderForm
        this.element.submitOrder.click(function () {
            let confirmed = confirm('The order will be created after clicking "OK", are you sure?')
            if (confirmed) {
                orderForm.submit()
                localStorage.removeItem('cart')
            }
        })
    }
}

export default new Create()

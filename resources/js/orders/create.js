class Create {
    constructor() {
        this.config()
        this.listen()
    }

    config() {
        this.element = {
            isSale            : $('.is-sale'),
            voucher           : $('.voucher'),
            submitOrder       : $('.submit-order'),
            discountPriceInput: $('.discount-price'),
            totalPaymentInput : $('.total-payment'),
            discountPriceText : $('#discount-price'),
            totalPaymentText  : $('#total-payment'),
            voucherCodeField  : $('#voucher-code'),
            totalPrice        : $('#total-price'),
            orderForm         : $('#form-data')
        }
    }

    listen() {
        this.checkVoucher()
        this.submitOrder()
    }

    checkVoucher() {
        let totalPrice = this.element.totalPrice.text().replace(/,/g, '')
        let selector   = this.element

        this.element.voucherCodeField.on('keyup', function () {
            let voucherCode  = $(this).val()
            let url          = '/check-voucher'
            let numberFormat = new Intl.NumberFormat('en-US')
            $.ajax({
                type: 'GET',
                url : url,
                data: {
                    'total_price' : totalPrice,
                    'voucher_code': voucherCode
                }
            }).then(function (response) {
                if (response['discount_price'] !== 'No discount') {
                    selector.discountPriceText.text(numberFormat.format(response['discount_price'].toFixed()))
                    selector.totalPaymentText.text(numberFormat.format(response['total_payment'].toFixed()))
                    selector.totalPaymentInput.attr('value', response['total_payment'])
                    selector.isSale.attr('value', '1')
                    selector.discountPriceInput.attr('value', response['discount_price'])
                    selector.voucher.attr('value', response['voucher_id'])
                } else {
                    selector.discountPriceText.text(response['discount_price'])
                    selector.totalPaymentText.text(numberFormat.format(totalPrice))
                    selector.totalPaymentInput.attr('value', totalPrice)
                    selector.isSale.attr('value', '0')
                    selector.discountPriceInput.attr('value', '')
                    selector.voucher.attr('value', '')
                }
            })
        })
    }

    submitOrder() {
        let orderForm = this.element.orderForm
        this.element.submitOrder.click(function () {
            let confirmed = confirm('Check your order again before submit!')
            if (confirmed) {
                orderForm.submit()
                localStorage.removeItem('cart')
            }
        })
    }
}

export default new Create()

class Voucher {
    constructor() {
        this.config()
        this.listen()
    }

    config() {
        this.element = {
            isSale            : $('.is-sale'),
            voucher           : $('.voucher'),
            discountPriceInput: $('.discount-price'),
            totalPaymentInput : $('.total-payment'),
            discountPriceText : $('#discountPrice'),
            totalPaymentText  : $('#totalPayment'),
            voucherCodeField  : $('#voucherCode'),
            totalPrice        : $('#totalPrice'),
        }
    }

    listen() {
        this.checkVoucher()
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
}

export default new Voucher()

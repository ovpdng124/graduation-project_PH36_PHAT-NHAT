import '../bootstrap'
import GetProduct from "./get_product"

class ListCart {
    constructor() {
        this.listCart()
    }

    listCart() {
        GetProduct.getProducts()
    }
}

export default new ListCart()

<template>
  <div class="container" style="max-width: 500px;">
    <a href="/products-table">Products List</a><br>
    <a href="/add-product">Add Product</a><br>

    <form id="addProductForm" class="form-group">
      Product Name
      <input class="form-control" type="text" v-model="formData.name" />
      Category
        <select class="form-control"  type="text" v-model="formData.category">
            <option value="Food">Food</option>
            <option value="Clothing">Clothing</option>
            <option value="Furniture">Furniture</option>
            <option value="Hygienic">Hygienic</option>
        </select>
      Price
      <input class="form-control" type="number" v-model="formData.price" />
      <button @click="editProduct()">Edit Product</button>
    </form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      productId: '',
      formData: {
        name: '',
        category: '',
        price: 0
      }
    };
  },
  props: [
      'myProductId'
  ],
  methods: {
    getProduct() {
      this.productId = this.myProductId;
      axios
        .get(
          "/product/" + this.productId,
          this.productId
        )
        .then(
          response => (
            /* eslint-disable no-console */
            console.log(response),
            (this.formData.name = response.data.name),
            (this.formData.category = response.data.category),
            (this.formData.price = response.data.price)
          )
        );
    },
    editProduct() {
      /* eslint-disable no-console */
      console.log(this.formData);
      axios
        .put("/product/" + this.productId, this.formData)
        .then(response =>
          /* eslint-disable no-console */
          console.log(response)
        );
    }
  },
  beforeMount() {
    this.getProduct();
  },
  computed: {}
};
</script>
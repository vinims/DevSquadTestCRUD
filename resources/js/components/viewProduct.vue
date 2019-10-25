<template>
  <div class="container" style="max-width: 500px;">
    <a href="/products-table">Products List</a><br>
    <a href="/add-product">Add Product</a><br>
<div class="card" style="width: 18rem;">
  <img v-bind:src="imageUrl" class="card-img-top">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Name: {{name}}</li>
    <li class="list-group-item">Category: {{category}}</li>
    <li class="list-group-item">Price: ${{price}}</li>
  </ul>
</div>

  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      productId: '',
      name: '',
      category: '',
      imageUrl:'',
      price: 0
    };
  },
  props: [
      'myProductId'
  ],
  methods: {
    getProduct() {
        this.productId = this.myProductId;
      axios
        .get("/product/" + this.productId, this.productId)
        .then(response => (
          /* eslint-disable no-console */
          console.log(response),
          this.name = response.data.name,
          this.category = response.data.category,
          this.imageUrl = response.data.imageUrl,
          this.price = response.data.price
          )
        );
    }
  },
  beforeMount() {
    this.getProduct();
  },
  computed: {}
};
</script>
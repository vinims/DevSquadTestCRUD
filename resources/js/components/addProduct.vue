<template>
  <div class="container" style="max-width: 500px;">
          <a href="/products-table">Products List</a><br>
    <form id="addProductForm" class="form-group">
        Product Name
        <input  class="form-control"  type="text" v-model="formData.name" />
        Category
        <select class="form-control"  type="text" v-model="formData.category">
            <option value="Food">Food</option>
            <option value="Clothing">Clothing</option>
            <option value="Furniture">Furniture</option>
            <option value="Hygienic">Hygienic</option>
        </select>
        Price
        <input  class="form-control"  type="number" v-model="formData.price" />
        Img Url
        <input  class="form-control"  type="text" v-model="formData.imageUrl" />
    <button @click="onSubmit()" v-on:submit.prevent="onSubmit">Add Product</button>
    </form>
  </div>
</template>
<script> 
import axios from "axios";
export default {
  data() {
    return {
        formData: {
          name: '',
          category: '',
          price: 0,
          imageUrl: '',
          }
    };
  },
  methods: {
    onSubmit () {
      if (this.formData.imageUrl == '') {
        this.formData.imageUrl = 'No Image Added'
      }
          /* eslint-disable no-console */
        console.log(this.formData);
      axios.post("/product", 
            this.formData
        ).then(
        response => (
          /* eslint-disable no-console */
          console.log(response)
        )
      );
    },
  },
  computed: {}
};
</script>
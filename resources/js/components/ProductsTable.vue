<template>
  <div>
    <div>
      <a href="/add-product">Add Product</a>

      <b-col lg="6" class="my-1">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              v-model="filter"
              type="search"
              id="filterInput"
              placeholder="Type to Search"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-table
        striped
        hover
        :items="products"
        :fields="fields"
        :sort-by.sync="sortBy"
        :per-page="perPage"
        :current-page="currentPage"
        :filter="filter"
        :filterIncludedFields="filterOn"
      >
        <template v-slot:cell(actions)="row">
          <a :href="'/view-product/' + row.item.id" >View</a> - 
          <a :href="'/edit-product/' + row.item.id" >Edit</a> - 
          <a @click="removeProduct(row.item)" >Remove</a>
        </template>
      </b-table>

      <b-pagination
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="my-table"
      ></b-pagination>

    </div>
  </div>
</template>

<script>
import axios from "axios";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
export default {
  data() {
    return {
      sortBy: "name",
      fields: [
        "name",
        "category",
        "price",
        { key: "actions", label: "Actions" }
      ],
      products: [
        {
          name: "",
          category: "",
          price: ""
        }
      ],
      perPage: 10,
      currentPage: 1,
      filter: null,
      filterOn: []
    };
  },
  methods: {
    getProducts() {
      axios.get("/products").then(
        response => (
          /* eslint-disable no-console */
          console.log(response), (this.products = response.data)
        )
      );
    },
    removeProduct(item) {
      axios
        .delete("/product/" + item.id, item.id)
        .then(
          response => (
            /* eslint-disable no-console */
            console.log(response), this.getProducts()
          )
        );
    }
  },
  beforeMount() {
    this.getProducts();
  },
  computed: {
    rows() {
      return this.products.length;
    }
  }
};
</script>
<style>
  a {
    color: blue;
  }
</style>
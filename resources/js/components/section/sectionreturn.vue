<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">Depreciated stocks</h5>
        </div>
        <div class="col-md-6 text-end"></div>
      </div>

      <table class="table text-center">
        <thead>
          <tr>
            <th scope="col">Item</th>
            <th scope="col">Description of item</th>
            <th scope="col">Depreciated Quantity</th>

            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="stock in depreciated_stock.data" :key="stock.id">
            <td>{{ stock.item_name }}</td>

            <td>{{ stock.description_item }}</td>

            <td>{{ stock.deprecated_quantity }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target="#viewstock"
                @click="view_depreciated_stock(stock)"
              >
                view
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <pagination
        :data="depreciated_stock"
        :limit="3"
        align="right"
        @pagination-change-page="get_depreciated_stock"
      ></pagination>
    </div>

    <!-- Modal -->

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="viewstock"
      tabindex="-1"
      role="dialog"
      aria-labelledby="viewstockTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header"></div>
          <div class="modal-body">
            <view-depreciated-stock> </view-depreciated-stock>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";

export default {
  data() {
    return {
      depreciated_stock: {},
    };
  },

  created() {
    this.get_depreciated_stock();
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_depreciated_stock(stock) {
      bus.$emit("depreciated-stock", stock);
    },

    get_depreciated_stock(page = 1) {
      axios
        .get("/depreciateddetails?page=" + page)
        .then((response) => (this.depreciated_stock = response.data));
    },
  },
};
</script>

<style>
</style>
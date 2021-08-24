<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">Kardex Book</h5>
        </div>
        <div class="col-md-6 text-end"></div>
      </div>

      <table class="table text-center table-hover">
        <thead>
          <tr>
            <th scope="col">GIR Page</th>

            <th scope="col">Supplier Name</th>
            <th scope="col">Item</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Purchase Order</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="stocks in kardex_stocks.data" :key="stocks.id">
            <td>{{ stocks.gir_page_no }}</td>

            <td>{{ stocks.supplier_name }}</td>

            <td>{{ stocks.item_name }}</td>

            <td>{{ stocks.invoice }}</td>

            <td>{{ stocks.purchase_order_no }}</td>

            <td>{{ stocks.quantity }}</td>

            <td>{{ stocks.price }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target=".viewkardex"
                @click="view_kardex_stocks(stocks)"
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
        :data="kardex_stocks"
        @pagination-change-page="get_kardex_stocks"
      ></pagination>
    </div>
    <!-- Modal -->

    <div
      class="modal fade viewkardex"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <view-kardex-stock> </view-kardex-stock>
        </div>
      </div>
    </div>

    <!-- Modal -->
  </div>
</template>

<script>
import moment from "moment";

export default {
  data() {
    return {
      kardex_stocks: {},
    };
  },

  created() {
    this.get_kardex_stocks();
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_kardex_stocks(stocks) {
      bus.$emit("kardex-stock", stocks);
    },

    get_kardex_stocks(page = 1) {
      axios
        .get("/kardexdetails?page=" + page)
        .then((response) => (this.kardex_stocks = response.data));
    },
  },
};
</script>

<style>
</style>
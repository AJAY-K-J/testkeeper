<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">Confiremd Items</h5>
        </div>
        <div class="col-md-6 text-end"></div>
      </div>

      <table class="table text-center table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>

            <th scope="col">Date</th>
            <th scope="col">Item</th>
            <th scope="col">Description of item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Approved Quantity</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Remarks</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="confirmed in confirmed_details.data" :key="confirmed.id">
            <td>{{ confirmed.id }}</td>

            <td>{{ convert_date(confirmed.date) }}</td>

            <td>{{ confirmed.item_name }}</td>

            <td>{{ confirmed.description_item }}</td>

            <td>{{ confirmed.quantity }}</td>
            <td>{{ confirmed.approvedquantity }}</td>

            <td>{{ confirmed.invoice }}</td>

            <td>{{ confirmed.remarks }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target=".confirmedPageview"
                @click="view_confirmed(confirmed)"
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
        :data="confirmed_details"
        @pagination-change-page="get_confirmed_details"
        :limit="3"
        align="right"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade confirmedPageview"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <confirmedPage-view> </confirmedPage-view>
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
      confirmed_details: {},
    };
  },

  created() {
    this.get_confirmed_details();
    var aj = this;
    bus.$on("addedGIR", function () {
      aj.get_confirmed_details();
    });

    bus.$on("item-added", function () {
      aj.get_confirmed_details();
    });
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_confirmed(confirmed) {
      bus.$emit("confirmed-details", confirmed);
    },

    get_confirmed_details(page = 1) {
      axios
        .get("/confirmedDetails?page=" + page)
        .then((response) => (this.confirmed_details = response.data));
    },
  },
};
</script>

<style>
</style>
<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">pending Confirmation</h5>
        </div>
        <div class="col-md-6 text-end"></div>
      </div>

      <table class="table text-center">
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
          <tr v-for="manager in manager_details.data" :key="manager.id">
            <td>{{ manager.id }}</td>

            <td>{{ convert_date(manager.date) }}</td>

            <td>{{ manager.item_name }}</td>

            <td>{{ manager.description_item }}</td>

            <td>{{ manager.quantity }}</td>

            <td>{{ manager.approvedquantity }}</td>

            <td>{{ manager.invoice }}</td>

            <td>{{ manager.remarks }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target=".view"
                @click="view_arrival(manager)"
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
        :data="manager_details"
        @pagination-change-page="get_manager_details"
        :limit="3"
        align="right"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade view"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <manager-view-arrival> </manager-view-arrival>
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
      manager_details: {},
    };
  },

  created() {
    this.get_manager_details();

    var aj = this;

    bus.$on("manager-response", function () {
      aj.get_manager_details();
    });
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_arrival(manager) {
      bus.$emit("store-data", manager);
    },

    get_manager_details(page = 1) {
      axios
        .get("/manager-details?page=" + page)
        .then((response) => (this.manager_details = response.data));
    },
  },
};
</script>

<style>
</style>
<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">Gem Arrivals Book</h5>
        </div>
        <div class="col-md-6 text-end"></div>
      </div>

      <table class="table text-center table-striped mt-4">
        <thead>
          <tr>
            <th scope="col">#</th>

            <th scope="col">Date</th>
            <th scope="col">Item</th>
            <th scope="col">Description of item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Invoice</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="GemArrival in GemArrival_details.data"
            :key="GemArrival.id"
          >
            <td>{{ GemArrival.product_id }}</td>

            <td>{{ convert_date(GemArrival.date) }}</td>

            <td>{{ GemArrival.item_name }}</td>

            <td>{{ GemArrival.description_item }}</td>

            <td>{{ GemArrival.quantity }}</td>

            <td>{{ GemArrival.invoice }}</td>

            <td v-if="GemArrival.gemstatus == 0">
              <span class="gemstatusPending">Approval Pending</span>
            </td>
            <td v-if="GemArrival.gemstatus == 1">
              <span class="gemstatusApproved">Approved</span>
            </td>
            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target=".GemArrivalview"
                @click="view_GemArrival(GemArrival)"
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
        :data="GemArrival_details"
        :limit="3"
        align="right"
        @pagination-change-page="get_GemArrival_details"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade GemArrivalview"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLarGemArrivalmodalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <view-GemArrival> </view-GemArrival>
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
      GemArrival_details: {},
    };
  },

  created() {
    this.get_GemArrival_details();
    var aj = this;

    bus.$on("GemArrival-confirmed", function () {
      aj.get_GemArrival_details();
    });
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_GemArrival(GemArrival) {
      bus.$emit("GemArrival-details", GemArrival);
    },

    get_GemArrival_details(page = 1) {
      axios
        .get("/GemArrival-details?page=" + page)
        .then((response) => (this.GemArrival_details = response.data));
    },
  },
};
</script>

<style>
.gemstatusPending {
  color: rgb(219, 25, 11);
  font-weight: bold;
}

.gemstatusApproved {
  color: rgb(15, 85, 6);
  font-weight: bold;
}
</style>
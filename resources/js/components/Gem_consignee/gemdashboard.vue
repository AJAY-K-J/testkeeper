<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">pending Confirmation</h5>
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
            <th scope="col">Remarks</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="gem in consignee_details.data" :key="gem.id">
            <td>{{ gem.product_id }}</td>

            <td>{{ convert_date(gem.date) }}</td>

            <td>{{ gem.item_name }}</td>

            <td>{{ gem.description_item }}</td>

            <td>{{ gem.quantity }}</td>

            <td>{{ gem.invoice }}</td>

            <td>{{ gem.remarks }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target=".consigneeview"
                @click="view_consignee(gem)"
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
        :data="consignee_details"
        :limit="3"
        align="right"
        @pagination-change-page="get_consignee_details"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade consigneeview"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <view-consignee> </view-consignee>
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
      consignee_details: {},
    };
  },

  created() {
    this.get_consignee_details();
    var aj = this;

    bus.$on("consignee-confirmed", function () {
      aj.get_consignee_details();
    });
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_consignee(gem) {
      bus.$emit("consignee-details", gem);
    },

    get_consignee_details(page = 1) {
      axios
        .get("/consignee-details?page=" + page)
        .then((response) => (this.consignee_details = response.data));
    },
  },
};
</script>

<style>
</style>
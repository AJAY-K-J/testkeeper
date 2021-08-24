<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">Arrival Book</h5>
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
            <th scope="col">Invoice No</th>
            <th scope="col">Remarks</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="element in store_details.data" :key="element.id">
            <td>{{ element.id }}</td>

            <td>{{ convert_date(element.date) }}</td>

            <td>{{ element.item_name }}</td>

            <td>{{ element.description_item }}</td>

            <td>{{ element.quantity }}</td>

            <td>{{ element.invoice }}</td>

            <td>{{ element.remarks }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target=".view"
                @click="view_store(element)"
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
        :data="store_details"
        @pagination-change-page="get_store_details"
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
          <store-view-arrival> </store-view-arrival>
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
      store_details: {},
    };
  },

  created() {
    this.get_store_details();
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_store(element) {
      bus.$emit("arrival-data", element);
    },

    get_store_details(page = 1) {
      axios
        .get("/store-details?page=" + page)
        .then((response) => (this.store_details = response.data));
    },
  },
};
</script>

<style>
</style>
<template>
  <div class="container-fluid p-3">
    <div class="table-responsive-sm">
      <table class="table text-center table-info" id="exportTable">
        <thead>
          <tr>
            <th scope="col">#</th>

            <th scope="col">Date</th>
            <th scope="col">Item</th>
            <th scope="col">Description of item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Remarks</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="details in export_details.data" :key="details.id">
            <td>{{ details.id }}</td>

            <td>{{ convert_date(details.date) }}</td>

            <td>{{ details.item_name }}</td>

            <td>{{ details.description_item }}</td>

            <td>{{ details.quantity }}</td>
            <td>{{ details.price }}</td>

            <td>{{ details.invoice }}</td>

            <td>{{ details.remarks }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      export_details: {},
    };
  },

  created() {
    var ex = this;

    ex.export_details = {};

    bus.$on("export-details", function (arrivalData) {
      ex.export_details = arrivalData;
      $(document).ready(function () {
        $("#exportTable").DataTable({
          dom: "Bfrtip",
          pageLength: 5,
          buttons: ["copy", "csv", "excel", "pdf", "print"],
        });
      });
    });

    bus.$on("export-close", function () {
      $(document).ready(function () {
        $("#exportTable").DataTable().destroy();
      });
    });
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
  },
};
</script>

<style>
</style>
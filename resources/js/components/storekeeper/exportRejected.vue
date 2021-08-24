<template>
  <div class="container-fluid p-3">
    <div class="table-responsive-sm">
      <table class="table text-center table-info" id="rejectedExportTable">
        <thead>
          <tr>
            <th scope="col">#</th>

            <th scope="col">Date</th>
            <th scope="col">Item</th>
            <th scope="col">Description of item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Rejected Quantity</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Disposed Status</th>
            <th scope="col">Remarks</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="rejected in rejected_details" :key="rejected.id">
            <td>{{ rejected.id }}</td>

            <td>{{ convert_date(rejected.date) }}</td>

            <td>{{ rejected.item_name }}</td>

            <td>{{ rejected.description_item }}</td>

            <td>{{ rejected.quantity }}</td>
            <td>{{ rejected.rejectedquantity }}</td>

            <td>{{ rejected.invoice }}</td>

            <td v-if="rejected.disposedstatus == 0">
              <span class="spanPending">Pending</span>
            </td>
            <td v-if="rejected.disposedstatus == 1">
              <span class="spandisposed">Disposed</span>
            </td>
            <td>{{ rejected.remarks }}</td>
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
      rejected_details: {},
    };
  },

  created() {
    var ex = this;

    ex.rejected_details = {};

    bus.$on("export-rejected", function (export_rejected_details) {
      ex.rejected_details = export_rejected_details;

      $(document).ready(function () {
        $("#rejectedExportTable").DataTable({
          dom: "Bfrtip",
          pageLength: 5,
          buttons: ["copy", "csv", "excel", "pdf", "print"],
        });
      });
    });

    bus.$on("export-rejected-close", function () {
      $(document).ready(function () {
        $("#rejectedExportTable").DataTable().destroy();
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
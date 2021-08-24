<template>
  <div class="container-fluid p-3">
    <div class="table-responsive-sm">
      <table class="table text-center table-info" id="sectionStockExportTable">
        <thead>
          <tr>
            <th scope="col">Item</th>
            <th scope="col">Description of item</th>
            <th scope="col">Quantity in Section</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="stocks in stock_details" :key="stocks.id">
            <td>{{ stocks.item_name }}</td>

            <td>{{ stocks.description_item }}</td>

            <td>{{ stocks.quantity_stock }}</td>
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
      stock_details: {},
    };
  },

  created() {
    var ex = this;

    ex.stock_details = {};

    bus.$on("export-section-stock", function (export_section_stocks) {
      ex.stock_details = export_section_stocks;

      $(document).ready(function () {
        $("#sectionStockExportTable").DataTable({
          dom: "Bfrtip",
          pageLength: 5,
          buttons: ["copy", "csv", "excel", "pdf", "print"],
        });
      });
    });

    bus.$on("export-section-stock-close", function () {
      $(document).ready(function () {
        $("#sectionStockExportTable").DataTable().destroy();
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
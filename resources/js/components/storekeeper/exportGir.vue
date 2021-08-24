<template>
  <div class="container-fluid p-3">
    <div class="table-responsive-sm">
      <table class="table text-center table-info" id="GirExportTable">
        <thead>
          <tr>
            <th scope="col">GIR Page</th>

            <th scope="col">Supplier Name</th>
            <th scope="col">Item</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Purchase Order</th>
            <th scope="col">Category</th>
            <th scope="col">Quantity in Store</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="goods in gir_details" :key="goods.id">
            <td>{{ goods.gir_page_no }}</td>

            <td>{{ goods.supplier_name }}</td>

            <td>{{ goods.item_name }}</td>

            <td>{{ goods.invoice }}</td>

            <td>{{ goods.purchase_order_no }}</td>

            <td>{{ goods.category_book }}</td>

            <td>{{ goods.balance_quantity }}</td>
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
      gir_details: {},
    };
  },

  created() {
    var ex = this;

    ex.gir_details = {};

    bus.$on("export-gir", function (export_goods_details) {
      ex.gir_details = export_goods_details;

      $(document).ready(function () {
        $("#GirExportTable").DataTable({
          dom: "Bfrtip",
          pageLength: 5,
          buttons: ["copy", "csv", "excel", "pdf", "print"],
        });
      });
    });

    bus.$on("export-gir-close", function () {
      $(document).ready(function () {
        $("#GirExportTable").DataTable().destroy();
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
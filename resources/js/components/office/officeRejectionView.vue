<template>
  <div class="p-3">
    <div class="row">
      <h4 class="card-title text-center">
        <b>ITEM DETAILS </b>
      </h4>
      <div class="card-body align-items-center">
        <div class="row">
          <div class="col-md-3">
            <h5>Date</h5>
            <p>{{ convert_date(date) }}</p>
          </div>

          <div class="col-md-3">
            <h5>Name of Supplier</h5>
            <p>{{ Name_of_supplier }}</p>
          </div>

          <div class="col-md-3">
            <h5>Details of Supplier</h5>
            <p>{{ Details_of_supplier }}</p>
          </div>

          <div class="col-md-3">
            <h5>GST No</h5>
            <p>{{ gst }}</p>
          </div>
          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>Quantity</h5>
            <p>{{ Quantity }}</p>
          </div>

          <div class="col-md-3">
            <h5>Price</h5>
            <p>{{ Price }}</p>
          </div>

          <div class="col-md-3">
            <h5>Item Name</h5>
            <p>{{ Name_of_item }}</p>
          </div>

          <div class="col-md-3">
            <h5>Details of Item</h5>
            <p>{{ Descripction_of_item }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>Item Category</h5>
            <p>{{ category }}</p>
          </div>
          <div class="col-md-3">
            <h5>Invoice</h5>

            <p>{{ Invoice }}</p>
          </div>
          <div class="col-md-3">
            <h5>Invoice date</h5>
            <p>{{ convert_date(invoice_date) }}</p>
          </div>

          <div class="col-md-3">
            <h5>DC No</h5>

            <p>{{ DC_no }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>DC Date</h5>
            <p>{{ convert_date(DC_date) }}</p>
          </div>
          <div class="col-md-3">
            <h5>Section</h5>

            <p>{{ section }}</p>
          </div>
          <div class="col-md-3">
            <h5>Entry Type</h5>
            <p>{{ entry }}</p>
          </div>

          <div class="col-md-3">
            <h5>GIR Page No</h5>

            <p>{{ gir_page_no }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-12">
            <h5>Remarks</h5>
            <p>{{ Remarks }}</p>
          </div>

          <hr />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  created() {
    var np = this;
    bus.$on("rejection-details", function (rejection) {
      np.date = rejection.date;
      np.Name_of_supplier = rejection.supplier_name;
      np.Details_of_supplier = rejection.Details;
      np.Descripction_of_item = rejection.description_item;
      np.Name_of_item = rejection.item_name;
      np.Price = rejection.price;
      np.Invoice = rejection.invoice;
      np.DC_no = rejection.Dc_no;
      np.DC_date = rejection.Dc_date;
      np.Quantity = rejection.quantity;

      np.Remarks = rejection.remarks;

      np.gst = rejection.gst;
      np.section = rejection.section_name;
      np.entry = rejection.stock_type;
      np.invoice_date = rejection.invoice_date;
      np.category = rejection.category_name;
      np.gir_page_no = rejection.gir_page_no;
    });
  },
  data() {
    return {
      date: "",
      Name_of_supplier: "",
      Details_of_supplier: "",
      Descripction_of_item: "",
      Name_of_item: "",
      Price: "",
      Invoice: "",
      DC_no: "",
      DC_date: "",
      Quantity: "",
      Remarks: "",

      gst: "",
      section: "",
      entry: "",
      invoice_date: "",
      category: "",
      gir_page_no: "",
    };
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
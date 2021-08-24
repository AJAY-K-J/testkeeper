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
    bus.$on("gem-details", function (gem) {
      np.date = gem.date;
      np.Name_of_supplier = gem.supplier_name;
      np.Details_of_supplier = gem.Details;
      np.Descripction_of_item = gem.description_item;
      np.Name_of_item = gem.item_name;
      np.Price = gem.price;
      np.Invoice = gem.invoice;
      np.DC_no = gem.Dc_no;
      np.DC_date = gem.Dc_date;
      np.Quantity = gem.quantity;

      np.Remarks = gem.remarks;

      np.gst = gem.gst;
      np.section = gem.section_name;
      np.entry = gem.stock_type;
      np.invoice_date = gem.invoice_date;
      np.category = gem.category_name;
      np.gir_page_no = gem.gir_page_no;
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
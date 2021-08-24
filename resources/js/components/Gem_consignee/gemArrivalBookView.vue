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
            <p>{{ convert_date(product_date) }}</p>
          </div>

          <div class="col-md-3">
            <h5>Name of Supplier</h5>
            <p>{{ NameOfSupplier }}</p>
          </div>

          <div class="col-md-3">
            <h5>Details of Supplier</h5>
            <p>{{ DetailsOfSupplier }}</p>
          </div>

          <div class="col-md-3">
            <h5>GST No</h5>
            <p>{{ GstNo }}</p>
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
            <p>{{ ItemName }}</p>
          </div>

          <div class="col-md-3">
            <h5>Details of Item</h5>
            <p>{{ ItemDetails }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>Item Category</h5>
            <p>{{ ItemCategory }}</p>
          </div>
          <div class="col-md-3">
            <h5>Invoice</h5>

            <p>{{ Invoice }}</p>
          </div>
          <div class="col-md-3">
            <h5>Invoice date</h5>
            <p>{{ convert_date(InvoiceDate) }}</p>
          </div>

          <div class="col-md-3">
            <h5>DC No</h5>

            <p>{{ DcNo }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>DC Date</h5>
            <p>{{ convert_date(DcDate) }}</p>
          </div>
          <div class="col-md-3">
            <h5>Section</h5>

            <p>{{ Section }}</p>
          </div>
          <div class="col-md-3">
            <h5>Approved Quantity</h5>
            <p>{{ approvedquantity }}</p>
          </div>

          <div class="col-md-3">
            <h5>Arrival Page No</h5>

            <p>{{ ArrivalPageNo }}</p>
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
    var vm = this;
    bus.$on("GemArrival-details", function (GemArrival) {
      vm.id = GemArrival.product_id;
      vm.product_date = GemArrival.product_date;
      vm.NameOfSupplier = GemArrival.supplier_name;
      vm.DetailsOfSupplier = GemArrival.Details;
      vm.GstNo = GemArrival.gst;
      vm.Quantity = GemArrival.quantity;
      vm.Price = GemArrival.price;
      vm.ItemName = GemArrival.item_name;
      vm.ItemDetails = GemArrival.description_item;

      vm.ItemCategory = GemArrival.category_name;

      vm.Invoice = GemArrival.invoice;
      vm.InvoiceDate = GemArrival.invoice_date;
      vm.DcNo = GemArrival.Dc_no;
      vm.DcDate = GemArrival.Dc_date;
      vm.Section = GemArrival.section_name;
      vm.ArrivalPageNo = GemArrival.arrivals_page_no;
      vm.remarks = GemArrival.remarks;
      vm.approvedquantity = GemArrival.approvedquantity;
    });
  },
  data() {
    return {
      id: "",
      product_date: "",
      NameOfSupplier: "",
      DetailsOfSupplier: "",
      GstNo: "",
      Quantity: "",
      Price: "",
      ItemName: "",
      ItemDetails: "",
      ItemCategory: "",
      Invoice: "",
      InvoiceDate: "",
      DcNo: "",
      DcDate: "",
      Section: "",
      SectionApproved: "",
      StoreManagerApproved: "",
      ArrivalPageNo: "",
      remarks: "",
      approvedquantity: "",

      errors: {},
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
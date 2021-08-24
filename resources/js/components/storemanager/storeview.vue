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
            <h5>Details of supplier</h5>
            <p>{{ supplier_details }}</p>
          </div>

          <div class="col-md-3">
            <h5>Descripction of item</h5>
            <p>{{ descripction_item }}</p>
          </div>

          <div class="col-md-3">
            <h5>Name of item</h5>
            <p>{{ item_name }}</p>
          </div>
        </div>

        <hr />

        <div class="row">
          <div class="col-md-3">
            <h5>Quantity</h5>
            <p>{{ quantity }}</p>
          </div>
          <div class="col-md-3">
            <h5>Price</h5>
            <p>{{ price }}</p>
          </div>

          <div class="col-md-3">
            <h5>Invoice No</h5>
            <p>{{ invoice }}</p>
          </div>

          <div class="col-md-3">
            <h5>Remarks</h5>

            <p>{{ remarks }}</p>
          </div>

          <hr />
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <div class="form-group text-end">
          <button
            class="btn btn-secondary btn-sm float-right"
            data-dismiss="modal"
            ref="cancel_btn"
            type="button"
          >
            back
          </button>
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
    bus.$on("arrival-data", function (element) {
      vm.date = element.date;
      vm.remarks = element.remarks;
      vm.supplier_details = element.Details;
      vm.descripction_item = element.description_item;
      vm.item_name = element.item_name;
      vm.quantity = element.quantity;
      vm.price = element.price;
      vm.invoice = element.invoice;
      vm.id = element.id;
    });
  },
  data() {
    return {
      id: "",
      date: "",
      supplier_details: "",
      descripction_item: "",
      item_name: "",
      quantity: "",
      price: "",
      invoice: "",

      remarks: "",
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
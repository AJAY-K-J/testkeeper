<template>
  <div class="p-3">
    <div class="row">
      <h4 class="card-title text-center">
        <b>REJECTED ITEM DETAILS </b>
      </h4>
      <div class="card-body align-items-center">
        <div class="row">
          <div class="col-md-3">
            <h5>Date</h5>
            <p>{{ convert_date(lot.product_date) }}</p>
          </div>

          <div class="col-md-3">
            <h5>Details of supplier</h5>
            <p>{{ supplier_details }}</p>
          </div>

          <div class="col-md-3">
            <h5>Name of item</h5>
            <p>{{ item_name }}</p>
          </div>

          <div class="col-md-3">
            <h5>Descripction of item</h5>
            <p>{{ description_item }}</p>
          </div>
        </div>

        <hr />

        <div class="row">
          <div class="col-md-3">
            <h5>Quantity</h5>
            <p>{{ lot.quantity }}</p>
          </div>
          <div class="col-md-3">
            <h5>Approved Quantity</h5>
            <p>{{ lot.approvedquantity }}</p>
          </div>
          <div class="col-md-3">
            <h5>Rejected Quantity</h5>
            <p>{{ lot.rejectedquantity }}</p>
          </div>

          <div class="col-md-3">
            <h5>Price</h5>
            <p>{{ lot.price }}</p>
          </div>

          <hr />
        </div>
        <div class="row">
          <div class="col-md-3">
            <h5>Invoice No</h5>
            <p>{{ lot.invoice }}</p>
          </div>

          <div class="col-md-3">
            <h5>DC No</h5>
            <p>{{ lot.Dc_no }}</p>
          </div>

          <div class="col-md-3">
            <h5>Dc Date</h5>
            <p>{{ convert_date(lot.Dc_date) }}</p>
          </div>

          <div class="col-md-3">
            <h5>Remarks</h5>
            <p>{{ lot.remarks }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-12">
            <h5>Rejection Remarks</h5>
            <p>{{ lot.rejectionremarks }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <div v-if="lot.disposedstatus == 0" class="form-group text-end">
          <button
            class="btn btn-secondary btn-sm float-right"
            data-dismiss="modal"
            ref="cancel_btn"
            type="button"
          >
            Cancel
          </button>

          <button
            class="btn btn-danger mr-4 btn-sm float-right"
            type="submit"
            @click="disposed()"
          >
            <span class="disposedspan"> Item Disposed</span>
          </button>
        </div>

        <div v-else class="form-group text-end">
          <button
            class="btn btn-secondary btn-sm float-right"
            data-dismiss="modal"
            ref="cancel_btn"
            type="button"
          >
            Cancel
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
    var akku = this;
    bus.$on("rejected-details", function (rejected) {
      akku.supplier_details = rejected.Details;
      akku.description_item = rejected.description_item;
      akku.item_name = rejected.item_name;

      akku.lot.product_id = rejected.id;
      akku.lot.product_date = rejected.date;

      akku.lot.product_supplier_id = rejected.supplier_id;
      akku.lot.section_id = rejected.section_id;
      akku.lot.item_id = rejected.item_id;

      akku.lot.quantity = rejected.quantity;
      akku.lot.approvedquantity = rejected.approvedquantity;
      akku.lot.rejectedquantity = rejected.rejectedquantity;
      akku.lot.disposedstatus = rejected.disposedstatus;

      akku.lot.price = rejected.price;
      akku.lot.invoice = rejected.invoice;
      akku.lot.Dc_no = rejected.Dc_no;

      akku.lot.Dc_date = rejected.Dc_date;
      akku.lot.arrivals_page_no = rejected.arrivals_page_no;

      akku.lot.remarks = rejected.remarks;
      akku.lot.rejectionremarks = rejected.rejectionremarks;
    });
  },
  data() {
    return {
      item_name: "",
      supplier_details: "",
      description_item: "",

      lot: {
        product_id: "",
        product_date: "",
        product_supplier_id: "",
        section_id: "",
        item_id: "",
        quantity: "",
        approvedquantity: "",
        rejectedquantity: "",
        disposedstatus: "",
        price: "",
        invoice: "",
        Dc_no: "",
        Dc_date: "",
        arrivals_page_no: "",
        gir_page_no: "",
        category_book: "",
        category_book_page_no: "",
        purchase_order_no: "",
        purchase_order_date: "",
        remarks: "",
        rejectionremarks: "",
      },

      errors: {},
    };
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },

    disposed() {
      axios
        .post("./disposed/" + this.lot.product_id)
        .then((response) => {
          if (response.data == "Success") {
            Swal.fire("Confirmed!", "", "success");

            this.$refs.cancel_btn.click();
            bus.$emit("disposed");
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<style>
.disposedspan {
  font-weight: bold;
}
</style>
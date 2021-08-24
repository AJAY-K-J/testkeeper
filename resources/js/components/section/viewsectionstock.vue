<template>
  <div class="">
    <div class="row">
      <h4 class="card-title text-center">
        <b>ITEM DETAILS </b>
      </h4>
      <div class="card-body align-items-center">
        <div class="row">
          <div class="col">
            <h5>Item Name</h5>
            <p>{{ Dlist.itemName }}</p>
          </div>
          <div class="col">
            <h5>Description of Item</h5>
            <p>{{ Dlist.itemDec }}</p>
          </div>

          <hr />
        </div>
        <div class="row">
          <div class="col">
            <h5>Section Quantity</h5>
            <p>{{ Dlist.itemQuantity }}</p>
          </div>

          <div class="col">
            <h5>Depreciated Quantity</h5>
            <input
              type="number"
              class="form-control"
              placeholder="Depreciated Quantity"
              name="Depreciated_Quantity"
              v-model="Dlist.Depreciated_Quantity"
            />
            <small class="text-danger" v-if="errors.Depreciated_Quantity">{{
              errors.Depreciated_Quantity[0]
            }}</small>
          </div>
        </div>

        <hr />
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <div class="form-group text-end">
          <button
            class="btn btn-secondary btn-sm float-right b"
            data-dismiss="modal"
            ref="cancel_btn"
            type="button"
          >
            Cancel
          </button>

          <button
            class="btn btn-danger btn-sm float-right b"
            type="submit"
            @click="remove()"
          >
            Remove
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    var vm = this;
    bus.$on("section-stock", function (stocks) {
      vm.Dlist.productId = stocks.product_id;
      vm.Dlist.itemName = stocks.item_name;

      vm.Dlist.itemDec = stocks.description_item;
      vm.Dlist.itemQuantity = stocks.quantity_stock;

      vm.Dlist.item_id = stocks.item_id;
      vm.Dlist.section_name = stocks.section_name;
    });
  },
  data() {
    return {
      Dlist: {
        Depreciated_Quantity: "",
        productId: "",
        itemName: "",
        itemDec: "",
        itemQuantity: "",
        section_name: "",
        item_id: "",
      },

      errors: {},
    };
  },

  methods: {
    clear_data() {
      for (let cat in this.Dlist) {
        this.Dlist[cat] = null;
      }

      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },

    remove() {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("./section-deprecated/" + this.Dlist.productId, this.Dlist)
            .then((response) => {
              if (response.data == "Success") {
                Swal.fire("Removed!", "Your item has been removed.", "success");

                this.$refs.cancel_btn.click();
                this.clear_data();
              }

              if (response.data == "excessStock") {
                Swal.fire("Excess Quantity!", "", "error");
              }

              bus.$emit("item-deprecated");
            })
            .catch((error) => {
              this.errors = error.response.data.errors;
            });
        }
      });
    },
  },
};
</script>

<style>
</style>
<template>
  <div>
    <form method="post" @submit.prevent="allotitem()">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label>Balance Quantity</label>
            <p>{{ balance_quantity }}</p>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label>Section Name</label>

            <select
              class="form-control"
              name="section_name"
              v-model="items.section_name"
            >
              <option value="">Select Section</option>
              <option v-for="section in section_details" :key="section.id">
                {{ section.name }}
              </option>
            </select>

            <small class="text-danger" v-if="errors.section_name">{{
              errors.section_name[0]
            }}</small>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="quantity" class="control-label col-form-label"
              >Quantity</label
            >
            <div class="col-sm-9">
              <input
                type="number"
                class="form-control"
                id="quantity"
                name="quantity"
                v-model="items.quantity"
                placeholder="Quantity Here"
              />
            </div>

            <small class="text-danger" v-if="errors.quantity">{{
              errors.quantity[0]
            }}</small>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-12">
          <div class="form-group text-end">
            <button
              class="btn btn-secondary btn-sm float-right mr-2 b"
              data-dismiss="modal"
              ref="cancel_btn"
              type="button"
              @click="clear_data"
            >
              Cancel
            </button>
            <button class="btn btn-sm btn-success b float-right" type="submit">
              Confirm
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  created() {
    this.getsection();

    var amal = this;
    bus.$on("allot-goods", function (goods) {
      amal.balance_quantity = goods.balance_quantity;
      amal.items.product_id = goods.product_id;
      amal.items.item_id = goods.item_id;
    });
  },

  data() {
    return {
      balance_quantity: "",
      items: {
        product_id: "",
        item_id: "",
        section_name: "",
        quantity: "",
      },
      errors: {},
      section_details: [],
    };
  },

  methods: {
    clear_data() {
      for (let item in this.items) {
        this.items[item] = null;
      }

      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },

    allotitem() {
      axios
        .post("./allot_item", this.items)
        .then((response) => {
          if (response.data == "Success") {
            Swal.fire("New Item Added!", "", "success");

            this.$refs.cancel_btn.click();
            this.clear_data();
          }
          if (response.data == "excessQuantity") {
            Swal.fire("Excess Quantity!", "", "error");
          }

          bus.$emit("item-alloted");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    getsection() {
      axios
        .get("/getsection")
        .then((response) => (this.section_details = response.data));
    },
  },
};
</script>

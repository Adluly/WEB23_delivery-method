<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="mr40 mt20">
                    <router-link to="/list-delivery-method">
                        <img src="../../assets/icons/back.svg">
                    </router-link>
                </div>
                <div>
                    <h1 class="m0">Update Delivery Method</h1>
                    <p class="mt5 mb20 tc-green">Make your customers have many choices of delivery methods</p>
                </div>
            </div>
            <hr class="uline-grey">
            <div class="mt50 row">
                <div class="w20">
                    <label class="form-label">Delivery Type Image</label>
                </div>
                <div class="w80">
                    <input
                        class=""
                        type="file"
                    >
                </div>
            </div>
            <div class="mt0 row">
                <div class="w20">
                    <label class="form-label">Delivery Name</label>
                </div>
                <div class="w80">
                    <input
                        class="form-text"
                        type="text"
                        placeholder="Masukkan Delivery Name"
                        v-model="deliveryMethod.delivery_name"
                    >
                </div>
            </div>
            <div class="mt30 row">
                <div class="w20">
                    <label class="form-label">Delivery Fee</label>
                </div>
                <div class="w80">
                    <input
                        class="form-text"
                        type="text"
                        placeholder="Masukkan Delivery Fee"
                        v-model="deliveryMethod.delivery_fee"
                    >
                </div>
            </div>
            <div class="mt30 row">
                <div class="w20">
                    <label class="form-label">Estimation Delivery</label>
                </div>
                <div class="w80">
                    <input
                        class="form-text"
                        type="text"
                        placeholder="Masukkan Estimation Delivery"
                        v-model="deliveryMethod.estimation_delivery"
                    >
                </div>
            </div>
            <div class="flex mt30">
                <!-- <router-link :to="updateApiEndpoint"> -->
                    <button @click="updateDeliveryMethod" class="bt-submit-green">Update Delivery Method</button>
                <!-- </router-link> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'edit-delivery-method',
    data() {
        return {
            apiEndpoint: 'http://localhost/web23_team_5-main/backend/index.php',
            deliveryMethod: {
                id: null,
                delivery_name: '',
                delivery_fee: '',
                estimation_delivery: ''
            }
        };
    },
    created() {
        // Get the ID parameter from the URL when the component is created
        this.deliveryMethod.id = this.$route.params.id;

        // Fetch the default data from the API based on the ID
        this.fetchDefaultData();
    },
    methods: {
        fetchDefaultData() {
            // Fetch the default data from the API based on the ID
            fetch(`${this.apiEndpoint}?id=${this.deliveryMethod.id}`)
                .then(response => response.json())
                .then(data => {
                    // Update the deliveryMethod with the fetched data
                    this.deliveryMethod = data;
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        },
        updateDeliveryMethod() {
            // Assuming you want to send a PUT request with the updated data
            fetch(this.apiEndpoint, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.deliveryMethod)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Handle the response data as needed
                console.log(data);

                // You may want to update the default data after the update
                // this.fetchDefaultData();
                this.$router.push('/list-delivery-method');
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
        }
    }
}
</script>
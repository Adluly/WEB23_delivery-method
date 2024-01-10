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
                    <h1 class="m0">Add Delivery Method</h1>
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
                <button @click="addDeliveryMethod" class="bt-submit-green">Add Delivery Method</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'add-delivery-method',
    data() {
        return {
            apiEndpoint: 'http://localhost/web23_team_5-main/backend/index.php',
            deliveryMethod: {
                delivery_name: '',
                delivery_fee: '',
                estimation_delivery: ''
            }
        };
    },
    methods: {
        addDeliveryMethod() {
            // Assuming you want to send a POST request to add a new delivery method
            fetch(this.apiEndpoint, {
                method: 'POST',
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

                // Redirect to the desired route after a successful addition
                this.$router.push('/list-delivery-method');
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
        }
    }
}
</script>
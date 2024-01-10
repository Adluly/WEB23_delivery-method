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
                    <h1 class="m0">Detail Delivery Method</h1>
                    <p class="mt5 mb20 tc-green">Your delivery method details</p>
                </div>
            </div>
            <hr class="uline-grey">
            <div class="row">
                <div class="mr40 mt20">
                    <router-link to="/list-delivery-method">
                        <img :src="deliveryDetails.image" alt="Delivery Method Image">
                    </router-link>
                </div>
                <div class="mt50">
                    <p class="detail-title-bold">Delivery Name:</p>
                    <h2>{{ deliveryDetails.delivery_name }}</h2>

                    <p class="detail-title-bold" style="padding-top: 10%;">Delivery Fee:</p>
                    <p>{{ deliveryDetails.delivery_fee }}</p>

                    <p class="detail-title-bold" style="padding-top: 10%;">Estimation Delivery:</p>
                    <p>{{ deliveryDetails.estimation_delivery }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'detail-delivery-method',
    data() {
        return {
            deliveryDetails: {}
        };
    },
    created() {
        // Fetch data from the API using the route parameter
        const deliveryId = this.$route.params.id; // Use $route.params instead of $route.query

        if (deliveryId) {
            const apiUrl = `http://localhost/web23_team_5-main/backend/index.php?id=${deliveryId}`;

            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Update the deliveryDetails with the fetched data
                    this.deliveryDetails = data;
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        }
    }
};
</script>
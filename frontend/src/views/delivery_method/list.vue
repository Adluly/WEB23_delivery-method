<template>
    <div>
        <Menu/>
        <div class="container">
            <h1 class="m0">Delivery Method</h1>
            <div class="row">
                <div class="col">
                    <p class="mt5 mb20 tc-green">Manage your Delivery Methods for the convenience of your customers</p>
                </div>
                <div class="col flex">
                    <router-link to="/add-delivery-method">
                        <button class="bt-green">+ Add Delivery Method</button>
                    </router-link>
                </div>
            </div>
            <div class="row bg-blue mt10 p10">
                <div class="col">
                    <input
                        class="search-field"
                        type="text"
                        id="deskripsi"
                        placeholder="Masukkan pencarian disini"
                    />
                </div>
                <div class="col flex">
                    <button class="bt-blue">Filter</button>
                </div>
            </div>
            <div class="mt50">
                <table>
                    <thead>
                        <tr>
                            <th>DELIVERY NAME</th>
                            <th>DELIVERY FEE</th>
                            <th>ESTIMATION DELIVERY</th>
                            <th>DELIVERY TYPE IMAGE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item of list_delivery_method" :key="item.id">
                            <td class="center">{{ item.delivery_name }}</td>
                            <td class="center">{{ item.delivery_fee }}</td>
                            <td class="center">{{ item.estimation_delivery }}</td>
                            <td class="center">
                                <img :src="getImageSource(item.image)">
                            </td>
                            <td class="center">
                                <div class="mt5">
                                    <router-link :to="'/edit-delivery-method/' + item.id">
                                        <img src="../../assets/icons/edit.svg">
                                    </router-link>

                                </div>
                                <div class="mt5">
                                    <router-link :to="'/detail-delivery-method/' + item.id">
                                        <img src="../../assets/icons/detail.svg">
                                    </router-link>
                                </div>
                                <div class="mt5">
                                    <img src="../../assets/icons/delete.svg" @click="deleteDeliveryMethod(item.id)" style="cursor: pointer;">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import Menu from "../../components/menu-delivery-method.vue";

export default {
    name: 'list-delivery-method',
    components: {
        Menu
    },
    methods: {
        getImageSource(img) {
            if (img.startsWith('http') || img.startsWith('https')) {
                return img; // Remote URL
            } else {
                return require('../../assets/images/' + img);
            }
        },
        async fetchDataFromAPI() {
            try {
                const response = await fetch('http://localhost/web23_team_5-main/backend/index.php');
                if (response.ok) {
                    const data = await response.json();
                    this.list_delivery_method = data;
                } else {
                    console.error('Error fetching data from API:', JSON.stringify(response));
                    console.error('Failed to fetch data from API:', response.statusText);
                }
            } catch (error) {
                console.error('Error fetching data from API:', error.message);
            }
        },
        deleteDeliveryMethod(deliveryMethodId) {
            if (!deliveryMethodId) {
                console.error('Delivery method ID is not provided.');
                return;
            }

            // Assuming you want to send a DELETE request to delete a delivery method
            fetch(`http://localhost/web23_team_5-main/backend/index.php?id=${deliveryMethodId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                // You may include a request body if required by your API
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

                // Refresh the data after a successful deletion
                this.fetchDataFromAPI();
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
        }
    },
    data() {
        return {
            list_delivery_method: []
        };
    },
    created() {
        this.fetchDataFromAPI();
    }
};
</script>
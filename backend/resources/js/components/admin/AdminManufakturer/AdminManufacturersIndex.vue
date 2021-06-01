
<template>
    <div class="manufacturers">

        <div v-if="error" class="error">
            <p>{{ error }}</p>

            <p>
                <button @click.prevent="fetchData">
                    Try Again
                </button>
            </p>
        </div>
        <router-link :to="{ name: 'adminManufacturersCreate' }">Create</router-link>
        <ul v-if="manufacturers">
            <li v-for="{ id, name } in manufacturers">
                <strong>Name:</strong> {{ name }}
                <br>
                <router-link :to="{ name: 'adminManufacturersEdit', params: { id } }">Edit</router-link>
                <br>
                <router-link :to="{ name: 'adminManufacturersShow', params: { id } }">Show</router-link>
                <br>
                <button class="btn btn-danger" @click.prevent="onDelete(id)">Delete</button>

            </li>
        </ul>
    </div>
</template>
<script>

import api from '../../../api/routes';
export default {

    data() {
        return {
            manufacturers: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.manufacturers = null;
            this.loading = true;
            api.all('manufacturers').then((response) => {
                this.loaded = true;
                this.manufacturers = response.data;
            });

        },
        onDelete(id)
        {
            console.log(id);
            api.delete('manufacturers', id)
                .then((response) => {
                    this.$router.go(0);
                    setTimeout(() => console.log(id), 1000);
                });
        }
    }
}
</script>


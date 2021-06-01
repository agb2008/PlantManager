
<template>
    <div class="families">

        <div v-if="error" class="error">
            <p>{{ error }}</p>

            <p>
                <button @click.prevent="fetchData">
                    Try Again
                </button>
            </p>
        </div>
        <router-link :to="{ name: 'adminFamiliesCreate' }">Create</router-link>
        <ul v-if="families">
            <li v-for="{ id, name } in families">
                <strong>Name:</strong> {{ name }}
                <br>
                <router-link :to="{ name: 'adminFamiliesEdit', params: { id } }">Edit</router-link>
                <br>
                <router-link :to="{ name: 'adminFamiliesShow', params: { id } }">Show</router-link>
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
            families: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.families = null;
            this.loading = true;
            api.all('families').then((response) => {
                this.loaded = true;
                this.families = response.data;
            });

        },
        onDelete(id)
        {
            console.log(id);
            api.delete('families', id)
                .then((response) => {
                    this.$router.go();
                    setTimeout(() => console.log(id), 1000);
                });
        }
    }
}
</script>


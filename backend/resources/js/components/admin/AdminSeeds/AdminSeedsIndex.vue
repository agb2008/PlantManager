
<template>
    <div class="seeds">

        <div v-if="error" class="error">
            <p>{{ error }}</p>

            <p>
                <button @click.prevent="fetchData">
                    Try Again
                </button>
            </p>
        </div>
        <router-link :to="{ name: 'adminSeedsCreate' }">Create</router-link>
        <ul v-if="seeds">
            <li v-for="{ id, name } in seeds">
                <strong>Name:</strong> {{ name }}
                <br>
                <router-link :to="{ name: 'adminSeedsEdit', params: { id } }">Edit</router-link>
                <br>
                <router-link :to="{ name: 'seedsShow', params: { id } }">Show</router-link>
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
            seeds: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.seeds = null;
            this.loading = true;
            api.all('seeds').then((response) => {
                setTimeout(() => {
                    this.loaded = true;
                    this.seeds = response.data;
                    console.log(this.seeds);
                }, 1000);

            });

        },
        onDelete(id)
        {
            console.log(id);
            api.delete('seeds', id)
                .then((response) => {
                    this.message = 'Seed Deleted';
                    this.$router.go(0);
                });
        }
    }
}
</script>


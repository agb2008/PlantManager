<template>
    <div>
        <div v-if="message" class="alert">{{ message }}</div>
        <div v-if="! loaded">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else>
            <div class="form-group">
                <label >Name</label>
                <input  v-model="seed.name"/>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving">Update</button>
            </div>
        </form>
    </div>
</template>


<script>

import api from '../../../api/routes';
export default {
    data() {
        return {
            message: null,
            loaded: false,
            saving: false,
            seed: {
                id: null,
                name: "",
            }
        };
    },
    methods: {
        onSubmit(event) {
            this.saving = true;

            api.update('seeds', this.seed.id, {
                name: this.seed.name,
            }).then((response) => {
                this.message = 'Seed updated';
                setTimeout(() => this.message = null, 10000);
                this.seed = response.data;
            }).catch(error => {
                console.log(this.seed.id)
            }).then(_ => this.saving = false);
        }
    },
    created() {
        api.find('seeds', this.$route.params.id).then((response) => {
            setTimeout(() => {
                this.loaded = true;
                this.seed = response.data;
                console.log(this.seed);
            }, 1000);

        });

    }
};

</script>

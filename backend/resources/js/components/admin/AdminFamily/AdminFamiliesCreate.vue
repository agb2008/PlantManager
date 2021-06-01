<template>
    <div>
        <h3>Create</h3>
        <form @submit.prevent="onSubmit">
            <div>
                <label for="family_name">Name</label>
                <input id="family_name" v-model="family.name" class="border"/>
            </div>
            <div>
                <label for="family_desc">Description</label>
                <input id="family_desc" v-model="family.description" class="border"/>
            </div>
            <div>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>

</template>

<script>
import api from '../../../api/routes';
export default {
    data() {
        return {
            family: {
                name: '',
                description: ''
            }
        }
    },
    methods: {
        onSubmit() {
            console.log(this.family);
            api.create('families', this.family)
                .then((response) => {
                    this.$router.push({ name: 'adminFamilies'});
                })
                .catch((e) => {
                    this.message = e.response.data.message || 'There was an issue creating the seed.';
                })
                .then(() => this.saving = false)
        }
    }
}
</script>

<style scoped>

</style>

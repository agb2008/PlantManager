<template>
    <form @submit.prevent="onSubmit($event)" v-else>
        <div class="form-group">
            <label for="seeds_name">Name</label>
            <input id="seeds_name" v-model="seeds.name" />
        </div>
        <div class="form-group">
            <button type="submit" :disabled="saving">Update</button>
        </div>
    </form>
</template>

<script>

export default {
    name: "AdminPlantsIndex"
}
</script>

<style scoped>

</style>

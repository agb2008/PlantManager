<template>
    <div>
        <h3>Просмотр - {{this.family.name}}</h3>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Создано</th>
                    <th>Обновлено</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{this.family.id}}</td>
                    <td>{{this.family.name}}</td>
                    <td>{{this.family.description}}</td>
                    <td>{{this.family.created_at}}</td>
                    <td>{{this.family.updated_at}}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <router-link :to="{ name: 'adminFamiliesEdit', params: this.family.id }">Edit</router-link>
        <button class="btn btn-danger" @click.prevent="onDelete">Delete</button>
    </div>
</template>

<script>
import api from '../../../api/routes';

export default {
    data() {
        return {
            family: {
                id: "",
                name: "",
                description: "",
                created_at: "",
                updated_at: ""
            }
        };
    },
    created() {
        api.find('families', this.$route.params.id)
        .then((response) => {
            this.family = response.data;
        });
    },
    methods: {
        onDelete() {
            api.delete('families', this.family.id)
            .then((response) => {
                this.$router.push({ name: 'adminFamilies' });
            });
        }
    }

}
</script>

<style scoped>

</style>

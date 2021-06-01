<template>
    <div>
        <h3>Редактирование - {{ family.name }}</h3>
        <div v-if="message" class="alert">{{ message }}</div>
        <div v-if="! loaded">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else>
            <div class="form-group">
                <label for="name">Имя</label>
                <input  id="name" v-model="family.name"/>
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="" id="description" cols="30" rows="10" v-model="family.description">{{ family.description }}</textarea>

            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving">Сохранить</button>
            </div>
            <div>
                <button class="btn btn-danger" @click.prevent="onDelete">Удалить</button>
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
            family: {
                id: null,
                name: "",
                description: ""
            }
        };
    },
    created() {
        api.find('families', this.$route.params.id).then((response) => {
            setTimeout(() => {
                this.loaded = true;
                this.family = response.data;
            }, 1000);

        })
    },
    methods: {
        onSubmit(event) {
            this.saving = true;

            api.update('families', this.family.id, {
                name: this.family.name,
                description: this.family.description
            }).then((response) => {
                this.message = 'Обновлено';
                this.family = response.data;
                this.$router.go();
            }).catch(error => {
                console.log(this.family.id)
            }).then(_ => this.saving = false);
        },
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

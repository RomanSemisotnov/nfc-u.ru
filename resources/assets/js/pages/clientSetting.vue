<template>
    <div>
        <client-nav-bar></client-nav-bar>


        <el-form ref="form" :model="form" label-width="200px">

            <el-row :gutter="24">
                <el-col :offset="3" :span="14">
                    <el-form-item label="Имя Клиента">
                        <el-input v-model="client.name"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row :gutter="24">
                <el-col :offset="3" :span="14">
                    <el-form-item label="Поддоменное имя">
                        <el-input v-model="client.subdomain"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row :gutter="24">
                <el-col :offset="9" :span="8">
                    <el-button :loading="isUpdate" @click="update()" type="primary" round>Обновить</el-button>
                </el-col>
            </el-row>

        </el-form>


    </div>
</template>

<script>
    import axios from 'axios';
    import clientNavBar from './../components/clientNavBar';

    export default {
        components: {
            clientNavBar
        },
        data() {
            return {
                client: {},
                isUpdate: false
            }
        },
        created() {
            this.getClient();
        },
        methods: {
            getClient() {
                axios.get('/api/client/' + this.$route.params.name).then(response => {
                    this.client = response.data;
                }).catch(reason => {
                    this.$message.error('Не удалось получить клиента ' + this.$route.params.name);
                })
            },
            update() {
                this.isUpdate = true;
                axios.post('/api/client/update/' + this.client.id, this.client).then(response => {
                    this.isUpdate = false;
                    this.$message.success('Успешно обновленно');
                    this.$router.push({path: '/client/' + this.client.name + '/setting'});
                }).catch(reason => {
                    this.isUpdate = false;
                    this.$message.error('Не удалось обновить клиента');
                })
            }
        },
        watch: {
            '$route'(to, from) {
                this.getClient();
            },
        }
    }
</script>

<style scoped>

</style>
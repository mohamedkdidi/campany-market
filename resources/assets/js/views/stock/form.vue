<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{title}}
        </div>
        <div class="panel-body">
            <form class="form" @submit.prevent="save">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" v-model="form.address"></textarea>
                            <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" v-model="form.email">
                            <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" v-model="form.phone">
                            <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                        </div>
                    </div>
                </div>
                <button class="btn btn-warning btn-sm" @click="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> List</button>
                <button class="btn btn-success btn-sm"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
            </form>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: 'StockForm',
        data() {
            return {
                form: {},
                errors: {},
                option: {},
                title: 'New Stock',
                initialize: '/api/stock/create',
                redirect: '/stock',
                store: '/api/stock',
                method: 'post'
            }
        },
        beforeMount() {
            if(this.$route.meta.mode === 'edit') {
                this.title = 'Edit'
                this.initialize = '/api/stock/' + this.$route.params.id + '/edit'
                this.store = '/api/stock/' + this.$route.params.id
                this.method = 'put'
            }
            this.fetchData()
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            fetchData() {
                var vm = this
                axios.get(this.initialize)
                    .then(function(response) {
                        Vue.set(vm.$data, 'form', response.data.form)
                        Vue.set(vm.$data, 'option', response.data.option)
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            back(){
                var vm = this
                vm.$router.push(vm.redirect)
            },
            save() {
                var vm = this
                axios[this.method](this.store, this.form)
                    .then(function(response) {
                        if(response.data.saved) {
                            vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        Vue.set(vm.$data, 'errors', error.response.data)
                    })
            }
        }
    }
</script>
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
                            <label>Company name</label>
                            <input type="text" class="form-control" v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <select class="form-control" v-model="form.stock_id">
                                <option>Select</option>
                                <option v-for="stock in option.stocks" :value="stock.id">
                                    {{stock.company}} / {{stock.name}}
                                </option>
                            </select>
                            <small class="text-danger" v-if="errors.stock_id">{{errors.stock_id[0]}}</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Price entered date</label>
                            <input type="date" class="form-control" v-model="form.entered_date">
                            <small class="text-danger" v-if="errors.entered_date">{{errors.entered_date[0]}}</small>
                        </div>
                        <div class="form-group">
                            <label>Price entered time</label>
                            <input type="time" class="form-control" v-model="form.entered_time">
                            <small class="text-danger" v-if="errors.entered_time">{{errors.entered_time[0]}}</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="float" class="form-control" v-model="form.price"></textarea>
                            <small class="text-danger" v-if="errors.price">{{errors.price[0]}}</small>
                        </div>
                         <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" v-model="form.type">
                                <option>
                                    common stock
                                </option>
                                <option>
                                    preferred stock 
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: 'ProfilesForm',
        data() {
            return {
                form: {
                    items: []
                },
                errors: {},
                option: {
                    stocks: []
                },
                title: 'Create',
                initialize: '/api/profile/create',
                redirect: '/profile',
                store: '/api/profile',
                method: 'post'
            }
        },
        beforeMount() {
            if(this.$route.meta.mode === 'edit') {
                this.title = 'Edit'
                this.initialize = '/api/profile/' + this.$route.params.id + '/edit'
                this.store = '/api/profile/' + this.$route.params.id
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
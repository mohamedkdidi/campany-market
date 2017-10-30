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
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" class="form-control" v-model="form.email">
                            <small class="text-danger" v-if="errors.email   ">{{errors.email[0]}}</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" v-model="form.address">
                            <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Price entered date</th>
                            <th>Price entered time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in form.items">
                            <td>
                            <select class="form-control" v-model="form.stock_id">
                                <option>Select</option>
                                <option v-for="stock in option.stocks" :value="stock.id">
                                    {{stock.name}} 
                                </option>
                            </select>
                            <small class="text-danger" v-if="errors.stock_id">{{errors.stock_id[0]}}</small>
                            </td>
                            <td>
                            <input type="float" v-model="item.price" class="form-control">
                            <small class="text-danger" v-if="errors.price">{{errors.price[0]}}</small>
                            </td>
                            <td>
                            <select class="form-control" v-model="form.type">
                                <option>
                                    Common stock
                                </option>
                                <option>
                                    Preferred stock 
                                </option>
                            </select></td>
                            <td>
                                <input type="date" v-model="item.entered_date" class="form-control">
                                <small class="text-danger" v-if="errors.entered_date">{{errors.entered_date[0]}}</small>
                            </td>
                            <td>
                                <input type="time" v-model="item.entered_time" class="form-control">
                                <small class="text-danger" v-if="errors.entered_time">{{errors.entered_time[0]}}</small>
                            </td>
                            <td>
                                <button type="button" @click="form.items.splice(index, 1)">&times;</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <a @click.stop="addLine">Add Exchange</a>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <button class="btn btn-warning btn-sm" @click="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
            </form>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: 'CompanieForm',
        data() {
            return {
                form: {
                    items: []
                },
                errors: {},
                option: {
                    stocks: []
                },
                title: 'Company and exchange',
                initialize: '/api/companie/create',
                redirect: '/companie',
                store: '/api/companie',
                method: 'post'
            }
        },
        beforeMount() {
            if(this.$route.meta.mode === 'edit') {
                this.initialize = '/api/companie/' + this.$route.params.id + '/edit'
                this.store = '/api/companie/' + this.$route.params.id
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
            addLine() {
                this.form.items.push({
                    stock_id: 'Select',
                    price: 0,
                    entered_date: '01/01/2017',
                    entered_time: '00:00'
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
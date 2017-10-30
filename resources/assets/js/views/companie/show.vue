<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">{{title}}</span>
            <div>
                <button class="btn btn-success btn-sm" @click="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                <router-link :to="'/companie/' + model.id + '/edit'" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"> Edit</router-link>
                <button class="btn btn-danger btn-sm" @click="remove"><i class="fa fa-trash" aria-hidden="true"> Delete</button>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <label>Name</label>
                    <p>{{model.name}}</p>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <label>Exchanges</label>
                </div>
                <div class="col-sm-4">
                    <label>Email Address</label>
                    <p>{{model.email}}</p>
                </div>
                <div class="col-sm-4">
                    <label>Created At</label>
                    <p>{{model.created_at}}</p>
                    <label>Address</label>
                    <pre>{{model.address}}</pre>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Stock</th>
                        <th>Type</th>
                        <th>Entered price date</th>
                        <th>Entered price time</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <thead>
                    <tr v-for="item in model.items">
                        <td>{{item.stock_id}}</td>
                        <td>{{item.type}}</td>
                        <td>{{item.entered_date}}</td>
                        <td>{{item.entered_time}}</td>
                        <td><span class="badge badge-primary"><i class="fa fa-eur" aria-hidden="true"></i> {{item.price}}</span></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: 'CompanieShow',
        data() {
            return {
                model: {
                    items: []
                },
                option: {
                    stocks: []
                },
                title: 'Company and exchange',
                resource: 'companie',
                redirect: '/companie'
            }
        },
        beforeMount() {
            this.fetchData()
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            remove() {
                var vm = this
                axios.delete(`api/${this.resource}/${this.$route.params.id}`)
                    .then(function(response) {
                        if(response.data.deleted) {
                            vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            back(){
                var vm = this
                vm.$router.push(vm.redirect)
            },
            fetchData() {
                var vm = this
                axios.get(`/api/${this.resource}/${this.$route.params.id}`)
                    .then(function(response) {
                        Vue.set(vm.$data, 'model', response.data.model)
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            }
        }
    }
</script>
<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">{{model.company}} / {{model.name}}</span>
            <div>
                <button class="btn btn-success btn-sm" @click="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                <router-link :to="'/stock/' + model.id + '/edit'" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"> Edit</router-link>
                <button class="btn btn-danger btn-sm" @click="remove"><i class="fa fa-trash" aria-hidden="true"> Delete</button>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <label>Name</label>
                    <p>{{model.name}}</p>
                </div>
                <div class="col-sm-4">
                    <label>Email Address</label>
                    <p>{{model.email}}</p>
                    <label>Phone Number</label>
                    <p>{{model.phone}}</p>
                </div>
                <div class="col-sm-4">
                    <label>Created At</label>
                    <p>{{model.created_at}}</p>
                    <label>Address</label>
                    <pre>{{model.address}}</pre>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: 'StockShow',
        data() {
            return {
                model: {},
                resource: 'stock',
                redirect: '/stock'
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
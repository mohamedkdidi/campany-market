<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">{{model.title}}</span>
            <div>
                <router-link :to="'/companie/' + model.id + '/edit'" class="btn btn-primary btn-sm">Edit</router-link>
                <button class="btn btn-danger btn-sm" @click="remove">Delete</button>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Entered price date</th>
                        <th>Entered price time</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <thead>
                    <tr v-for="item in model.items">
                        <td>{{item.name}}</td>
                        <td>{{item.type}}</td>
                        <td>{{item.entered_date}}</td>
                        <td>{{item.entered_time}}</td>
                        <td>{{item.price}}</td>
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
                    stock: {},
                    items: []
                },
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
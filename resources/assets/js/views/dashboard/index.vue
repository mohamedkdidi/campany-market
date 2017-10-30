<template>
    <div class="panel panel-default">
        <div class="panel-body dashboard">
            <div class="row">
                <div class="col-sm-9">
            <h2>Company Stock Overview</h2>
            <div class="row">
                <div class="col-sm-4">
                    <ul class="list-group" >
                        <li class="list-group-item blue"><h3 class="mb-1">Kiveo AG</h3>
                        <small>Preferred stock</small>
                        </li>
                        <li class="list-group-item" v-for="(item, index) in model.items">
                             New York Stock Exchange
                            <span class="badge blue badge-pill"><i aria-hidden="true" class="fa fa-eur"></i> 12,66</span>
                        </li>
                        <li class="list-group-item">
                             Deutsh Borse Frankfurt
                            <span class="badge blue badge-pill"><i aria-hidden="true" class="fa fa-eur"></i> 12,62</span>
                        </li>
                        <li class="list-group-item">
                             Hong Kong Stock Exchange
                            <span class="badge blue badge-pill"><i aria-hidden="true" class="fa fa-eur"></i> 12,69</span>
                        </li>
                        <li class="list-group-item">
                             London Stock Exchange
                            <span class="badge blue badge-pill"><i aria-hidden="true" class="fa fa-eur"></i> 12,58</span>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <ul class="list-group">
                        <li class="list-group-item orange"><h3 class="mb-1">Kiveo AG</h3>
                            <small>Common stock</small>
                        </li>
                        <li class="list-group-item">New York Stock Exchange
                            <span class="badge orange badge-pill"><i aria-hidden="true" class="fa fa-eur"></i> 11,66</span>
                        </li>
                        <li class="list-group-item">Deutsh Borse Frankfurt
                            <span class="badge orange badge-pill"><i aria-hidden="true" class="fa fa-eur"></i>  11,62</span>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <ul class="list-group">
                    <li class="list-group-item orange"><h3 class="mb-1">Metadea AG</h3>
                        <small>Common stock</small>
                        </li>
                        <li class="list-group-item">Shanghai Stock Exchange
                            <span class="badge orange badge-pill"><i aria-hidden="true" class="fa fa-eur"></i> 24,16</span></li>
                        <li class="list-group-item">Deutsche Borse Frankfurt
                            <span class="badge orange badge-pill"><i aria-hidden="true" class="fa fa-eur"></i> 24,20</span>
                        </li>
                        <li class="list-group-item">Hong kong Stock Exchage
                            <span class="badge orange badge-pill"><i aria-hidden="true" class="fa fa-eur"></i> 24,14</span>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
            <div class="col-sm-3">
                <h3 class="mb-1">Highest Marker price</h3>
                    <div class="card text-white blue mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Kiveo AG</h4>
                            <p class="card-text">Preferred stock</p>
                            <p class="card-text"><b><i aria-hidden="true" class="fa fa-eur"></i> 12,69</b></p>
                        </div>
                        <p class="footer">Hong kong Stock Exchage</p>
                        </div>
                        <div class="card text-white orange mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Kiveo AG</h4>
                            <p class="card-text">Common stock</p>
                            <p class="card-text"><b><i aria-hidden="true" class="fa fa-eur"></i> 11,66</b></p>
                            
                        </div>
                        <p class="footer">New York Stock Exchange</p>
                        </div>
                        <div class="card text-white orange mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Metadea AG</h4>
                            <p class="card-text">Common stock</p>
                            <p class="card-text"><b><i aria-hidden="true" class="fa fa-eur"></i> 24,20</b></p>
                            
                        </div>
                        <p class="footer">Deutsche Borse Frankfurt</p>
                    </div>
                    
                </div>
            </div>
    </div>    
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: 'DashboardForm',
        data() {
            return {
                model: {
                    items: []
                },
                errors: {},
                option: {
                    stocks: []
                },
                title: 'Company and exchange',
                initialize: '/api/dashboard/create',
                redirect: '/dashboard',
                store: '/api/dashboard',
                method: 'post'
            }
        },
        beforeMount() {
            if(this.$route.meta.mode === 'edit') {
                this.initialize = '/api/dashboard/' + this.$route.params.id + '/edit'
                this.store = '/api/dashboard/' + this.$route.params.id
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
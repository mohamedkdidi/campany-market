<template>
    <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title">
        <template scope="props">
            <tr @click="$router.push('/companie/' + props.item.id)">
                <td>{{props.item.id}}</td>
                <td>{{props.item.title}}</td>
                <td>{{props.item.type}}</td>
                <td>{{props.item.entered_date}}</td>
                <td>{{props.item.entered_time}}</td>
                <td>{{props.item.stock.name}}</td>
                <td>{{props.item.price}}</td>
            </tr>
        </template>
    </data-viewer>
</template>
<script>
    import DataViewer from '../../components/DataViewer.vue'

    export default {
        name: 'CompanieIndex',
        data() {
            return {
                title: 'Companies',
                source: '/api/companie',
                create: '/companie/create',
                thead: [
                    {title: 'ID', key: 'id', sort: true},
                    {title: 'Date', key: 'date', sort: true},
                    {title: 'Stock', key: 'stock', sort: false},
                    {title: 'Title', key: 'title', sort: true},
                    {title: 'Price', key: 'price', sort: true},
                    {title: 'Type', key: 'type', sort: true},
                ],
                filter: [
                    'id', 'stock_id', 'title', 'entered_date', 'entered_time', 'price', 'type', 'created_at',
                    'stock.id', 'stock.company', 'stock.email', 'stock.name',
                    'stock.phone', 'stock.address', 'stock.created_at'
                ]
            }
        },
        components: {
            DataViewer
        }
    }
</script>
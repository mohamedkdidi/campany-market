<template>
    <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title">
        <template scope="props">
            <tr @click="$router.push('/stock/' + props.item.id)">
                <td>{{props.item.id}}</td>
                <td>{{props.item.name}}</td>
                <td>{{props.item.address}}</td>
                <td>{{props.item.email}}</td>
                <td>{{props.item.created_at}}</td>
            </tr>
        </template>
    </data-viewer>
</template>
<script>
    import DataViewer from '../../components/DataViewer.vue'

    export default {
        name: 'StockIndex',
        data() {
            return {
                title: 'Stock',
                source: '/api/stock',
                create: '/stock/create',
                thead: [
                    {title: 'ID', key: 'id', sort: true},
                    {title: 'Name', key: 'name', sort: true},
                    {title: 'Adresse', key: 'address', sort: true},
                    {title: 'Email Address', key: 'email', sort: true},
                    {title: 'Created At', key: 'created_at', sort: true}
                ],
                filter: [
                    'id', 'name', 'address', 'email', 'phone'
                ]
            }
        },
        components: {
            DataViewer
        }
    }
</script>
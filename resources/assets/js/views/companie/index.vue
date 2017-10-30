<template>
    <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title">
        <template scope="props">
            <tr @click="$router.push('/companie/' + props.item.id)">
                <td>{{props.item.id}}</td>
                <td>{{props.item.name}}</td>
                <td>{{props.item.address}}</td>
            </tr>
        </template>
    </data-viewer>
</template>
<script>
    import DataViewer from '../../components/DataViewer.vue'

    export default {
        name: 'CompanieIndex',
                 errors: {},
        data() {
            return {
                title: 'Companies',
                source: '/api/companie',
                create: '/companie/create',
                thead: [
                    {title: 'ID', key: 'id', sort: true},
                    {title: 'Name', key: 'name', sort: false},
                    {title: 'Adresse', key: 'address', sort: false},
                ],
                filter: [
                    'id', 'name', 'created_at'
                ]
            }
        },
        components: {
            DataViewer
        }
    }
</script>
<template>
    <div class="mt-4 mb-4 p-4">
        <h3>Products list</h3>
        <hr>
        <div class="mb-2">
            <b-button variant="info" size="sm" @click="changeModeList(1)">Display activated products</b-button>
            <b-button variant="dark" size="sm" @click="changeModeList(0)">Display trashed products</b-button>
        </div>
        <div class="p-4">
            <b-table v-if="products.length > 0" striped hover :items="products" :fields="products_fields" responsive="sm">
                <template v-slot:cell(actions)="row">
                    <b-button variant="warning" size="sm" @click="showDetails(row.item)">Edit</b-button>
                </template>
            </b-table>
            <div v-else>Ops, not exists products here.</div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            products: [],
            products_fields: [
                {
                    key: 'description',
                    label: 'Description',
                    sortable: true
                },
                {
                    key: 'cost_price',
                    label: 'Cost price',
                    sortable: true
                },
                {
                    key: 'sell_price',
                    label: 'Sell price',
                    sortable: true
                },
                {
                    key: 'created_at',
                    label: 'Created at',
                    sortable: true
                },
                {
                    key: 'deleted_at',
                    label: 'Deleted at',
                    sortable: false
                },
                {
                    key: 'actions',
                    label: 'Actions',
                    sortable: false
                }
            ],
            mode: 'list'
        }
    },
    mounted(){
        this.mode = this.$route.query.deleted ? 'trashed' : 'list'
        this.get()
    },
    methods: {
        get(){
            if(this.mode === 'list'){
                
                const search = this.$route.query.search || ''
                const url = `/api/products?search=${search}`
                return axios(url).then((response) => {
                    this.products = response.data
                })
            }

            const url = `/api/trashed/products`
            return axios(url).then((response) => {
                this.products = response.data
            })

        },
        showDetails(product){
            const url = `/products/edit/${product.id}`
            this.$router.push(url)
        },
        changeModeList(option){
            this.mode = option ? 'list' : 'trashed'
            this.get()
        }
    }
}
</script>

<style>

</style>
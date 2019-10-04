<template>
    <div class="mt-2 mb-2">
        <b-form @submit="save" @reset="goBack" class="p-5">
            
            <label for="product-description">Description *</label>
            <b-form-input id="product-description" v-model="product.description" aria-describedby="product-description-helper"></b-form-input>
            <b-form-text id="product-description-helper" class="mb-4">Input someone description for your product</b-form-text>
            
            <label for="product-cost-price">Cost price</label>
            <b-form-input id="product-cost-price" type="number" min="0" v-model="product.cost_price" aria-describedby="product-cost-price-helper"></b-form-input>
            <b-form-text id="product-cost-price-helper" class="mb-4">Cost price of your product (not required)</b-form-text>
            
            <label for="product-cost-sell">Sell price *</label>
            <b-form-input id="product-cost-sell" type="number" min="0" v-model="product.sell_price" aria-describedby="product-sell-price-helper"></b-form-input>
            <b-form-text id="product-sell-price-helper" class="mb-4">Sell price of your product</b-form-text>
            
            <small class="form-text text-muted">
                * Required Fields
            </small>
            <div class="d-flex justify-content-between align-items-center mt-5 mb-5">
                <div class="d-flex flex-wrap">
                    <b-button type="button" variant="danger" size="md" class="mr-2 mb-2" @click="remove()">Delete</b-button>
                    <b-button type="reset"  variant="secondary" size="md" class="mr-2 mb-2">Quit</b-button>
                </div>
                <div class="d-flex flex-wrap">
                    <b-button type="submit" variant="success" size="md">Save</b-button>
                </div>
            </div>
        </b-form>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data(){
        return {
            product:{}
        }
    },
    mounted(){
        this.get()
    },
    methods:{

        get(){
            let id = this.$route.params.id
            if(id){
                const url = `/api/products/${id}`
                axios(url).then((response) => {
                    this.product = response.data
                })
            }
        },
        save(e){
            e.preventDefault()
            
            const method = this.product.id ? 'put' : 'post'
            const url = this.product.id ? `/api/products/${this.product.id}` : '/api/products'
            
            axios[method](url, this.product).then(() => {
                this.$toasted.show('Save with success')
            }).catch(e => {
                let msg = e.response && e.response.data && e.response.data.errors ? e.response.data.errors.description[0] : 'Ops, someone error occured. Try again later' 
                this.$toasted.show(msg)
            })
        },
        remove(){
            const url = `/api/products/${this.product.id}`
            axios.delete(url).then(() => {
                this.$toasted.show('Removed with success, redirecting...')
                setTimeout(() => this.goBack(), 2000)
            }).catch(e => {
                let msg = e.response && e.response.data && e.response.data.errors ? e.response.data.errors.description[0] : 'Ops, someone error occured. Try again later' 
                this.$toasted.show(msg)
            })
        },
        goBack(){
            this.$router.push('/products')
        }
    }
}
</script>

<style>

</style>
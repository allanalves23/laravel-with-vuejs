<template>
    <div class="container mt-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">CRUD Laravel + Vuejs</div>

                    <div class="card-body">
                        Select any option below
                        <div class="d-flex flex-wrap mt-2 mb-2">
                            <b-button variant="primary" size="sm" class="mr-2 mb-2" @click="goTo('/products/new')">Add Product</b-button>
                            <b-button variant="info" size="sm" class="mr-2 mb-2" @click="goTo('/products')">List All Products</b-button>
                            <b-button variant="secondary" size="sm" class="mr-2 mb-2" @click="goTo('/products?deleted=s')">List Deleted Products</b-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            goTo(path){
                this.$router.push(path)
            }
        }
    }
</script>

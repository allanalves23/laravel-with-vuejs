<template>
    <b-navbar toggleable="lg" type="dark" variant="primary">
    <router-link to="/">
        <b-navbar-brand>
            Home
        </b-navbar-brand>
    </router-link>
    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
        <router-link to="/products">
            <b-navbar-brand>
                products
            </b-navbar-brand>
        </router-link>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
            <b-nav-form @submit="get">
                <b-form-input size="sm" class="mr-sm-2" placeholder="Search" v-model="search"></b-form-input>
                <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
            </b-nav-form>
        </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
export default {
    data(){
        return {
            search: ''
        }
    },
    methods:{
        get(e){
            e.preventDefault()
            const url = `/products?search=${this.search}`
            if(this.$router.history.current.name === 'products'){
                window.location.href = url
            }else{
                this.$router.push(url)
            }
        }
    }
}
</script>

<style>

</style>
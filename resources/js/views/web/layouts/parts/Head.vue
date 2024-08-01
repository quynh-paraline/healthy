<template>
    <div>
        <!-- Nội dung của component, nếu có -->
    </div>
</template>

<script>
import { useHead } from '@vueuse/head'

export default {
    setup() {
        useHead({
            meta: [
                { charset: 'utf-8' },
                { name: 'viewport', content: 'width=device-width, initial-scale=1.0' },
                { name: 'keywords', content: '' },
                { name: 'description', content: '' }
            ],
            title: 'Healthy food',
            link: [
                { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
                { rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: '' },
                {
                    rel: 'stylesheet',
                    href: 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap'
                },
                { rel: 'stylesheet', href: 'https://use.fontawesome.com/releases/v5.15.4/css/all.css' },
                { rel: 'stylesheet', href: 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css' },
                { rel: 'stylesheet', href: '/lib/lightbox/css/lightbox.min.css' },
                { rel: 'stylesheet', href: '/lib/owlcarousel/assets/owl.carousel.min.css' },
                { rel: 'stylesheet', href: '/css/bootstrap.min.css' },
                { rel: 'stylesheet', href: '/css/style.css' }
            ]
        })
    }
}
</script>

<style scoped>
</style>

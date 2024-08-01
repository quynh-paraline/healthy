<template>
    <div>
        <!-- Nội dung của component -->
    </div>
</template>

<script>
import { useHead } from '@vueuse/head'

export default {
    setup() {
        useHead({
            script: [
                { src: 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js' },
                { src: 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' },
                { src: '/lib/easing/easing.min.js' },
                { src: '/lib/waypoints/waypoints.min.js' },
                { src: '/lib/lightbox/js/lightbox.min.js' },
                { src: '/lib/owlcarousel/owl.carousel.min.js' },
                { src: '/js/main.js' }
            ]
        })
    }
}
</script>

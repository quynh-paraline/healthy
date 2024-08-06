import {createRouter,createWebHistory} from "vue-router";
import web from "../routes/web.js"

const routes = [...web];

const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router;

const web =[
    {
        path : "/",
        component: ()=>import("../views/web/layouts/Layout.vue"),
        children: [
            {
                path: "",
                name:"web.welcome",
                component:()=>import("../views/web/home/Index.vue")
            },
            {
                path: "contact",
                name: "web.contact",
                component:()=>import("../views/web/contacts/Index.vue")
            },
            {
                path: "products/filter/:id",
                name: "products.filter",
                component:()=>import("../views/web/products/Filter.vue"),
                props:true
            },
            {
                path: "products/index",
                name: "products.index",
                component:()=>import("../views/web/products/Index.vue")
            },
            {
                path: "checkouts/thankyou/:id",
                name: "checkouts.thankyou",
                component:()=>import("../views/web/checkouts/Thankyou.vue")
            },
            {
                path: "carts/index",
                name: "carts.index",
                component:()=>import("../views/web/carts/Index.vue")
            },
            {
                path: "orders/index",
                name: "orders.index",
                component:()=>import("../views/web/orders/Index.vue")
            },
            {
                path: "orders/detail/:id",
                name: "orders.detail",
                component:()=>import("../views/web/orders/Detail.vue")
            },
            {
                path: "checkouts/index",
                name: "checkouts.index",
                component:()=>import("../views/web/checkouts/Index.vue")
            }
        ]
    }
]

export default web;

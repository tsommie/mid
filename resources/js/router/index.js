import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from "../views/Dashboard";
import organization from "./organization";
import user from "./user";
import client from "./client";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'dashboard',
    component: Dashboard
  },

  // Organization routes...
  ...organization,

  // User routes
  ...user,

  // Client routes...
  ...client
]

const router = new VueRouter({
  base: process.env.BASE_URL,
  routes,
  linkActiveClass: "active",
  linkExactActiveClass: "active",
  // scrollBehavior (to, from, savedPosition) {
  //   if (to.name === 'Home') {
  //     return { x: 0, y: 0 }
  //   }
  //   return { x: 0, y: 352 }
  // }
})

export default router

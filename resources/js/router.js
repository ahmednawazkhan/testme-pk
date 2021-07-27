import Vue from 'vue'
import Router from 'vue-router'
import Index from './views/tests/category/university/Index.vue'
import List from './views/tests/category/university/List'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      component: Index,
      meta: {
        auth: true
      },
      children: [
        {
          path: '/',
          name: 'universities',
          component: List
        },
        {
          path: '/universities/:slug',
          name: 'tests',
          component: () => import(/* webpackChunkName: "group-university" */ './views/tests/category/university/Tests.vue')
        },
        {
          path: '/universities/:slug/:test',
          name: 'instructions',
          component: () => import(/* webpackChunkName: "group-university" */ './views/tests/category/university/Instructions.vue')
        },
        {
          path: '/results',
          name: 'tests-results',
          component: () => import(/* webpackChunkName: "group-university" */ './views/tests/results/Index.vue')
        },
        {
          path: '/results/:slug',
          name: 'result-show',
          component: () => import(/* webpackChunkName: "group-university" */ './views/tests/results/Show.vue')
        }
      ]
    },
    {
      path: '/universities/:slug/:test/take-test',
      name: 'test',
      meta: {
        auth: true
      },
      component: () => import(/* webpackChunkName: "group-university" */ './views/take-test/TakeTest.vue')
    },
    {
      path: '/test/tour-guide',
      name: 'tour-guide',
      meta: {
        auth: true
      },
      component: () => import(/* webpackChunkName: "group-university" */ './views/take-test/TestTour.vue')
    },
    {
      path: '/admin',
      meta: {
        auth: ['Super admin']
      },
      component: () => import(/* webpackChunkName: "group-admin" */ './views/admin-panel/Layout.vue'),
      children: [
        {
          path: '/',
          name: 'admin-overview',
          component: () => import(/* webpackChunkName: "group-admin" */ './views/admin-panel/Overview.vue')
        },
        {
          path: 'mcq',
          name: 'admin-mcq',
          component: () => import(/* webpackChunkName: "group-admin" */ './views/admin-panel/mcq/Index.vue')
        },
        {
          path: 'mcq/bank',
          name: 'mcq-bank',
          component: () => import(/* webpackChunkName: "group-admin" */ './views/admin-panel/mcq/List.vue')
        },
        {
          path: 'mcq/bank/:id/edit',
          name: 'mcq-edit',
          props: true,
          component: () => import(/* webpackChunkName: "group-admin" */ './views/admin-panel/mcq/Edit.vue')
        },
        {
          path: 'mcq/subjects',
          name: 'mcq-subjects',
          component: () => import(/* webpackChunkName: "group-admin" */ './views/admin-panel/mcq/Subjects.vue')
        }
      ]
    },
    {
      path: '/auth',
      meta: {
        auth: false
      },
      component: () => import(/* webpackChunkName: "group-auth" */ './views/authentication/Index.vue'),
      children: [
        {
          path: 'login',
          name: 'auth-login',
          component: () => import(/* webpackChunkName: "group-auth" */ './views/authentication/login/Login.vue')
        },
        {
          path: 'register',
          name: 'auth-register',
          component: () => import(/* webpackChunkName: "group-auth" */ './views/authentication/register/Register.vue')
        }
      ]
    }
  ]
})

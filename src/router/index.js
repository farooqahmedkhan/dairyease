import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import AuthLoginView from '../views/auth/LoginView.vue';
import AuthSignupView from '../views/auth/SignUpView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/'       , name: 'home'    , component: HomeView},
    { path: '/login'  , name: 'login'   , component: AuthLoginView},
    { path: '/join-us', name: 'join-us' , component: AuthSignupView},
  ],
})

export default router

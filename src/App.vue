<template>
  <header class="h-10 my-2">
    <nav class="w-full flex flex-row justify-end">
      <RouterLink 
        v-for="item in items" 
        :key="item.title" 
        :to="item.href" 
        class="p-1 mx-2 hover:text-red-600 hover:underline"
        active-class="font-medium text-red-600 underline"
      >
        {{ item.title }}
      </RouterLink>
    </nav>
  </header>
  <RouterView />
</template>

<script>
import { RouterLink, RouterView } from 'vue-router';

export default {
  data() {
    return {
      items: [
        { title: 'Home'            , href: '/' },  
        { title: 'Already a member', href: '/login' },
        { title: 'Join us!'        , href: '/join-us' },
      ],
    };
  },
};
</script>

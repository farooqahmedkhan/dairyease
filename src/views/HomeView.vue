<template>
  <main>
    <section class="w-full">
      <div class="text-center p-4">
        <h1 class="text-red-600 text-2xl font-bold inline">Let us</h1> help you !
        <br />
        <h1 class="text-red-600 text-2xl font-bold inline">Invoice</h1> your dairy providers efficiently & effortlessly
      </div>
      <figure>
        <img 
          class="w-full max-h-96 object-cover shadow-md shadow-orange-300" 
          src="https://images.unsplash.com/photo-1506784365847-bbad939e9335?q=80&w=2068&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
          alt="Dairy Invoice"
        />
      </figure>
    </section>    
  </main>
</template>
<script lang="js">
import { AppState } from "@/state.js";
export default {
  computed: {
    currentUser() {
      return AppState.auth.user;
    }
  }
};
</script>

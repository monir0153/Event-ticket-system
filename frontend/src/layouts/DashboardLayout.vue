<script setup lang="ts">
import Sidebar from '@/components/dashboard/SidebarComponent.vue'
import Header from '@/components/dashboard/HeaderComponent.vue'
</script>

<template>
  <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
    <div class="hidden border-r bg-muted/40 md:block">
      <Sidebar />
    </div>
    <div class="flex flex-col">
      <!-- header here -->
      <Header />
      <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
        <!-- breadcam -->
        <div class="flex items-center">
          <h1 class="text-lg font-semibold md:text-2xl">Inventory</h1>
        </div>
        <div
          class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm"
        >
          <div class="flex flex-col items-center gap-1 text-center">
            <slot />
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

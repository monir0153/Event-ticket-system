<template lang="">
  <div class="flex h-full max-h-screen flex-col gap-2">
    <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
      <a href="/" class="flex items-center gap-2 font-semibold">
        <Package2 class="h-6 w-6" />
        <span class="">Acme Inc</span>
      </a>
      <Button variant="outline" size="icon" class="ml-auto h-8 w-8">
        <Bell class="h-4 w-4" />
        <span class="sr-only">Toggle notifications</span>
      </Button>
    </div>
    <div class="flex-1">
      <!-- nav bar here -->
      <nav class="grid items-start px-2 text-sm font-medium lg:px-4">
        <router-link
          v-for="(item, index) in navItems"
          :key="index"
          :to="item.href"
          class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
          :class="{ 'shadow-md bg-muted group text-slate-950': $route.path === item.href }"
        >
          <component :is="item.icon" class="h-4 w-4" />
          {{ item.label }}
          <Badge
            class="ml-auto flex h-6 w-6 shrink-0 items-center bg-slate-900 text-slate-50 justify-center rounded-full"
          >
            6
          </Badge>
        </router-link>
      </nav>
    </div>
    <div class="mt-auto p-4">
      <Card>
        <CardHeader class="p-2 pt-0 md:p-4">
          <CardTitle>Upgrade to Pro</CardTitle>
          <CardDescription>
            Unlock all features and get unlimited access to our support team.
          </CardDescription>
        </CardHeader>
        <CardContent class="p-2 pt-0 md:p-4 md:pt-0">
          <Button size="sm" class="w-full"> Upgrade </Button>
        </CardContent>
      </Card>
    </div>
  </div>
</template>
<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Bell, Home, LineChart, Package, Users, Package2 } from 'lucide-vue-next'
const navItems = [
  { label: 'Dashboard', href: '/dashboard', icon: Home },
  { label: 'Products', href: '/dashboard/product', icon: Package },
  { label: 'Orders', href: '/', icon: LineChart },
  { label: 'Events', href: '/', icon: Bell },
]
</script>
<style lang=""></style>

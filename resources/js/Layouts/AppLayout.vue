<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
      <a class="navbar-brand fw-bold" href="/">Inventory App</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <Link href="/" class="nav-link">Dashboard</Link>
          </li>
          <li class="nav-item">
            <Link href="/suppliers" class="nav-link">Suppliers</Link>
          </li>
          <li class="nav-item">
            <Link href="/products" class="nav-link">Products</Link>
          </li>
          <li class="nav-item">
            <Link href="/inventories" class="nav-link">Inventory</Link>
          </li>
        </ul>
      </div>
    </nav>

    <main class="container py-4">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>

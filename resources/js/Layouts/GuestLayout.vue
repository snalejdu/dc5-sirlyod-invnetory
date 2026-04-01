<template>
  <div class="min-vh-100 d-flex flex-column">
    <!-- Minimal Header -->
    <header class="bg-light border-bottom py-3">
      <div class="container">
        <a href="/" class="navbar-brand fw-bold text-decoration-none">Inventory App</a>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow-1 d-flex align-items-center">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-light border-top py-3 mt-auto">
      <div class="container text-center text-muted small">
        <p class="mb-0">&copy; {{ new Date().getFullYear() }} Inventory Management System. All rights reserved.</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
</script>

<style scoped>
.min-vh-100 {
  min-height: 100vh;
}

.flex-grow-1 {
  flex-grow: 1;
}

.mt-auto {
  margin-top: auto;
}
</style>

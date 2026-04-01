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
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <button
              class="nav-link dropdown-toggle btn btn-link"
              id="userDropdown"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="bi bi-person-circle"></i> Account
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li>
                <form @submit.prevent="logout" class="d-inline">
                  <button type="submit" class="dropdown-item">
                    <i class="bi bi-box-arrow-right"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
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
import { ref } from 'vue'

const logout = async () => {
  const response = await fetch('/logout', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
    }
  })

  if (response.ok) {
    window.location.href = '/login'
  }
}
</script>

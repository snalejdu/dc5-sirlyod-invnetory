<template>
  <AppLayout>
    <div class="container py-4">
      <h1 class="fw-bold mb-1">Dashboard</h1>
      <p class="text-muted mb-4">Welcome to the Inventory Management System</p>

      <!-- Stat Cards -->
      <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="rounded-circle bg-primary bg-opacity-10 p-3 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#0d6efd" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/>
                </svg>
              </div>
              <div>
                <div class="text-muted small">Total Products</div>
                <div class="fs-3 fw-bold">{{ stats.total_products }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-xl-3">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="rounded-circle bg-success bg-opacity-10 p-3 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#198754" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4 6v-2m0 0a4 4 0 100-8 4 4 0 000 8z"/>
                </svg>
              </div>
              <div>
                <div class="text-muted small">Total Suppliers</div>
                <div class="fs-3 fw-bold">{{ stats.total_suppliers }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-xl-3">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="rounded-circle bg-warning bg-opacity-10 p-3 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#ffc107" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                </svg>
              </div>
              <div>
                <div class="text-muted small">Inventory Records</div>
                <div class="fs-3 fw-bold">{{ stats.total_inventories }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-xl-3">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center gap-3 overflow-hidden">
              <div class="rounded-circle bg-danger bg-opacity-10 p-3 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#dc3545" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <div class="overflow-hidden min-w-0 flex-grow-1">
                <div class="text-muted small">Total Inventory Value</div>
                <div class="fw-bold text-break" style="font-size: clamp(1rem, 2vw, 1.75rem); line-height: 1.2;">
                  ${{ Number(stats.total_value).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
              <h5 class="card-title fw-semibold">Suppliers</h5>
              <p class="card-text text-muted small">Manage your supplier information and contacts.</p>
              <Link href="/suppliers" class="btn btn-outline-primary btn-sm">View Suppliers</Link>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
              <h5 class="card-title fw-semibold">Products</h5>
              <p class="card-text text-muted small">Browse and manage your product catalog.</p>
              <Link href="/products" class="btn btn-outline-success btn-sm">View Products</Link>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
              <h5 class="card-title fw-semibold">Inventory</h5>
              <p class="card-text text-muted small">Track stock levels, locations, and reorder points.</p>
              <Link href="/inventories" class="btn btn-outline-warning btn-sm">View Inventory</Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '../Layouts/AppLayout.vue'

defineProps({
  stats: {
    type: Object,
    required: true
  }
})
</script>

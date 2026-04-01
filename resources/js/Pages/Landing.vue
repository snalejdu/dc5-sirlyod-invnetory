<template>
  <GuestLayout>
    <div class="w-100">
      <!-- Hero Section -->
      <section class="bg-primary text-white py-5">
        <div class="container py-5">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h1 class="display-4 fw-bold mb-4">Welcome to Inventory Manager</h1>
              <p class="lead mb-4">Browse our extensive catalog of high-quality tools and equipment from leading suppliers.</p>
              <div class="d-flex gap-3">
                <Link href="/login" class="btn btn-light btn-lg">Sign In</Link>
                <a href="#products" class="btn btn-outline-light btn-lg">Browse Products</a>
              </div>
            </div>
            <div class="col-lg-6 text-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.5" class="opacity-50">
                <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                <path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/>
              </svg>
            </div>
          </div>
        </div>
      </section>

      <!-- Products Section -->
      <section id="products" class="py-5 bg-light">
        <div class="container">
          <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Featured Products</h2>
            <p class="text-muted">Explore our collection of quality tools and equipment</p>
          </div>

          <!-- Loading State -->
          <div v-if="loading" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Loading products...</p>
          </div>

          <!-- Error State -->
          <div v-else-if="error" class="alert alert-danger text-center py-4">
            <p class="mb-0">{{ error }}</p>
          </div>

          <!-- Products Grid -->
          <div v-else class="row g-4">
            <div v-for="product in products" :key="product.id" class="col-md-6 col-lg-4">
              <div class="card shadow-sm h-100 border-0 transition-transform hover-lift">
                <div class="card-body d-flex flex-column">
                  <!-- Product Header -->
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <h5 class="card-title fw-semibold mb-1">{{ product.name }}</h5>
                      <span class="badge bg-secondary">{{ product.sku }}</span>
                    </div>
                  </div>

                  <!-- Product Details -->
                  <p class="card-text text-muted small flex-grow-1 mb-3">
                    {{ truncateText(product.description, 100) }}
                  </p>

                  <!-- Supplier Info -->
                  <div v-if="product.supplier" class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block">Supplied by</small>
                    <strong class="text-primary">{{ product.supplier.name }}</strong>
                  </div>

                  <!-- Inventory Info -->
                  <div v-if="product.inventory" class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block">Stock Available</small>
                    <div class="d-flex justify-content-between align-items-center">
                      <span class="fw-bold text-success">{{ product.inventory.quantity }} units</span>
                      <small class="text-muted">Loc: {{ product.inventory.location }}</small>
                    </div>
                  </div>

                  <!-- Price -->
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="fs-5 fw-bold text-primary">${{ Number(product.price).toLocaleString('en-US', { minimumFractionDigits: 2 }) }}</span>
                    <a href="#" class="btn btn-sm btn-primary">Details</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pagination -->
          <nav v-if="meta && meta.last_page > 1" class="d-flex justify-content-center mt-5">
            <ul class="pagination">
              <li v-if="meta.current_page > 1" class="page-item">
                <button @click="fetchProducts(meta.current_page - 1)" class="page-link">Previous</button>
              </li>

              <li v-for="page in visiblePages" :key="page" :class="['page-item', { active: page === meta.current_page }]">
                <button @click="fetchProducts(page)" class="page-link">{{ page }}</button>
              </li>

              <li v-if="meta.current_page < meta.last_page" class="page-item">
                <button @click="fetchProducts(meta.current_page + 1)" class="page-link">Next</button>
              </li>
            </ul>
          </nav>

          <!-- Empty State -->
          <div v-if="!loading && !error && products.length === 0" class="text-center py-5">
            <p class="text-muted">No products available at the moment.</p>
          </div>
        </div>
      </section>

      <!-- Info Section -->
      <section class="py-5">
        <div class="container">
          <div class="row g-4 text-center">
            <div class="col-md-4">
              <div class="p-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 24 24" class="text-primary mb-3">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                </svg>
                <h5 class="fw-semibold mb-2">Wide Selection</h5>
                <p class="text-muted small">Browse hundreds of quality products from trusted suppliers.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 24 24" class="text-primary mb-3">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                <h5 class="fw-semibold mb-2">Quality Assured</h5>
                <p class="text-muted small">All products are carefully curated from premium suppliers.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 24 24" class="text-primary mb-3">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z"/>
                </svg>
                <h5 class="fw-semibold mb-2">Real-time Stock</h5>
                <p class="text-muted small">Check live inventory levels and product availability.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </GuestLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import GuestLayout from '../Layouts/GuestLayout.vue'

const products = ref([])
const meta = ref(null)
const loading = ref(true)
const error = ref('')
const currentPage = ref(1)

const truncateText = (text, length) => {
  if (!text) return ''
  return text.length > length ? text.substring(0, length) + '...' : text
}

const visiblePages = computed(() => {
  if (!meta.value) return []
  const pages = []
  const start = Math.max(1, meta.value.current_page - 2)
  const end = Math.min(meta.value.last_page, meta.value.current_page + 2)

  for (let i = start; i <= end; i++) {
    pages.push(i)
  }
  return pages
})

const fetchProducts = async (page = 1) => {
  loading.value = true
  error.value = ''
  currentPage.value = page

  try {
    const response = await fetch(`/api/v1/products/public?page=${page}&per_page=9`)
    if (!response.ok) throw new Error('Failed to fetch products')

    const data = await response.json()
    products.value = data.data
    meta.value = data.meta
  } catch (err) {
    error.value = 'Unable to load products. Please try again later.'
    console.error('Error fetching products:', err)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchProducts()
})
</script>

<style scoped>
.hover-lift {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
  transform: translateY(-5px);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.transition-transform {
  transition: transform 0.3s ease;
}

.opacity-50 {
  opacity: 0.5;
}
</style>

<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="fw-bold mb-0">Products</h1>
      <Link :href="route('products.create')" class="btn btn-primary">Add Product</Link>
    </div>

    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th>Name</th>
              <th>SKU</th>
              <th>Price</th>
              <th>Supplier</th>
              <th>Stock</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products.data" :key="product.id">
              <td>{{ product.name }}</td>
              <td>{{ product.sku }}</td>
              <td>${{ product.price }}</td>
              <td>{{ product.supplier?.name }}</td>
              <td>{{ product.inventory?.quantity || 0 }}</td>
              <td>
                <Link :href="route('products.edit', product.id)" class="btn btn-sm btn-outline-primary me-1">Edit</Link>
                <button @click="deleteProduct(product.id)" class="btn btn-sm btn-outline-danger">Delete</button>
              </td>
            </tr>
            <tr v-if="products.data.length === 0">
              <td colspan="6" class="text-center text-muted py-4">No products found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
      <small class="text-muted">
        Showing {{ products.from }}–{{ products.to }} of {{ products.total }} products
      </small>
      <nav>
        <ul class="pagination pagination-sm mb-0">
          <li class="page-item" :class="{ disabled: !products.prev_page_url }">
            <Link class="page-link" :href="products.prev_page_url || '#'">Previous</Link>
          </li>
          <li
            v-for="link in products.links.slice(1, -1)"
            :key="link.label"
            class="page-item"
            :class="{ active: link.active, disabled: !link.url }"
          >
            <Link class="page-link" :href="link.url || '#'" v-html="link.label" />
          </li>
          <li class="page-item" :class="{ disabled: !products.next_page_url }">
            <Link class="page-link" :href="products.next_page_url || '#'">Next</Link>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import Layout from '../../Layouts/AppLayout.vue'

defineProps(['products'])
defineOptions({ layout: Layout })

const deleteProduct = (id) => {
  if (confirm('Are you sure?')) {
    router.delete(route('products.destroy', id))
  }
}
</script>

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
          </tbody>
        </table>
      </div>
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

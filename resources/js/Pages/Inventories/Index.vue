<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="fw-bold mb-0">Inventory</h1>
      <Link :href="route('inventories.create')" class="btn btn-primary">Add Inventory</Link>
    </div>

    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Location</th>
              <th>Last Restocked</th>
              <th>Reorder Level</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="inventory in inventories.data" :key="inventory.id">
              <td>{{ inventory.product?.name }}</td>
              <td :class="{ 'text-danger fw-semibold': inventory.quantity <= inventory.reorder_level }">
                {{ inventory.quantity }}
              </td>
              <td>{{ inventory.location }}</td>
              <td>{{ inventory.last_restocked }}</td>
              <td>{{ inventory.reorder_level }}</td>
              <td>
                <Link :href="route('inventories.edit', inventory.id)" class="btn btn-sm btn-outline-primary me-1">Edit</Link>
                <button @click="deleteInventory(inventory.id)" class="btn btn-sm btn-outline-danger">Delete</button>
              </td>
            </tr>
            <tr v-if="inventories.data.length === 0">
              <td colspan="6" class="text-center text-muted py-4">No inventory records found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
      <small class="text-muted">
        Showing {{ inventories.from }}–{{ inventories.to }} of {{ inventories.total }} records
      </small>
      <nav>
        <ul class="pagination pagination-sm mb-0">
          <li class="page-item" :class="{ disabled: !inventories.prev_page_url }">
            <Link class="page-link" :href="inventories.prev_page_url || '#'">Previous</Link>
          </li>
          <li
            v-for="link in inventories.links.slice(1, -1)"
            :key="link.label"
            class="page-item"
            :class="{ active: link.active, disabled: !link.url }"
          >
            <Link class="page-link" :href="link.url || '#'" v-html="link.label" />
          </li>
          <li class="page-item" :class="{ disabled: !inventories.next_page_url }">
            <Link class="page-link" :href="inventories.next_page_url || '#'">Next</Link>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import Layout from '../../Layouts/AppLayout.vue'

defineProps(['inventories'])
defineOptions({ layout: Layout })

const deleteInventory = (id) => {
  if (confirm('Are you sure?')) {
    router.delete(route('inventories.destroy', id))
  }
}
</script>

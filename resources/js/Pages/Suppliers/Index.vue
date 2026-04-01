<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="fw-bold mb-0">Suppliers</h1>
      <Link :href="route('suppliers.create')" class="btn btn-primary">Add Supplier</Link>
    </div>

    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Contact Person</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="supplier in suppliers.data" :key="supplier.id">
              <td>{{ supplier.name }}</td>
              <td>{{ supplier.email }}</td>
              <td>{{ supplier.phone }}</td>
              <td>{{ supplier.contact_person }}</td>
              <td>
                <Link :href="route('suppliers.edit', supplier.id)" class="btn btn-sm btn-outline-primary me-1">Edit</Link>
                <button @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-outline-danger">Delete</button>
              </td>
            </tr>
            <tr v-if="suppliers.data.length === 0">
              <td colspan="5" class="text-center text-muted py-4">No suppliers found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
      <small class="text-muted">
        Showing {{ suppliers.from }}–{{ suppliers.to }} of {{ suppliers.total }} suppliers
      </small>
      <nav>
        <ul class="pagination pagination-sm mb-0">
          <li class="page-item" :class="{ disabled: !suppliers.prev_page_url }">
            <Link class="page-link" :href="suppliers.prev_page_url || '#'">Previous</Link>
          </li>
          <li
            v-for="link in suppliers.links.slice(1, -1)"
            :key="link.label"
            class="page-item"
            :class="{ active: link.active, disabled: !link.url }"
          >
            <Link class="page-link" :href="link.url || '#'" v-html="link.label" />
          </li>
          <li class="page-item" :class="{ disabled: !suppliers.next_page_url }">
            <Link class="page-link" :href="suppliers.next_page_url || '#'">Next</Link>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import Layout from '../../Layouts/AppLayout.vue'

defineProps(['suppliers'])
defineOptions({ layout: Layout })

const deleteSupplier = (id) => {
  if (confirm('Are you sure?')) {
    router.delete(route('suppliers.destroy', id))
  }
}
</script>

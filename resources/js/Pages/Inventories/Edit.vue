<template>
  <div class="container py-4">
    <h1 class="fw-bold mb-4">Edit Inventory</h1>
    <form @submit.prevent="submit" class="bg-white p-4 rounded shadow" style="max-width: 600px;">
      <div class="mb-3">
        <label class="form-label fw-semibold">Product</label>
        <select v-model="form.product_id" class="form-select" :class="{ 'is-invalid': form.errors.product_id }">
          <option v-for="p in products" :key="p.id" :value="p.id">{{ p.name }}</option>
        </select>
        <div class="invalid-feedback">{{ form.errors.product_id }}</div>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Quantity</label>
        <input v-model="form.quantity" type="number" min="0" class="form-control" :class="{ 'is-invalid': form.errors.quantity }" />
        <div class="invalid-feedback">{{ form.errors.quantity }}</div>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Location</label>
        <input v-model="form.location" type="text" class="form-control" :class="{ 'is-invalid': form.errors.location }" />
        <div class="invalid-feedback">{{ form.errors.location }}</div>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Last Restocked</label>
        <input v-model="form.last_restocked" type="date" class="form-control" :class="{ 'is-invalid': form.errors.last_restocked }" />
        <div class="invalid-feedback">{{ form.errors.last_restocked }}</div>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Reorder Level</label>
        <input v-model="form.reorder_level" type="number" min="0" class="form-control" :class="{ 'is-invalid': form.errors.reorder_level }" />
        <div class="invalid-feedback">{{ form.errors.reorder_level }}</div>
      </div>
      <div class="d-flex justify-content-end gap-2 pt-2">
        <Link :href="route('inventories.index')" class="btn btn-secondary">Cancel</Link>
        <button type="submit" :disabled="form.processing" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import Layout from '../../Layouts/AppLayout.vue'

defineOptions({ layout: Layout })
const props = defineProps({ inventory: Object, products: Array })

const form = useForm({
  product_id:     props.inventory.product_id,
  quantity:       props.inventory.quantity,
  location:       props.inventory.location,
  last_restocked: props.inventory.last_restocked,
  reorder_level:  props.inventory.reorder_level,
})
const submit = () => form.put(route('inventories.update', props.inventory.id))
</script>

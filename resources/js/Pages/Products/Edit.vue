<template>
  <div class="container py-4">
    <h1 class="fw-bold mb-4">Edit Product</h1>
    <form @submit.prevent="submit" class="bg-white p-4 rounded shadow" style="max-width: 600px;">
      <div class="mb-3">
        <label class="form-label fw-semibold">Name</label>
        <input v-model="form.name" type="text" class="form-control" :class="{ 'is-invalid': form.errors.name }" />
        <div class="invalid-feedback">{{ form.errors.name }}</div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">SKU</label>
        <input v-model="form.sku" type="text" class="form-control" :class="{ 'is-invalid': form.errors.sku }" />
        <div class="invalid-feedback">{{ form.errors.sku }}</div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Description</label>
        <textarea v-model="form.description" rows="3" class="form-control" :class="{ 'is-invalid': form.errors.description }"></textarea>
        <div class="invalid-feedback">{{ form.errors.description }}</div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Price</label>
        <input v-model="form.price" type="number" class="form-control" min="0" :class="{ 'is-invalid': form.errors.price }" />
        <div class="invalid-feedback">{{ form.errors.price }}</div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Supplier</label>
        <select v-model="form.supplier_id" class="form-select" :class="{ 'is-invalid': form.errors.supplier_id }">
          <option value="" disabled>Select Supplier</option>
          <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{ supplier.name }}</option>
        </select>
        <div class="invalid-feedback">{{ form.errors.supplier_id }}</div>
      </div>

      <div class="d-flex justify-content-end gap-2 pt-2">
        <Link :href="route('products.index')" class="btn btn-secondary">Cancel</Link>
        <button type="submit" :disabled="form.processing" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import Layout from '../../Layouts/AppLayout.vue'

defineOptions({ layout: Layout })

const props = defineProps({
  product: Object,
  suppliers: Array,
})

const form = useForm({
  name: props.product.name,
  sku: props.product.sku,
  description: props.product.description,
  price: props.product.price,
  supplier_id: props.product.supplier_id,
})

const submit = () => form.put(route('products.update', props.product.id))
</script>

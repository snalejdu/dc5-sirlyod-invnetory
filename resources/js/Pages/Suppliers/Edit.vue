<template>
  <div class="container py-4">
    <h1 class="fw-bold mb-4">Edit Supplier</h1>
    <form @submit.prevent="submit" class="bg-white p-4 rounded shadow" style="max-width: 600px;">
      <div class="mb-3">
        <label class="form-label fw-semibold">Name</label>
        <input v-model="form.name" type="text" class="form-control" :class="{ 'is-invalid': form.errors.name }" />
        <div class="invalid-feedback">{{ form.errors.name }}</div>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>
        <input v-model="form.email" type="email" class="form-control" :class="{ 'is-invalid': form.errors.email }" />
        <div class="invalid-feedback">{{ form.errors.email }}</div>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Phone</label>
        <input v-model="form.phone" type="text" class="form-control" :class="{ 'is-invalid': form.errors.phone }" />
        <div class="invalid-feedback">{{ form.errors.phone }}</div>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Address</label>
        <textarea v-model="form.address" rows="3" class="form-control" :class="{ 'is-invalid': form.errors.address }" />
        <div class="invalid-feedback">{{ form.errors.address }}</div>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Contact Person</label>
        <input v-model="form.contact_person" type="text" class="form-control" :class="{ 'is-invalid': form.errors.contact_person }" />
        <div class="invalid-feedback">{{ form.errors.contact_person }}</div>
      </div>
      <div class="d-flex justify-content-end gap-2 pt-2">
        <Link :href="route('suppliers.index')" class="btn btn-secondary">Cancel</Link>
        <button type="submit" :disabled="form.processing" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import Layout from '../../Layouts/AppLayout.vue'

defineOptions({ layout: Layout })
const props = defineProps({ supplier: Object })

const form = useForm({
  name:           props.supplier.name,
  email:          props.supplier.email,
  phone:          props.supplier.phone,
  address:        props.supplier.address,
  contact_person: props.supplier.contact_person,
})
const submit = () => form.put(route('suppliers.update', props.supplier.id))
</script>

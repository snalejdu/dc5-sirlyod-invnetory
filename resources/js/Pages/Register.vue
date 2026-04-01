<template>
  <GuestLayout>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
      <div class="card shadow-lg" style="width: 100%; max-width: 500px">
        <div class="card-body p-5">
          <h1 class="card-title text-center mb-2 fw-bold">Create Account</h1>
          <p class="text-center text-muted mb-4">Join us to access the inventory system</p>

          <!-- Error Alert -->
          <div v-if="errors.general" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ errors.general }}
            <button type="button" class="btn-close" @click="errors.general = ''" />
          </div>

          <form @submit.prevent="handleRegister">
            <!-- Full Name Field -->
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.name }"
                placeholder="John Doe"
                required
              />
              <div v-if="errors.name" class="invalid-feedback d-block">
                {{ errors.name }}
              </div>
            </div>

            <!-- Email Field -->
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="form-control"
                :class="{ 'is-invalid': errors.email }"
                placeholder="you@example.com"
                required
              />
              <div v-if="errors.email" class="invalid-feedback d-block">
                {{ errors.email }}
              </div>
            </div>

            <!-- Password Field -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input
                id="password"
                v-model="form.password"
                type="password"
                class="form-control"
                :class="{ 'is-invalid': errors.password }"
                placeholder="Enter a strong password"
                required
              />
              <div v-if="errors.password" class="invalid-feedback d-block">
                {{ errors.password }}
              </div>
              <small class="text-muted">Minimum 8 characters</small>
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-4">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                class="form-control"
                :class="{ 'is-invalid': errors.password_confirmation }"
                placeholder="Confirm your password"
                required
              />
              <div v-if="errors.password_confirmation" class="invalid-feedback d-block">
                {{ errors.password_confirmation }}
              </div>
            </div>

            <!-- Register Button -->
            <button
              type="submit"
              class="btn btn-primary w-100 mb-3"
              :disabled="processing"
            >
              <span v-if="processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
              {{ processing ? 'Creating Account...' : 'Create Account' }}
            </button>
          </form>

          <hr class="my-4" />

          <!-- Login Link -->
          <p class="text-center text-muted">
            Already have an account?
            <Link href="/login" class="text-primary text-decoration-none fw-semibold">Sign In</Link>
          </p>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { Link } from '@inertiajs/vue3'
import GuestLayout from '../Layouts/GuestLayout.vue'

const processing = ref(false)
const errors = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  general: ''
})

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const handleRegister = async () => {
  // Clear previous errors
  errors.name = ''
  errors.email = ''
  errors.password = ''
  errors.password_confirmation = ''
  errors.general = ''

  // Validation
  if (!form.name) {
    errors.name = 'Name is required'
    return
  }
  if (!form.email) {
    errors.email = 'Email is required'
    return
  }
  if (!form.password) {
    errors.password = 'Password is required'
    return
  }
  if (form.password.length < 8) {
    errors.password = 'Password must be at least 8 characters'
    return
  }
  if (form.password !== form.password_confirmation) {
    errors.password_confirmation = 'Passwords do not match'
    return
  }

  processing.value = true

  try {
    const response = await fetch('/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
      },
      body: JSON.stringify({
        name: form.name,
        email: form.email,
        password: form.password,
        password_confirmation: form.password_confirmation
      })
    })

    const data = await response.json()

    if (!response.ok) {
      if (data.errors) {
        errors.name = data.errors.name?.[0] || ''
        errors.email = data.errors.email?.[0] || ''
        errors.password = data.errors.password?.[0] || ''
        errors.password_confirmation = data.errors.password_confirmation?.[0] || ''
      }
      errors.general = data.message || 'Registration failed. Please try again.'
      return
    }

    // Redirect on successful registration
    if (data.redirect) {
      window.location.href = data.redirect
    }
  } catch (error) {
    errors.general = 'An error occurred. Please try again.'
  } finally {
    processing.value = false
  }
}
</script>

<style scoped>
.min-vh-100 {
  min-height: 100vh;
}

.spinner-border-sm {
  width: 1rem;
  height: 1rem;
}
</style>

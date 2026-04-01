<template>
  <GuestLayout>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
      <div class="card shadow-lg" style="width: 100%; max-width: 400px">
        <div class="card-body p-5">
          <h1 class="card-title text-center mb-4 fw-bold">Inventory App</h1>
          <p class="text-center text-muted mb-4">Sign in to your account</p>

          <!-- Error Alert -->
          <div v-if="errors.general" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ errors.general }}
            <button type="button" class="btn-close" @click="errors.general = ''" />
          </div>

          <form @submit.prevent="handleLogin">
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
                placeholder="Enter your password"
                required
              />
              <div v-if="errors.password" class="invalid-feedback d-block">
                {{ errors.password }}
              </div>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="mb-3 form-check">
              <input
                id="remember"
                v-model="form.remember"
                type="checkbox"
                class="form-check-input"
              />
              <label for="remember" class="form-check-label">Remember me</label>
            </div>

            <!-- Login Button -->
            <button
              type="submit"
              class="btn btn-primary w-100 mb-3"
              :disabled="processing"
            >
              <span v-if="processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
              {{ processing ? 'Signing in...' : 'Sign In' }}
            </button>
          </form>

          <hr class="my-4" />

          <!-- Demo Credentials -->
          <small class="d-block text-center text-muted mb-3">
            Demo credentials:
          </small>
          <div class="alert alert-info alert-sm p-2 mb-3" style="font-size: 0.85rem">
            <strong>Email:</strong> test@example.com<br />
            <strong>Password:</strong> password
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { ref, reactive } from 'vue'
import GuestLayout from '../Layouts/GuestLayout.vue'

const processing = ref(false)
const errors = reactive({
  email: '',
  password: '',
  general: ''
})

const form = reactive({
  email: '',
  password: '',
  remember: false
})

const handleLogin = async () => {
  // Clear previous errors
  errors.email = ''
  errors.password = ''
  errors.general = ''

  // Validation
  if (!form.email) {
    errors.email = 'Email is required'
    return
  }
  if (!form.password) {
    errors.password = 'Password is required'
    return
  }

  processing.value = true

  try {
    const response = await fetch('/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
      },
      body: JSON.stringify({
        email: form.email,
        password: form.password,
        remember: form.remember
      })
    })

    const data = await response.json()

    if (!response.ok) {
      if (data.errors) {
        errors.email = data.errors.email?.[0] || ''
        errors.password = data.errors.password?.[0] || ''
      }
      errors.general = data.message || 'Login failed. Please try again.'
      return
    }

    // Redirect on successful login
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

.alert-sm {
  font-size: 0.875rem !important;
}

.spinner-border-sm {
  width: 1rem;
  height: 1rem;
}
</style>

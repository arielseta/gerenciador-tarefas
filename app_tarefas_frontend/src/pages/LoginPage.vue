<template>
  <q-page class="row justify-center items-center">
    <q-card style="width: 400px; max-width: 90vw">
      <q-card-section>
        <div class="text-h6 text-center">Login</div>
      </q-card-section>

      <q-form @submit.prevent="login">
        <q-card-section class="q-gutter-md">
          <q-input filled v-model="email" label="Email" type="email" required />
          <q-input filled v-model="password" label="Senha" type="password" required />
        </q-card-section>

        <q-card-actions align="right">
          <q-btn label="Entrar" color="primary" type="submit" :loading="loading" />
        </q-card-actions>
      </q-form>
    </q-card>
  </q-page>
</template>
  
<script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  import { useQuasar } from 'quasar'
  import authService from 'src/services/authService'
  
  const email = ref('')
  const password = ref('')
  const loading = ref(false)
  const router = useRouter()
  const $q = useQuasar()
  
  const login = async () => {
    loading.value = true
    try {
      await authService.login({ email: email.value, password: password.value })
      $q.notify({ type: 'positive', message: 'Login realizado com sucesso' })
      router.push('/')
    } catch (error) {
      $q.notify({ type: 'negative', message: error.response?.data?.message || 'Erro ao fazer login' })
    } finally {
      loading.value = false
    }
  }
</script>
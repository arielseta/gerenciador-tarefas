<template>
  <q-layout view="hHh lpR fFf">
    <!-- Cabeçalho -->
    <q-header elevated class="bg-primary text-white">
      <q-toolbar class="bg-primary text-white q-my-md shadow-2">

        <q-toolbar-title>
          Gerenciador de Tarefas
        </q-toolbar-title>

        <q-space />

        <div v-if="usuario">
          <q-btn-dropdown
            flat
            icon="account_circle"
            :label="usuario.name"
            color="white"
            auto-close
          >
            <q-list style="min-width: 150px">
              <q-item>
                <q-item-section>
                  <q-item-label>{{ usuario.name }}</q-item-label>
                  <q-item-label caption>{{ usuario.email }}</q-item-label>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item clickable @click="logout">
                <q-item-section>Logout</q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown>
        </div>

        <div v-else>
          <q-btn flat color="white" label="Login" to="/login" icon="login" />
        </div>

      </q-toolbar>
    </q-header>

    <!-- Conteúdo -->
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { ref, onUpdated } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useQuasar } from 'quasar'
import authService from 'src/services/authService'

const usuario = ref(null)
const $q = useQuasar()
const router = useRouter()
const route = useRoute()

onUpdated(async () => {
  // Evita rechecagens na tela de login
  if (route.path === '/login') {
    usuario.value = null
    return
  }

  // Se já está carregado, não refaz
  if (usuario.value) return

  try {
    const user = await authService.getUser()
    usuario.value = user
  } catch (error) {
    console.log(error)
    usuario.value = null
    router.push('/login')
  }
})

const logout = async () => {
  try {
    await authService.logout()
    usuario.value = null
    router.push('/login')
  } catch (error) {
    console.log(error)
    $q.notify({ type: 'negative', message: 'Erro ao fazer logout' })
  }
}
</script>

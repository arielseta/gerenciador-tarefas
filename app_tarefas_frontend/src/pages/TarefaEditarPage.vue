<template>
  <q-page padding>
    <TarefaForm modo="editar" :tarefaId="id" />
  </q-page>
</template>

<script setup>
import { useRoute } from 'vue-router'
import TarefaForm from 'src/components/TarefaForm.vue'

const route = useRoute()
const id = parseInt(route.params.id)
</script>

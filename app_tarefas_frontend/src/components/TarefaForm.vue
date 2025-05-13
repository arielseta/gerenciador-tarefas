<template>
  <q-form @submit.prevent="handleSubmit">
    <q-input v-model="form.titulo" label="Título" required class="q-mb-sm" />
    <q-input v-model="form.descricao" label="Descrição" required type="textarea" class="q-mb-sm" />
    <q-input v-model="form.vencimento" label="Data de Vencimento" required type="date" class="q-mb-sm" />
    
    <q-select
      v-model="form.status_id"
      :options="statusOptions"
      option-label="descricao"
      option-value="id"
      label="Status"
      class="q-mb-md"
      emit-value
      map-options
    />

    <div class="row justify-end">
      <q-btn label="Salvar" type="submit" color="primary" />
      <q-btn label="Cancelar" color="secondary" flat class="q-ml-sm" @click="cancelar" />
    </div>
  </q-form>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import tarefaService from 'src/services/tarefaService'
import axios from 'axios'
import { useQuasar } from 'quasar'

const props = defineProps({
  modo: String,
  tarefaId: Number
})

const $q = useQuasar()
const router = useRouter()

const form = ref({
  titulo: '',
  descricao: '',
  vencimento: '',
  status_id: null
})

const statusOptions = ref([])

const carregarStatus = async () => {
  const res = await axios.get('http://localhost:8000/api/status')
  statusOptions.value = res.data
}

const carregarTarefa = async () => {
  if (props.modo === 'editar' && props.tarefaId) {
    const res = await tarefaService.buscarPorId(props.tarefaId)
    form.value = {
      titulo: res.data.titulo,
      descricao: res.data.descricao,
      vencimento: res.data.vencimento,
      status_id: res.data.status_id
    }
  }
}

const cancelar = () => {
  router.push('/')
}

const handleSubmit = async () => {
  try {
    if (props.modo === 'editar') {
      await tarefaService.atualizar(props.tarefaId, form.value)
      $q.notify({ type: 'positive', message: 'Tarefa atualizada com sucesso!' })
    } else {
      await tarefaService.criar(form.value)
      $q.notify({ type: 'positive', message: 'Tarefa criada com sucesso!' })
    }
    router.push('/')
  } catch (error) {
    console.error(error)
    $q.notify({ type: 'negative', message: 'Erro ao salvar tarefa' })
  }
}

onMounted(() => {
  carregarStatus()

  if (props.modo === 'editar') {
    carregarTarefa()
  } else {
    // Preencher data de vencimento com hoje no modo "novo"
    const hoje = new Date().toISOString().split('T')[0]
    form.value.vencimento = hoje
    // Preencher status com pendente como padrão.
    form.value.status_id = 2 
  }
})

</script>

<script setup>
import { ref, computed, onMounted } from 'vue'
import tarefaService from 'src/services/tarefaService'
import statusService from 'src/services/statusService'
import TarefaTabela from 'src/components/TarefaTabela.vue'
import { useRouter } from 'vue-router'
import { useQuasar } from 'quasar'
import { format } from 'date-fns'

const tarefas = ref([])
const statusList = ref([])
const statusSelecionado = ref(null)
const filtroData = ref(null)
const $q = useQuasar()
const router = useRouter()

const carregarTarefas = async () => {
  const resposta = await tarefaService.listar()
  tarefas.value = resposta.data

  // Verifica se há tarefas atrasadas
  const hoje = new Date().toISOString().split('T')[0]
  const atrasadas = tarefas.value.filter(tarefa => tarefa.vencimento < hoje)

  if (atrasadas) {
    $q.notify({
      type: 'warning',
      message: `Você tem ${atrasadas.length} tarefa(s) atrasada(s)!`,
      timeout: 5000,
      position: 'top'
    })
  }  
}

const carregarStatus = async () => {
  const resposta = await statusService.listar()
  statusList.value = resposta.data
}

const tarefasFiltradas = computed(() => {
  return tarefas.value.filter(tarefa => {
    const statusOk = statusSelecionado.value
      ? tarefa.status_id === statusSelecionado.value.id
      : true
    const dataOk = filtroData.value
      ? tarefa.vencimento === filtroData.value
      : true
    return statusOk && dataOk
  })
})

const excluirTarefa = async (id) => {
  $q.dialog({
    title: 'Confirmar',
    message: 'Deseja realmente excluir esta tarefa?',
    cancel: true,
    persistent: true
  }).onOk(async () => {
    await tarefaService.excluir(id)
    carregarTarefas()
    $q.notify({ type: 'positive', message: 'Tarefa excluída!' })
  })
}

function formatarData(dataIso) {
  return format(new Date(dataIso), 'dd/MM/yyyy')
}

onMounted(() => {
  carregarTarefas()
  carregarStatus()
})
</script>

<template>
  <q-page class="q-pa-md">
    <div class="row q-col-gutter-md q-mb-md">
      <div class="col-12 col-md-4">
        <q-select
          v-model="statusSelecionado"
          :options="statusList"
          option-value="id"
          option-label="descricao"
          label="Filtrar por status"
          clearable
          outlined
          class="full-width"
          dense
        />
      </div>

      <div class="col-12 col-md-4">
        <q-input
          v-model="filtroData"
          type="date"
          label="Filtrar por vencimento"
          outlined
          clearable
          class="full-width"
          dense
          style="min-width: 100%; max-width: 100%;"
        />
      </div>

      <div class="col-12 col-md-4">
        <q-btn
          to="/tarefas/novo"
          label="Nova Tarefa"
          color="primary"
          class="full-width"
        />
      </div>
    </div>

    <TarefaTabela
      :tarefas="tarefasFiltradas"
      :on-editar="(id) => router.push(`/tarefas/editar/${id}`)"
      :on-excluir="excluirTarefa"
      :formatar-data="formatarData"
    />
  </q-page>
</template>

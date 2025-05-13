<template>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-light">
        <tr>
          <th>Título</th>
          <th>Descrição</th>
          <th>Vencimento</th>
          <th>Status</th>
          <th style="width: 120px;">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tarefa in tarefas" :key="tarefa.id">
          <td>{{ tarefa.titulo }}</td>
          <td>{{ tarefa.descricao }}</td>
          <td :class="{ 'text-red': tarefa.vencimento < hojeISO }">
            {{ formatarData(tarefa.vencimento) }}
          </td>
          <td>{{ tarefa.status.descricao }}</td>
          <td>
            <q-btn
              flat
              color="primary"
              icon="edit"
              size="sm"
              @click="onEditar(tarefa.id)"
            />
            <q-btn
              flat
              color="negative"
              icon="delete"
              size="sm"
              @click="onExcluir(tarefa.id)"
            />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
defineProps({
  tarefas: Array,
  onEditar: Function,
  onExcluir: Function,
  formatarData: Function
})

const hojeISO = new Date().toISOString().split('T')[0]

</script>

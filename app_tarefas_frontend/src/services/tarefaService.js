import { api } from 'boot/axios'

export default {
  listar() {
    return api.get('/api/tarefas')
  },
  buscarPorId(id) {
    return api.get(`/api/tarefas/${id}`)
  },
  criar(dados) {
    return api.post('/api/tarefas', dados)
  },
  atualizar(id, dados) {
    return api.put(`/api/tarefas/${id}`, dados)
  },
  excluir(id) {
    return api.delete(`/api/tarefas/${id}`)
  }
}

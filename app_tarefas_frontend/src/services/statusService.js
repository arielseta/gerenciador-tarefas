import { api } from 'boot/axios'

export default {
  listar() {
    return api.get('/api/status')
  }
}

import { api } from 'boot/axios'

export default {
  async login(data) {
    await api.get('/sanctum/csrf-cookie')
    return api.post('/login', data)
  },

  async logout() {
    return api.post('/api/logout')
  },

  async getUser() {
    const response = await api.get('/api/user')
    if (!response.data || !response.data.id) {
      throw new Error('Usuário não autenticado')
    }
    return response.data
  },

  async isLogado() {
    try {
      const user = await this.getUser()
      return !!user?.id
    } catch (error) {
      console.log(error)
      return false
    }
  }
}

const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        component: () => import('pages/IndexPage.vue'),
        meta: { requiresAuth: false }
      },
      {
        path: 'tarefas/novo',
        name: 'TarefaNovo',
        component: () => import('pages/TarefaNovoPage.vue'),
        meta: { requiresAuth: true }
      },
      {
        path: 'tarefas/editar/:id',
        name: 'TarefaEditar',
        component: () => import('pages/TarefaEditarPage.vue'),
        props: true,
        meta: { requiresAuth: true }
      },
      {
        path: 'login',
        name: 'Login',
        component: () => import('pages/LoginPage.vue'),
        meta: { requiresAuth: false }
      }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes

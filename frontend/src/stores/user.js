import { computed, reactive } from 'vue'
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', () => {
  const user = reactive({ roles: [] })

  function setUser(data) {
    Object.assign(user, data)
  }
  const isAdmin = computed(() => user.roles.includes('admin'))

  return { user, setUser, isAdmin }
})

import { ref } from 'vue'
import instance from '../config/axios'

const useMakeRequest = () => {
  const isLoading = ref(false)
  const error = ref(null)

  const get = async (url, config) => {
    try {
      isLoading.value = true
      const response = await instance.get(url, config)
      return response.data
    } catch (error) {
      handleError(error)
      throw error
    } finally {
      isLoading.value = false
    }
  }

  const post = async (url, data, config) => {
    try {
      isLoading.value = true
      const response = await instance.post(url, data, config)
      return response.data
    } catch (error) {
      handleError(error)
      throw error
    } finally {
      isLoading.value = false
    }
  }

  const deleteRequest = async (url, data, config) => {
    try {
      isLoading.value = true
      const response = await instance.delete(url, { data }, config)
      return response.data
    } catch (error) {
      handleError(error)
      throw error
    } finally {
      isLoading.value = false
    }
  }

  // Add other HTTP methods as needed: put, patch, delete, etc.

  const handleError = (err) => {
    error.value = err
    // Handle error globally or perform specific actions based on error status, etc.
    console.error('API Request Error:', err)
  }

  return {
    isLoading,
    error,
    get,
    post,
    deleteRequest
    // Add other HTTP methods as needed
  }
}

export default useMakeRequest

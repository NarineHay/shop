import { defineStore } from 'pinia'
import { ref } from 'vue'


export const useModalStore = defineStore('modal', () => {
    const successMessage = ref('')
    const errorMessage = ref('')
    const visible = ref(false)

    function showSuccess(message) {
        successMessage.value = message
        errorMessage.value = ''
        visible.value = true
        setTimeout(() => (visible.value = false), 3000)
        console.log('sooooooow -->', message)
    }

    function showError(message) {
        errorMessage.value = message
        successMessage.value = ''
        visible.value = true
        setTimeout(() => (visible.value = false), 3000)
    }

    return {
        successMessage,
        errorMessage,
        visible,
        showSuccess,
        showError,  // <- Обязательно сюда добавить
    }
  })

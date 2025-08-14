<script setup>
    import { storeToRefs } from 'pinia'
    import { useModalStore } from '@/Stores/modalStore'

    const modal = useModalStore()
    const { successMessage, errorMessage, visible } = storeToRefs(modal)
</script>


<template>
    <Transition name="fade">
        <div
            v-if="visible"
            class="position-fixed shadow-lg border-left"
            :class="[
                successMessage ? 'border-success' : '',
                errorMessage ? 'border-danger' : ''
            ]"
            style="
                top: 1rem;
                right: 1rem;
                z-index: 1080;
                background-color: white;
                min-width: 300px;
                min-height: 80px;
                border-left-width: 6px;
                border-radius: .5rem;
                padding: 1rem 1.5rem;
            "
        >
            <div class="d-flex align-items-center h-100">
                <span
                    :class="[
                        'font-weight-bold',
                        successMessage ? 'text-success' : '',
                        errorMessage ? 'text-danger' : ''
                    ]"
                >
                    {{ successMessage || errorMessage }}
                </span>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s ease;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>

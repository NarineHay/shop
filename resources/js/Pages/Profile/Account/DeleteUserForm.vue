<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import { useTrans, useRoute } from '/resources/js/trans';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(useRoute('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                 {{useTrans('page.account_details.delete.h2')}}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{useTrans('page.account_details.delete.p')}}
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">{{useTrans('page.account_details.delete.button')}}</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900"
                >
                    {{useTrans('page.account_details.delete.modal_h2')}}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{useTrans('page.account_details.delete.modal_p')}}
                </p>

                <div class="mt-6">
                    <InputLabel
                        for="password"
                        :value="useTrans('form.password')"
                        class="sr-only"
                    />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        :placeholder="useTrans('form.password')"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                         {{useTrans('page.account_details.delete.modal_btn_cancel')}}
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                         {{useTrans('page.account_details.delete.modal_btn_delete')}}
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>

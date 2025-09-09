<script setup>
import DeleteUserForm from './Account/DeleteUserForm.vue';
import UpdatePasswordForm from './Account/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Account/UpdateProfileInformationForm.vue';
import { useTrans, useRoute } from '/resources/js/trans';


defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <h3> {{useTrans('page.title')}}</h3>
    <div class="py-12">
        <div class="w-100 space-y-6 ">
            <div
                class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
            >
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>

            <div
                class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
            >
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div
                class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
            >
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </div>
</template>

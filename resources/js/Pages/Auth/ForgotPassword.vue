<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    console.log(useRoute('password.email'), 4444)
    // form.post(route('password.email', { locale: 'ru' }));

     form.post(useRoute('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />

        <div class="login-wrapper pb-70">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <main id="primary" class="site-main">
                            <div class="user-login">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12">
                                        <div class="section-title text-center">
                                            <h3>{{useTrans('page.title_h3')}}</h3>
                                        </div>

                                    </div>
                                </div> <!-- end of row -->
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-6 offset-lg-2 offset-xl-3">
                                        <div class="login-form">
                                            <p class="mt-3 mb-5"> {{useTrans('page.title_p')}}</p>
                                            <div class="px-3 pb-5 mt-2text-warning" role="alert"  v-if="status">
                                                <p class="text-warning">{{ status }}</p>
                                            </div>
                                            <form @submit.prevent="submit">
                                                <div class="form-group row align-items-center mb-4">
                                                    <InputLabel for="email" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.email')" />
                                                    <div class="col-12 col-sm-12 col-md-8">
                                                        <TextInput
                                                            id="email"
                                                            type="email"
                                                            class="form-control"
                                                            v-model="form.email"
                                                            required
                                                            autofocus
                                                            :placeholder="useTrans('form.email')"
                                                        />

                                                        <InputError class="mt-2" :message="form.errors.email" />
                                                    </div>
                                                    <div class="login-box mt-5 text-center">

                                                        <PrimaryButton

                                                            class="btn btn-secondary mb-4 mt-4"
                                                            :class="{ 'opacity-25': form.processing }"
                                                            :disabled="form.processing"
                                                        >
                                                            {{useTrans('page.reset_link')}}
                                                        </PrimaryButton>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end of user-login -->
                        </main> <!-- end of #primary -->
                    </div>
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div>


    </GuestLayout>
</template>

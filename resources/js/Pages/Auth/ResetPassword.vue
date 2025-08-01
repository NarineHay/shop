<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(useRoute('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title_h3')" />
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
                                                            autocomplete="username"
                                                            :placeholder="useTrans('form.email')"
                                                        />

                                                        <InputError class="mt-2" :message="form.errors.email" />
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center mb-4">
                                                    <InputLabel for="password" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.password')" />
                                                    <div class="col-12 col-sm-12 col-md-8">
                                                        <TextInput
                                                            id="c-password"
                                                            type="password"
                                                            class="form-control"
                                                            v-model="form.password"
                                                            required
                                                            autocomplete="current-password"
                                                            :placeholder="useTrans('form.password')"
                                                        />
                                                        <InputError class="mt-2" :message="form.errors.password" />
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center mb-4">
                                                    <InputLabel for="password_confirmation" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.password_confirmation')" />
                                                    <div class="col-12 col-sm-12 col-md-8">
                                                        <TextInput
                                                            id="c-password_confirmation"
                                                            type="password_confirmation"
                                                            class="form-control"
                                                            v-model="form.password_confirmation"
                                                            required
                                                            autocomplete="current-password"
                                                            :placeholder="useTrans('form.password_confirmation')"
                                                        />
                                                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                                    </div>
                                                </div>

                                                <div class="login-box mt-5 text-center">

                                                    <PrimaryButton
                                                        class="btn btn-secondary mb-4 mt-4"
                                                        :class="{ 'opacity-25': form.processing }"
                                                        :disabled="form.processing"
                                                    >
                                                        {{useTrans('page.title_h3')}}
                                                    </PrimaryButton>
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

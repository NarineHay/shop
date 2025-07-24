<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    agree_terms: ''

});

const submit = () => {
    form.post(useRoute('/register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
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
                                                <h3>{{ useTrans('page.title_h3') }}</h3>
                                            </div>
                                        </div>
                                    </div> <!-- end of row -->
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 offset-xl-2">
                                            <div class="registration-form login-form">
                                                <form @submit.prevent="submit">
                                                    <div class="login-info mb-20">
                                                        <p>{{ useTrans('page.have_account') }}
                                                            <Link :href="useRoute('/login')" class="fw-bold" >{{ useTrans('page.log_in') }}</Link>
                                                        </p>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <InputLabel for="name" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.name')" />
                                                        <!-- <label for="f-name" class="col-12 col-sm-12 col-md-4 col-form-label">First Name</label> -->
                                                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                            <TextInput
                                                                id="name"
                                                                type="text"
                                                                class="form-control"
                                                                v-model="form.name"

                                                                autofocus
                                                                autocomplete="name"
                                                            />
                                                            <InputError class="mt-2" :message="form.errors.name" />
                                                        </div>
                                                    </div>

                                                    <!-- <div class="form-group mb-3 row">
                                                        <label for="l-name" class="col-12 col-sm-12 col-md-4 col-form-label">Last Name</label>
                                                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                            <input type="text" class="form-control" id="l-name" required="">
                                                        </div>
                                                    </div> -->
                                                    <div class="form-group mb-3 row">
                                                        <InputLabel for="email" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.email')" />
                                                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                            <TextInput
                                                                id="email"
                                                                type="text"
                                                                class="form-control"
                                                                v-model="form.email"
                                                                autofocus
                                                                autocomplete="email"
                                                            />
                                                            <InputError class="mt-2" :message="form.errors.email" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <InputLabel for="phone" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.phone')" />
                                                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                            <TextInput
                                                                id="phone"
                                                                type="text"
                                                                class="form-control"
                                                                v-model="form.phone"
                                                                autofocus
                                                                autocomplete="phone"
                                                            />
                                                            <InputError class="mt-2" :message="form.errors.phone" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <InputLabel for="password" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.password')" />
                                                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                            <TextInput
                                                                id="password"
                                                                type="password"
                                                                class="form-control"
                                                                v-model="form.password"

                                                                autocomplete="new-password"
                                                            />
                                                            <InputError class="mt-2" :message="form.errors.password" />
                                                        </div>
                                                    </div>


                                                    <div class="form-group mb-3 row">
                                                        <InputLabel for="password_confirmation" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.password_confirmation')" />
                                                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                            <TextInput
                                                                id="password_confirmation"
                                                                type="password"
                                                                class="form-control"
                                                                v-model="form.password_confirmation"

                                                                autocomplete="new-password"
                                                            />
                                                            <InputError  class="mt-2" :message="form.errors.password_confirmation" />
                                                        </div>
                                                    </div>

                                                    <div class="form-check row g-0 mt-5">
                                                        <div class="col-12 col-sm-12 col-md-8 offset-md-4 col-lg-8 offset-lg-4">
                                                            <div class="custom-checkbox">
                                                                <!-- <input class="form-check-input" type="checkbox" id="offer"> -->
                                                                <Checkbox id="flexCheckDefault" v-model="form.agree_terms" class="form-check-input"></Checkbox>

                                                                <span class="checkmark"></span>
                                                                <div class="d-flex">
                                                                    <InputLabel for="flexCheckDefault" :value="useTrans('page.agree')"
                                                                        class="form-check-label" />
                                                                    <Link :href="useRoute('/login')" class="form-check-label fw-bold ml-2">
                                                                        {{useTrans('page.terms_conditions')}} </Link>
                                                                </div>
                                                                <InputError class="mt-2 opacity-60"
                                                                    :message="form.errors.agree_terms" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="register-box d-flex justify-content-end mt-20">
                                                        <!-- <button type="submit" class="btn btn-secondary">Register</button> -->
                                                        <PrimaryButton
                                                            type="submit"
                                                            class="btn btn-secondary"
                                                            :class="{ 'opacity-25': form.processing }"
                                                            :disabled="form.processing"
                                                        >
                                                            {{useTrans('page.register')}}
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

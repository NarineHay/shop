<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(useRoute('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
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
                                            <p class="mt-3 ">{{useTrans('page.title_p')}}</p>

                                            <div class="mt-4" role="alert"  v-if="verificationLinkSent">

                                                <p class="text-warning">{{useTrans('page.verification_link_sent')}}</p>
                                            </div>
                                            <form @submit.prevent="submit">

                                                <div class="login-box mt-5 text-center">

                                                    <PrimaryButton
                                                        type="submit"
                                                        class="btn btn-secondary mb-4"
                                                        :class="{ 'opacity-25': form.processing }"
                                                        :disabled="form.processing"
                                                    >
                                                        {{useTrans('page.resend_verification_email')}}
                                                    </PrimaryButton>
                                                </div>

                                            </form>
                                            <div class="text-center pt-20 top-bordered">
                                                <Link
                                                    :href="useRoute('logout')"
                                                    method="post"
                                                    as="button"
                                                    class="text-center"
                                                    >{{useTrans('page.log_out')}}</Link
                                                >
                                            </div>
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

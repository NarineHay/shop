<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';
import { useModalStore } from '@/Stores/modalStore'


const form = useForm({
  name: '',
  phone: '',
  email: '',
  subject: '',
  message: ''
})

const modal = useModalStore()


const submitForm = () => {

    form.post(useRoute('contact'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            modal.showSuccess(useTrans('app.messages.success'))
        },
    })
}

</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />
            <section class="contact-style-2 pt-30 pb-35">
                <div class="container-fluid">
                    <div class="row my-4">
                        <div class="col-10 mx-auto">
                            <div class="contact2-title text-center mb-65 ">
                                <h2>{{useTrans('page.b1-h2')}}</h2>
                                <p> {{useTrans('page.b1-p1')}} </p>
                                <p> {{useTrans('page.b1-p2')}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-single-info mb-30 text-center">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <h3>{{ useTrans('page.address') }}</h3>
                                <p>{{ useTrans('page.address_value') }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-single-info mb-30 text-center">
                                <div class="contact-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <h3>{{ useTrans('page.call_us') }}</h3>
                                <p>+37455522511</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-single-info mb-30 text-center">
                                <div class="contact-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <h3>{{ useTrans('page.email') }}</h3>
                                <p>kasamanesol@gmail.com</p>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <div class="contact-two-area pt-20 pb-20">
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="contact2-title text-center mb-20">
                                    <h2>tell us your project</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="contact-message">
                                    <form @submit.prevent="submitForm" class="contact-form">
                                        <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                             <TextInput
                                                id="name"
                                                type="text"
                                                class="mb-4"
                                                v-model="form.name"
                                                :placeholder="useTrans('page.name') + ' *'"
                                            />
                                            <InputError class="mb-2" :message="form.errors.name" />

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                            <TextInput
                                                id="phone"
                                                type="text"
                                                class="mb-4"
                                                v-model="form.phone"
                                                :placeholder="useTrans('page.phone') + ' *'"
                                            />
                                            <InputError class="m2-2" :message="form.errors.phone" />

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <TextInput
                                                id="email"
                                                type="text"
                                                class="mb-4"
                                                v-model="form.email"
                                                :placeholder="useTrans('page.email') + ' *'"
                                            />
                                            <InputError class="mb-2" :message="form.errors.email" />
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <TextInput
                                                id="subject"
                                                type="text"
                                                class="mb-4"
                                                v-model="form.subject"
                                                :placeholder="useTrans('page.subject') + ' *'"
                                            />
                                            <InputError class="mb-2" :message="form.errors.subject" />

                                        </div>

                                        <div class="col-12">
                                            <div class="contact2-textarea text-center">
                                                <textarea
                                                    v-model="form.message"
                                                    :placeholder="useTrans('page.message') + ' *'"
                                                    class="form-control2 mb-4"
                                                ></textarea>
                                                <InputError class="mb-2" :message="form.errors.message" />

                                            </div>

                                            <div class="contact-btn text-center">
                                            <button class="btn btn-secondary" type="submit">
                                                {{ useTrans('page.button') }}
                                            </button>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-center">
                                            <p class="form-messege">{{ responseMessage }}</p>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </GuestLayout>
</template>

<style scoped>
    .about-ul{
        padding-left: 9rem !important;
    }
    .about-ul li{
        list-style-type: circle !important;
    }
</style>

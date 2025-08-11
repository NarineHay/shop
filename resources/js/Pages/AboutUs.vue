<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';


</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />
            <section class="contact-style-2 pt-30 pb-35">
                <div class="container-fluid">
                    <div class="row my-4">
                        <div class="col-10 mx-auto">
                            <div class="contact2-title text-center mb-65 ">
                                <h2>contact us</h2>
                                <p> Kasaman E. Solutions – Ձեր հուսալի գործընկերը էլեկտրական աքսեսուարների ոլորտում </p>
                                <p>Kasaman E. Solutions-ը հիմնադրվել է 2023 թվականին՝ նպատակ ունենալով հայաստանյան շուկան ապահովել բարձրորակ, անվտանգ և ժամանակակից էլեկտրական աքսեսուարներով։ Մենք ներմուծում և վաճառում ենք լայն տեսականի՝ խրոցներ, երկարացման լարեր, էլեկտրականության անջատիչներ և այլ անհրաժեշտ պարագաներ։</p>
                            </div>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-single-info mb-30 text-center">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <h3>Հուսալիություն</h3>
                                <p>Աշխատում ենք միայն ստուգված մատակարարների հետ և երաշխավորում ենք ապրանքների որակը։</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-single-info mb-30 text-center">
                                <div class="contact-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <h3>Ազնվություն</h3>
                                <p>Յուրաքանչյուր հաճախորդի հետ շփումը կառուցված է վստահության և թափանցիկելիության վրա։</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-single-info mb-30 text-center">
                                <div class="contact-icon">
                                    <i class="fa fa-fax"></i>
                                </div>
                                <h3>Պատասխանատվություն </h3>
                                <p> Մեր թիմը հետևում է, որ դուք ստանաք ճիշտ ապրանքը ճիշտ ժամանակին։</p>
                            </div>
                        </div>

                    </div>

                    <div class="row my-5">
                        <div class="col-12">
                            <div class="contact2-title text-center mb-65">
                                <h2>Ինչու ընտրել մեզ</h2>
                                <ul>
                                    <li>Մատչելի գներ և բարձր որակ</li>
                                    <li>Մշտապես թարմացվող տեսականի</li>
                                    <li>Մասնագիտական խորհրդատվություն յուրաքանչյուր գնորդի համար</li>
                                    <li>Ճկուն և երկարաժամկետ համագործակցության պայմաններ</li>
                                    <li></li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col-12">
                            <div class="contact2-title text-center mb-65">
                                <p> Մեր առաքելությունը Kasaman E. Solutions-ը պարզապես վաճառող չէ։ Մենք ձեր վստահելի գործընկերն ենք, որը կանգնած է ձեր կողքին՝ օգնելով ընտրել լավագույն լուծումները ձեր տան, գրասենյակի կամ արտադրական տարածքի համար։ Մեր նպատակն է էլեկտրական աքսեսուարների ձեռքբերումը դարձնել հեշտ, հարմար և վստահելի։
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </GuestLayout>
</template>

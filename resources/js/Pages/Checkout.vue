<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Select from "@/Components/Select.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { useTrans, useRoute } from "/resources/js/trans";
import { useCartStore } from '@/Stores/cart';


const props = defineProps({
  attributes: Array,
  regions: Array,

});

const cart = useCartStore()
const page = usePage();
const user = page.props.auth.user;
const isLoggedIn = computed(() => !!user)
const useAccountAddress = ref(false)
const selectedPayment = ref("check") // check | cash
console.log(user,isLoggedIn, '00000000' )


const hasUserAddress = computed(() => {
    if (!user) return false

    return Boolean(
        user.name &&
        user.email &&
        user.phone &&
        user.address &&
        user.region_id
    )
})

console.log(cart, 55555555)

const form = useForm({
   name: '',
    email: '',
    phone: '',
    address: '',
    region_id: '',
    agree_terms: false,
    comment: '',

    use_account_address: false,
    products: [],
    payment_type: 'check',
});


const regionOptions = computed(() =>
  props.regions.map((region) => ({
    value: region.id,
    text: region.name,
  }))
);



onMounted(() => {

    if (user) {
        cart.loadFromServer()  // авторизованные
    } else {
        cart.fetchProducts()   // неавторизованные, подтягиваем цены
    }

    console.log('👉 attributes:', JSON.stringify(props.attributes, null, 2))
})


function getAttributeName(attrId) {
    const attr = props.attributes.find(a => a.id === Number(attrId))
    return attr?.translation_lang?.name || '—'
}

function getAttributeValueName(attrId, valueId) {
    const attr = props.attributes.find(a => a.id === Number(attrId))
    const value = attr?.values?.find(v => v.id === Number(valueId))
    return value?.translation_lang?.name || '—'
}

const getProductsPayload = () => {
    if (isLoggedIn.value) {
        return cart.list
    } else {
        // для гостя достаём из localStorage
        const stored = localStorage.getItem('cart')
        return stored ? JSON.parse(stored) : []
    }
}




const checkout = () => {

    form.clearErrors()
console.log(useAccountAddress.value, isLoggedIn.value, 11111111)
    // 1) User not logged in but tries to use account address
    if (useAccountAddress.value && !isLoggedIn.value) {
        console.log(4445566)
        form.errors.address = useTrans('page.login_required_for_address')
        return
    }

    // 2) Selected account address but profile incomplete
    if (useAccountAddress.value && !hasUserAddress.value) {
        console.log(77777777)

        form.errors.address = useTrans('page.address_incomplete')
        return
    }

    // 3) Terms not accepted
    // if (!form.agree_terms) {
    //     form.errors.agree_terms = useTrans('checkout.terms_required')
    //     return
    // }

    form.use_account_address = useAccountAddress.value
    form.payment_type = selectedPayment.value
    form.products = getProductsPayload()

    const payload = {
        use_account_address: form.use_account_address,
        name: form.use_account_address ? user.name : form.name,
        email: form.use_account_address ? user.email : form.email,
        phone: form.use_account_address ? user.phone : form.phone,
        address: form.use_account_address ? user.address : form.address,
        region_id: form.use_account_address ? user.region_id : form.region_id,
        comment: form.comment,
        products: form.products,
        payment_type: form.payment_type,
        terms_acceptance: form.agree_terms,
    }
    form.post(useRoute('checkout.store'), {
        data: payload,
        onSuccess: () => {
            if (selectedPayment.value === "check") {
                window.location.href = form.props.order_payment_url
            } else {
                window.location.href = form.props.order_success_url
            }
        }
    })
}



</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />
            <div class="checkout-wrapper pt-10 pb-70">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <main id="primary" class="site-main">
                                <div class="checkout-area">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-7">
                                            <div class="checkout-form">
                                                <div class="section-title left-aligned">
                                                    <h3>Billing Details</h3>
                                                </div>

                                                <form action="#">
                                                    <div class="row g-2 mb-3 form-group">
                                                        <div class="mb-3 col-12 col-sm-12 col-md-6">
                                                            <InputLabel for="name" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.name')" />
                                                            <TextInput
                                                                id="name"
                                                                type="text"
                                                                class="form-control"
                                                                :disabled="useAccountAddress"
                                                                v-model="form.name"
                                                                autocomplete="name"
                                                            />
                                                            <InputError class="mt-2" :message="form.errors.name" />
                                                        </div>
                                                        <div class="mb-3 col-12 col-sm-12 col-md-6 form-group">
                                                            <InputLabel for="email" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.email')" />
                                                            <TextInput
                                                                id="email"
                                                                type="text"
                                                                class="form-control"
                                                                :disabled="useAccountAddress"
                                                                v-model="form.email"
                                                                autofocus
                                                                autocomplete="email"
                                                            />
                                                            <InputError class="mt-2" :message="form.errors.email" />
                                                        </div>
                                                    </div>
                                                    <div class="row g-2 mb-3">
                                                        <div class="mb-3 col-12 col-sm-12 col-md-6 form-group">
                                                            <InputLabel for="phone" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.phone')" />
                                                            <TextInput
                                                                id="phone"
                                                                type="text"
                                                                class="form-control"
                                                                :disabled="useAccountAddress"
                                                                v-model="form.phone"
                                                                autofocus
                                                                autocomplete="phone"
                                                            />
                                                            <InputError class="mt-2" :message="form.errors.phone" />
                                                        </div>
                                                        <div class="mb-3 col-12 col-sm-12 col-md-6">
                                                            <InputLabel for="region_id" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('page.account_details.address.region')" />
                                                            <Select
                                                                class="w-full"
                                                                id="region_id"
                                                                :disabled="useAccountAddress"
                                                                :options="regionOptions"
                                                                v-model="form.region_id"
                                                            />
                                                            <InputError class="mt-2" :message="form.errors.region_id" />
                                                        </div>
                                                    </div>
                                                    <div class="row g-2 mb-3 ">
                                                        <div class="mb-3 col-12">
                                                            <InputLabel for="address" class="col-12 col-sm-12 col-md-4 col-form-label" :value="useTrans('form.address')" />
                                                            <TextInput
                                                                id="address"
                                                                type="text"
                                                                class="form-control"
                                                                :disabled="useAccountAddress"
                                                                v-model="form.address"
                                                                autofocus
                                                                autocomplete="address"
                                                            />
                                                            <InputError class="mt-2" :message="form.errors.address" />

                                                        </div>
                                                    </div>

                                                    <div v-if="isLoggedIn" class="custom-checkbox">
                                                        <input type="checkbox" class="form-check-input"
                                                            v-model="useAccountAddress" :disabled="!hasUserAddress">
                                                        <span class="checkmark"></span>

                                                        <label>
                                                            Use address from profile
                                                            <span v-if="!hasUserAddress" class="text-danger">
                                                                (profile address incomplete)
                                                            </span>
                                                        </label>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <InputLabel for="comment" class="col-12 col-sm-12 col-md-4 col-form-label" value="comment" />
                                                            <textarea
                                                                v-model="form.comment"
                                                                class="form-control" id="comment" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div> <!-- end of checkout-form -->
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-5">
                                            <div class="order-summary">
                                                <div class="section-title left-aligned">
                                                    <h3>Your Order</h3>
                                                </div>
                                                <div class="product-container">
                                                    <div v-for="item in cart.list" :key="item.id" class="product-list">
                                                        <div class="product-inner d-flex align-items-center">
                                                            <div class="product-image me-4 me-sm-5 me-md-4 me-lg-5">
                                                                <a href="#">
                                                                    <img :src="cart.getProductImage(item.id)" alt="Compete Track Tote" title="Compete Track Tote">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <h5>{{ cart.getProductName(item.id) }}</h5>
                                                                <p class="product-quantity">Quantity: {{ item.qty }}</p>
                                                                <p class="product-final-price">{{ (cart.getProduct(item.id)?.price || 0) * item.qty }} ֏</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div> <!-- end of product-container -->
                                                <div class="order-review">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr class="cart-subtotal">
                                                                    <th>Subtotal</th>
                                                                    <td class="text-center">$440.00</td>
                                                                </tr>
                                                                <tr class="order-total">
                                                                    <th>Total</th>
                                                                    <td class="text-center"><strong>$440.00</strong></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="checkout-payment">
                                                    <form action="#">
                                                        <div class="form-row">
                                                            <div class="custom-radio">
                                                                <input class="form-check-input" type="radio" name="payment" id="check_payment" value="check" v-model="selectedPayment" checked="">
                                                                <span class="checkmark"></span>
                                                                <label class="form-check-label" for="check_payment">Check Payments</label>

                                                                <div class="payment-info" id="check_pay">
                                                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                                </div>
                                                            </div>
                                                            <div class="custom-radio">
                                                                <input class="form-check-input" type="radio" name="payment" id="cash_delivery_payment" value="cash"  v-model="selectedPayment">
                                                                <span class="checkmark"></span>
                                                                <label class="form-check-label" for="cash_delivery_payment">Cash on Delivery</label>

                                                                <div class="payment-info" id="cash_pay">
                                                                    <p>Pay with cash upon delivery.</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-check">
                                                                <div class="custom-checkbox">
                                                                    <!-- <input class="form-check-input"  v-model="form.agree_terms"  type="checkbox" id="terms_acceptance" required=""> -->
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        id="terms_acceptance"
                                                                        v-model="form.agree_terms"
                                                                    />
                                                                                                                                        <span class="checkmark"></span>
                                                                   <!-- <label class="form-check-label" for="terms_acceptance">
                                                                        {{ useTrans('checkout.agree_prefix') }}
                                                                        <a href="/terms" target="_blank">{{ useTrans('checkout.terms') }}</a>
                                                                        {{ useTrans('checkout.agree_suffix') }}
                                                                    </label> -->
                                                                    <label class="form-check-label" for="terms_acceptance">I agree to the <a href="#">terms of service</a> and will adhere to them unconditionally.</label>
                                                                </div>
                                                                <InputError class="mt-2" :message="form.errors.agree_terms" />

                                                                <!-- <div v-if="errors.agree_terms" class="text-danger" style="color:red; margin-top:4px;">
                                                                    {{ errors.agree_terms }}
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-row justify-content-end">
                                                            <button @click="checkout" type="button" class="btn btn-secondary dark">
                                                                Continue to Payment
                                                            </button>
                                                            <!-- <input type="submit" class="btn btn-secondary dark" value="Continue to Payment"> -->
                                                        </div>
                                                    </form>
                                                </div> <!-- end of checkout-payment -->
                                            </div> <!-- end of order-summary -->
                                        </div>
                                    </div> <!-- end of row -->
                                </div> <!-- end of checkout-area -->
                            </main> <!-- end of #primary -->
                        </div>
                    </div> <!-- end of row -->
                </div> <!-- end of container -->
            </div>
    </GuestLayout>
</template>


<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';

import Edit from '@/Pages/Profile/Edit.vue'
import Address from '@/Pages/Profile/Address.vue'

const props = defineProps({
  regions: Array,
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <!-- Start of My Account Wrapper -->
        <div class="my-account-wrapper py-20">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <main id="primary" class="site-main">
                            <div class="user-dashboard pb-50">

                                <div class="main-dashboard">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-2">
                                            <ul class="nav flex-column dashboard-list" role="tablist">
                                                <!-- <li>
                                                    <button class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</button>
                                                </li> -->
                                                <li>
                                                    <button class="nav-link active" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">{{useTrans('page.sidebar.orders')}}</button>
                                                </li>

                                                <li>
                                                    <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">{{useTrans('page.sidebar.addresses')}}</button>
                                                </li>
                                                <li>
                                                    <button class="nav-link" id="account-details-tab" data-bs-toggle="tab" data-bs-target="#account-details" type="button" role="tab" aria-controls="account-details" aria-selected="false">{{useTrans('page.sidebar.account_details')}}</button>
                                                </li>
                                                <li>
                                                    <Link
                                                        :href="useRoute('logout')"
                                                        method="post"
                                                        class="text-body"
                                                        >{{ useTrans('navbar.logout') }}
                                                    </Link>
                                                    <!-- <a class="nav-link" href="login.html">{{useTrans('page.sidebar.logout')}}</a> -->
                                                </li>
                                            </ul> <!-- end of dashboard-list -->
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-10">
                                            <!-- Tab panes -->
                                            <div class="tab-content dashboard-content">
                                                <!-- <div id="dashboard" class="tab-pane fade show active" role="tabpanel" aria-labelledby="dashboard-tab">
                                                    <h3>Dashboard </h3>
                                                    <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p>
                                                </div> -->
                                                <!-- end of tab-pane -->

                                                <div id="orders" class="tab-pane fade show active" role="tabpanel" aria-labelledby="orders-tab">
                                                    <h3>Orders</h3>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order</th>
                                                                    <th>Date</th>
                                                                    <th>Status</th>
                                                                    <th>Total</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>September 10, 2019</td>
                                                                    <td>Processing</td>
                                                                    <td>$25.00 for 1 item </td>
                                                                    <td><a class="btn btn-secondary" href="cart.html">view</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>October 4, 2019</td>
                                                                    <td>Processing</td>
                                                                    <td>$17.00 for 1 item </td>
                                                                    <td><a class="btn btn-secondary" href="cart.html">view</a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!-- end of tab-pane -->


                                                <div id="address" class="tab-pane" role="tabpanel" aria-labelledby="address-tab">
                                                     <Address :regions="props.regions" />
                                                </div> <!-- end of tab-pane -->

                                                <div id="account-details" class="tab-pane fade" role="tabpanel" aria-labelledby="account-details-tab">

                                                    <Edit />
                                                    <!-- <div class="login-form">
                                                        <form action="#">
                                                            <div class="form-group row mb-3 align-items-center">
                                                                <label class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Title</label>
                                                                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                                                    <div class="form-row">
                                                                        <div class="col-6 col-sm-3">
                                                                            <div class="custom-radio">
                                                                                <input class="form-check-input" type="radio" name="gender" id="male">
                                                                                <span class="checkmark"></span>
                                                                                <label class="form-check-label" for="male">Mr.</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 col-sm-3">
                                                                            <div class="custom-radio">
                                                                                <input class="form-check-input" type="radio" name="gender" id="female">
                                                                                <span class="checkmark"></span>
                                                                                <label class="form-check-label" for="female">Mrs.</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="f-name" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">First Name</label>
                                                                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                                                    <input type="text" class="form-control" id="f-name" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="l-name" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Last Name</label>
                                                                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                                                    <input type="text" class="form-control" id="l-name" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="email" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Email Address</label>
                                                                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                                                    <input type="text" class="form-control" id="email" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="inputpassword" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Current Password</label>
                                                                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                                                    <input type="password" class="form-control" id="inputpassword" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="newpassword" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">New Password</label>
                                                                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                                                    <input type="password" class="form-control" id="newpassword" required>
                                                                    <button class="pass-show-btn" type="button">Show</button>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="c-password" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                                                                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                                                    <input type="password" class="form-control" id="c-password" required>
                                                                    <button class="pass-show-btn" type="button">Show</button>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="birth" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Birthdate (Optional)</label>
                                                                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                                                                    <input type="text" class="form-control" id="birth" placeholder="MM / DD / YYYY" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-check row p-0 mt-5">
                                                                <div class="col-12 col-sm-12 col-md-8 offset-md-4 col-lg-6 offset-lg-3">
                                                                    <div class="custom-checkbox">
                                                                        <input class="form-check-input" type="checkbox" id="offer">
                                                                        <span class="checkmark"></span>
                                                                        <label class="form-check-label" for="offer">Receive offers from our partners</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-check row p-0 mt-4">
                                                                <div class="col-12 col-sm-12 col-md-8 offset-md-4 col-lg-6 offset-lg-3">
                                                                    <div class="custom-checkbox">
                                                                        <input class="form-check-input" type="checkbox" id="subscribe" required>
                                                                        <span class="checkmark"></span>
                                                                        <label class="form-check-label" for="subscribe">Sign up for our newsletter<br>Subscribe to our newsletters now and stay up-to-date with new collections, the latest lookbooks and exclusive offers..</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="register-box d-flex justify-content-end mt-half">
                                                                <button type="submit" class="btn btn-secondary">Save</button>
                                                            </div>
                                                        </form>
                                                    </div> -->
                                                </div> <!-- end of tab-pane -->
                                            </div>
                                        </div>
                                    </div> <!-- end of row -->
                                </div> <!-- end of main-dashboard -->
                            </div> <!-- end of user-dashboard -->
                        </main> <!-- end of #primary -->
                    </div>
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div>
        <!-- End of My Account Wrapper -->
    </AuthenticatedLayout>
</template>

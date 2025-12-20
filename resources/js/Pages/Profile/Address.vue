<script setup>
import {
  computed,
  ref,
  reactive,
  onMounted,
  watch,
  onUnmounted,
  nextTick,
} from "vue";

import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { useTrans, useRoute } from "/resources/js/trans";
import { useModalStore } from "@/Stores/modalStore";
import Select from "@/Components/Select.vue";

const props = defineProps({
  regions: Array,
});

const user = usePage().props.auth.user;
const modal = useModalStore();

const form = useForm({
  region_id: user.region_id || "",
  address: user.address || "",
});

const regionOptions = computed(() =>
  props.regions.map((region) => ({
    value: region.id,
    text: region.name,
  }))
);

console.log(regionOptions, 7777777)
const submit = () => {
  form.post(useRoute("profile.address"), {
    onSuccess: () => {
      modal.showSuccess(useTrans("app.messages.success"));
    },
    onError: () => {
      modal.showError(useTrans("app.messages.error"));
    },
  });
};
</script>

<template>
  <h3>{{ useTrans("page.account_details.address.address") }}</h3>
  <div class="py-12">
    <div class="w-100 space-y-6">
      <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
        <section class="max-w-xl">
          <header>
            <h2 class="text-lg font-medium text-gray-900">
              {{ useTrans("page.account_details.info.h2") }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
              {{ useTrans("page.account_details.address.p") }}
            </p>
          </header>

          <form @submit.prevent="submit" class="mt-6 space-y-6 w-75">
            <div class="w-100">
              <InputLabel for="region_id" :value="useTrans('page.account_details.address.region')" />

                <Select
                    id="region_id"
                    :options="regionOptions"
                    v-model="form.region_id"
                />

              <InputError class="mt-2" :message="form.errors.region_id" />
            </div>

            <div class="mt-5">
              <InputLabel for="address" value="Address" />

              <TextInput
                id="address"
                type="text"
                class="mt-1 block w-full"
                v-model="form.address"
              />

              <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div class="flex items-center gap-4">
              <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                {{ useTrans("form.save") }}
              </PrimaryButton>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</template>
<style scoped>
:deep(.nice-select) {
  width: 100% !important;
}
</style>

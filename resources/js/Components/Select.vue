<script setup>
import { ref, watch, onMounted, nextTick } from 'vue'
import { useTrans } from '/resources/js/trans'

const props = defineProps({
  id: String,
  label: String,
  name: String,
  options: Array,
  modelValue: [String, Number],
  disabled: Boolean,
  error: String,
  required: {
    type: Boolean,
    default: false,
  },
})

const emit = defineEmits(['update:modelValue'])
const selected = ref(props.modelValue ?? '')

// === следим за изменениями внутри ===
watch(selected, (newValue) => {
  emit('update:modelValue', newValue)
})

// === следим за изменениями из родителя ===
watch(
  () => props.modelValue,
  (newValue) => {
    selected.value = newValue
  }
)

// ✅ вот сюда добавь инициализацию nice-select
onMounted(() => {
  nextTick(() => {
    // Инициализация плагина
    $('select').niceSelect();

    // Навешиваем событие на сам документ — через делегирование
    $(document).on('click', '.nice-select .option', function () {
      const value = $(this).data('value');
      selected.value = value;
      emit('update:modelValue', value);
      console.log(value, 111111); // <-- теперь обязательно сработает
    });
  });
});
</script>

<template>
  <div>
    <label :for="id" class="block text-sm font-medium text-gray-700">
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>

    <select
      :id="id"
      v-model="selected"
      class=" form-control block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
      :name="name"
      :disabled="disabled"
    >
      <option value="" disabled>{{ useTrans('form.select_placeholder') }}</option>
      <option v-for="(option, index) in options" :key="index" :value="option.value">
        {{ option.text }}
      </option>
    </select>

    <span v-if="error" class="text-red-600 text-sm">{{ error }}</span>
  </div>
</template>

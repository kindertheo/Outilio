<template>
    <div class="form-floating">
        <input type="text" class="form-control shadow-none" id="currency" ref="inputRef" :placeholder="placeholder" :disabled="disabled">
        <label for="currency">{{ placeholder }}</label>
    </div>
</template>

<script>
import { useCurrencyInput } from 'vue-currency-input';
import { watch } from 'vue'
export default {
    name: 'CurrencyInput',
    props: {
        modelValue: Number,
        options: Object,
        placeholder: String,
        disabled: Boolean || false
    },
    setup(props) {
        const { inputRef, setOptions, setValue } = useCurrencyInput(props.options);
        watch(
            () => props.modelValue,
            (value) => {
                setValue(value)
            }
        )
        watch(
            () => props.options,
            (options) => {
                setOptions(options)
            }
        )
        return { inputRef }
    }
}
</script>

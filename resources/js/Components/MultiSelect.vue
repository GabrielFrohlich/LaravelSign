<template>
    <div class="w-full relative">
        <div class="bg-white p-2 rounded " @click.prevent="show = !show;">
            <div class="flex flex-row flex-wrap">
                <span v-for="val in modelValue" class="bg-blue-900 p-1 rounded-full m-1 px-2">
                    {{ options[val] }} <span class="font-bold cursor-pointer" @click.prevent.stop="remove(val)">X</span>
                </span>
            </div>
        </div>
        <div class="overflow-y-auto block" ref="target">
            <div :class="show? '' : 'hidden'" class="border rounded p-2 absolute w-full z-[60] dark:bg-gray-800">
                <ul class="w-full">
                    <li v-for="(option, key) in options" @click.prevent="select(key)" class="dark:hover:bg-gray-300 rounded p-1">
                        {{option}}
                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script setup>
import { ref } from 'vue';
import { onClickOutside } from '@vueuse/core';
const target = ref(null)
onClickOutside(target, (event) => {
    show.value = false
})

const props = defineProps({
    options: {
        type: Object,
        required: true
    },
    modelValue: {
        type: Array,
        required: false
    }
})

const emit = defineEmits(['update:modelValue'])

const show = ref(false)

function select(opt){
    if(props.modelValue.includes(opt)){
        return
    }
    emit("update:modelValue", [...props.modelValue, opt])
}

function remove(opt){
    emit("update:modelValue", props.modelValue.filter(key => key != opt))
}

function flip(object){
    const ret = {}
    Object.keys(object).forEach(key => {
        ret[object[key]] = key
    })
    return ret
}
</script>

<style lang="scss" scoped>

</style>